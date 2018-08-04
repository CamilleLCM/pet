<?php
namespace Admin\Controller;
use Admin\Controller\IndexBaseController;
class UserController extends IndexBaseController {
	
	public function __construct(){
		parent::__construct();
	}
	
	//用户列表展示页面
 	public function users(){

 		$keyword = trim(I("request.keyword"));
 		
 		if(!empty($keyword)){
 			$condation['name'] = array("LIKE","%{$keyword}%");
 		}
 		$condation['status'] = array("neq",3);
 		
 		
 		$count = M("user")->where($condation)->count();
	   	$count = empty($count) ? 0 : $count;
	   	$Page = new \Think\Page($count,10);
 	
	   	$pagehtml = $Page->show();
 		$result = M("user")->where($condation)->order("uid desc")->limit("$Page->firstRow,$Page->listRows")->select();
 		
 		//查询今日的用户数量
 		$time = strtotime(date("Y-m-d 0:00:00"));
 		$count = M("User")->where("ctime>$time")->count();
 		
 		//今日用户登录个数
 		$count_login = M("User")->where("ctime>$time")->count();
 		$this->assign("keyword",$keyword);
 		$this->assign("pagehtml",$pagehtml);
 		$this->assign("count",$count);
 		$this->assign("count_login",$count_login);
 		$this->assign("result",$result);
 		$this->assign("page_status","用户列表");
 		
 		$this->display();
 	}
   
 	//添加用户
 	function add(){
 		
 		$this->assign("page_status","添加用户");
 		$this->display();
 	}
 	
	//添加用户  默认密码123456
 	function add_do(){
 			
 		$data['name'] = I("post.name");
 		$data['pwd'] = md5("123456");
 		$data['mobile'] = I("post.mobile");
 		$data['realname'] = I("post.realname");
 		$data['email'] = I("post.email");
 		$data['type'] = I("post.type");
 		$data['status'] = I("post.status");
 		$data['ctime'] = time();


		//图片上传
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize = 3145728 ;// 设置附件上传大小
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath = './Public/Uploads/'; // 设置附件上传根目录
		$upload->savePath = ''; // 设置附件上传（子）目录
		// 上传文件
		$info = $upload->upload();

		if(!empty($info['img']['savename'])){
			$data['img'] = $info['img']['savepath'].$info['img']['savename'];
		}

        $result = D("user");
        if($result->create($data)){
            if($result->add()){
                $this->success("添加成功,默认密码123456",U("Admin/User/users"));
            }
            $this->error("添加失败");
        }else{
            $this->error($result->getError());
        }

 		
 	}
 	
 		//编辑用户
 	function edit(){
 		 	
 		$uid = intval(I("request.uid"));
 
 		if ($uid<1){
 			$this->error("操作有误");
 		}
 		
 		$result = M("user")->where("uid=".$uid)->find();
 		$this->assign("page_status","编辑用户");
 		$this->assign("user",$result);
 		$this->display();
 	}
 	
	//编辑用户do
 	function edit_do(){
 			
 		$uid = intval(I("request.uid"));
 		
 		$pwd = trim(I("post.password"));
 		$data['mobile'] = I("post.mobile");
 		$data['realname'] = I("post.realname");
 		$data['email'] = I("post.email");
 		$data['status'] = I("post.status");
 		$data['type'] = I("post.type");
		
 		if(!empty($pwd)){
 			$data['pwd'] = md5($pwd);
 		}

		//图片上传
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize = 3145728 ;// 设置附件上传大小
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath = './Public/Uploads/'; // 设置附件上传根目录
		$upload->savePath = ''; // 设置附件上传（子）目录
		// 上传文件
		$info = $upload->upload();

		if(!empty($info['img']['savename'])){

			$data['img'] = $info['img']['savepath'].$info['img']['savename'];
		}

 		$result = M("user")->where('uid='.$uid)->save($data);

 		if($result){
 			$this->success("修改成功");
 			exit;
 		}

 	}
 	
 	
 	//删除用户
 	function del_by_uid(){
 		
 		$uid = intval(I("request.uid",0));
 		
 		if($uid>1){
 			$data['status']=3;
 			$result = M("user")->where("uid=".$uid)->save($data);
            echo M("user")->_sql();die;
 		}

 		$this->success("删除成功！");
 	}
 	//个人中心
	function userinfo(){
 		
 		$result = M('user')->where('uid='.$this->current_user['uid'])->find();
 		
 		$this->assign("user",$result);
 		$this->display();
 	}
 	
 	//编辑密码
	function editpwd(){
 		$this->display();
 	}
 	
 	//修改密码
 	public function pwd_do(){
 		
		$password=trim(I("password"));
		$newpwd=trim(I("newpwd"));
		$renewpwd=trim(I("renewpwd"));
		
		if (md5($password) != $this->current_user['pwd']){
			
			$this->error("旧密码错误！");
		}
		
		if (empty($newpwd)){
			
			$this->error("密码不能为空！");
		}
		
		if ($newpwd != $renewpwd){
		
			$this->error("密码不一致！");	
		}
		
		
		$data['pwd'] = md5($newpwd);
		
		$result = M("user")->where("uid=".$this->current_user['uid'])->save($data);
		
		
		$this->clear_current_user();
		
		$this->success("修改成功！请重新登录！",U("Admin/Authority/sign_in"));
	}
	
    
    
}