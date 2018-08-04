<?php
namespace Common\Controller;
use Think\Controller;
class BaseController extends Controller {
	
	public $current_user;
	public $current_user_a;
	public $user;
	
	function  _initialize(){		
	   
		$this->current_user=$this->get_current_user();
	}

	
	
	//获取管理员
	function get_current_user(){
		
		$this->current_user = cookie('current_user');

		if (empty($current_user)){
			$this->current_user = $_SESSION['current_user'];
		}
		
		return $this->current_user;
	
	}

	//获取当前用户
	function get_current_user_a(){

		$this->current_user_a = cookie('current_user_a');

		if (empty($this->current_user_a)){
			$this->current_user_a = $_SESSION['current_user_a'];
		}

		return $this->current_user_a;

	}
	
	/**
	 * 清除管理员
	 */
	function clear_current_user(){
		$_SESSION['current_user']="";
		
		cookie('current_user',null);
		
	}
	
	/**
	 * 清除用户
	 */
	function clear_user(){
		
		$_SESSION['current_user_a']="";
		
		cookie('current_user_a',null);
	}
	
}