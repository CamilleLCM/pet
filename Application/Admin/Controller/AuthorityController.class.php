<?php
namespace Admin\Controller;
use Admin\Controller\IndexBaseController;
class AuthorityController extends IndexBaseController {
	
 function login() { 	     	
 	
        if(empty($this->current_user)){        	     		
        	$this->display();
        }else{
        	$this->success("已经登录成功！",U("Admin/Index/Index"));		
       	}      	
	}
    /*
     * 登录
     */

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
		$where['type'] = 'a';
		$where['pwd'] = md5(I('request.pwd'));
		$where['status'] = 0;
		
		$user = M('user')->where($where)->find();

		if(!empty($user) ){

			if(!isset($_SESSION)) session_start();
			$_SESSION['current_user']=$user;
			
			$login_save = intval(I("login_save",0));
			
			if($login_save==1){
				cookie('current_user',$user,3600*24*7); // 指定cookie保存时间
			}
			
			$this->success("登录成功！",U("Admin/Index/index"));
			
		}else{
			$this->error("登录失败，用户名或密码错误！");
		}
		
	}
	
	//退出
	function logout(){
		 if(isset($_SESSION['current_user'])) $_SESSION['current_user']='';
		 
		 $this->clear_current_user();
		 setcookie('current_user','',time()-1,null,null,null,true);
		 redirect(U('Authority/sign_in'));
	}
	//获取验证码
	function getAuthcode(){
		$config = array(
            'length' => 4,
            'imageH' => 44,
            'imageW' => 100,
            'fontSize' => 13,
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
	
        
    
}