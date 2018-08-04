<?php
namespace Admin\Controller;
use Admin\Controller\IndexBaseController;
class PetController extends IndexBaseController {
	
	public function __construct(){
		parent::__construct();
	}

	/**
	 * 宠物的列表页面
	 */
 	public function index(){
 		
 		
 		$keyword = trim(I("request.keyword"));

		$condation = array();
 		if(!empty($keyword)){
 			$condation['title'] = array("LIKE","%{$keyword}%");
 		}

 		
 		$count = M("Pet")->where($condation)->count();
	   	$count = empty($count) ? 0 : $count;
	   	$Page = new \Think\Page($count,10);
 	
	   	$pagehtml = $Page->show();
 		$result = M("Pet")->where($condation)->order("id desc")->limit("$Page->firstRow,$Page->listRows")->select();
 		

 		$this->assign("keyword",$keyword);
 		$this->assign("pagehtml",$pagehtml);
 		$this->assign("result",$result);

 		$this->display();
 	}

	/**
	 * 添加宠物
	 */
 	function add(){
 		
 		$this->display();
 	}

	/**
	 * 添加宠物
	 */
 	function add_do(){
 			
 		$data['title'] = I("post.title");
 		//$data['content'] = I("post.content");
 		$data['num'] = I("post.num");
 		$data['content'] = I("post.content");
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
 		
 		$result = M("Pet")->add($data);
 		
 		if($result){
 			$this->success("添加成功",U("Admin/Pet/index"));
 			exit;
 		}
 		
 	}

	/**
	 * 编辑宠物
	 */
 	function edit(){
 		 	
 		$id = intval(I("request.id"));
 
 		if ($id<1){
 			$this->error("操作有误");
 		}
 		
 		$result = M("Pet")->where("id=".$id)->find();
 		$this->assign("result",$result);
 		$this->display();
 	}

	/**
	 * 编辑宠物
	 */
 	function edit_do(){
 			
 		$id = intval(I("request.id"));

		$data['title'] = I("post.title");
		$data['content'] = I("post.content");
		$data['num'] = I("post.num");
		//$data['varieties'] = I("post.varieties");
		$data['status'] = I("post.status");

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
		
 		$result = M("Pet")->where('id='.$id)->save($data);
 		if($result){
			$this->success("修改成功");
 		}else{
 		    $this->error("无修改内容");
        }
 		
 	}


	/**
	 * 删除宠物列表
	 */
 	function del_by_id(){
 		
 		$id = intval(I("request.id",0));
 		
 		if($id>2){
 			$data['status']=3;
 			M("Pet")->where("id=".$id)->delete();
 		}
 	
 		$this->success("删除成功！");
 	}

}