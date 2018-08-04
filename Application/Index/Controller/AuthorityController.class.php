<?php
namespace Index\Controller;
use Index\Controller\IndexBaseController;
class AuthorityController extends IndexBaseController {

	function index() {

		$this->current_user_a = $this->get_current_user_a();

		if(!empty($this->current_user_a)){
			redirect(U("Index/User/index"));
		}else{
			$this->display();
		}

	}
    //登录
	function doLogin() {

		// 检查验证码
		if (empty($_POST['verify']) ) {
			$this->error('验证码错误');
		}else{
			$verify=$_POST['verify'];
			if(!$this->checkVerify($verify)){
				$this->error('验证码错误');
			}
		}

		// 数据检查
		if ( empty($_POST['pwd']) ) {
			$this->error('密码不能为空');
		}

		if ( empty($_POST['name']) ) {
			$this->error('账号错误');
		}

		$where['name'] = I('request.name');
		$where['pwd'] = md5(I('request.pwd'));
		$where['status'] = 0;

		$user = M('user')->where($where)->find();

		if(!empty($user) ){

			$_SESSION['current_user_a']=$user;

			cookie('current_user_a',$user,0); // 指定cookie保存时间

			$this->success("登录成功！",U("Index/User/index"));

		}else{
			$this->error("登录失败，用户名或密码错误！");
		}

	}

    //退出
	function logout(){
        $this->clear_user();
        $this->success("退出成功!",U("Index/Authority/index"));
	}
    //验证码
	function getAuthcode(){
        $config = array(
            'length' => 4,
            'imageH' => 44,
            'imageW' => 100,
            'fontSize' => 14,
            'useNoise' => false,
            'fontttf' => '5.ttf',
        );
        ob_clean();
        $verify = new \Think\Verify($config);
        $verify->entry();
	}

	function checkVerify($code, $id = ''){
		$verify = new \Think\Verify();
		return $verify->check($code, $id);
	}


	/**
	 * 用户注册
	 */
	function doZhuce()
	{
		// 检查验证码
		if (empty($_POST['verify']) ) {
			$this->error('验证码错误');
		}else{
			$verify=$_POST['verify'];
			if(!$this->checkVerify($verify)){
				$this->error('验证码错误');
			}
		}

		$data['name'] = I("post.name");
		$data['pwd'] = md5(I("post.pwd"));
		$data['mobile'] = I("post.mobile");
		$data['realname'] = I("post.realname");
		$data['email'] = I("post.email");
		$data['type'] = "b";
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
                $this->success("注册成功",U("Index/Authority/index"));
            }
            $this->error("注册失败");
        }else{
            $this->error($result->getError());
        }

	}

}