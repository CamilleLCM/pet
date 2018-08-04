<?php
namespace Index\Controller;
use Index\Controller\IndexBaseController;

class UserController extends IndexBaseController {

    function _initialize(){
        if(empty($_SESSION['current_user_a']) || $_SESSION['current_user_a'] == " "){
            $this->error("请先登录~",U("Index/Authority/index"));
        }
    }

	function index() {

		$this->current_user_a = $this->get_current_user_a();
		$result = M('user')->where('uid='.$this->current_user_a['uid'])->find();

		$this->assign('result', $result);
		$this->display();
	}


	/**
	 * 用户修改个人资料
	 */
	function doZhuce()
	{

	    if(I("post.name")== ""){
            $this->error("修改失败，用户名不能为空！");
        }

		$data['mobile'] = I("post.mobile");
		$data['realname'] = I("post.realname");
		$data['email'] = I("post.email");
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

		$this->current_user_a = $this->get_current_user_a();

		$result = D("user")->where('uid='.$this->current_user_a['uid'])->save($data);

		if($result){
			$this->success("修改成功",U("Index/User/index"));
			exit;
		}
	}
    //修改密码
	function update_pwd(){


		$password=trim(I("pwd_old"));
		$newpwd=trim(I("pwd"));
		$renewpwd=trim(I("pwd1"));

		$this->current_user_a = $this->get_current_user_a();

		if (md5($password) != $this->current_user_a['pwd']){

			$this->error("旧密码错误！");
		}

		if (empty($newpwd)){

			$this->error("密码不能为空！");
		}

		if ($newpwd != $renewpwd){

			$this->error("密码不一致！");
		}


		$data['pwd'] = md5($newpwd);

		$result = M("user")->where("uid=".$this->current_user_a['uid'])->save($data);
        if($result){
            $this->clear_user();
            $this->success("修改成功！请重新登录！",U("Index/Authority/index"));
        }
       else{
            $this->error("修改失败");
       }

	}

}