<?php
namespace Index\Controller;
use Common\Controller\BaseController;
class IndexBaseController extends BaseController {

	function __construct(){

		parent::__construct();

		$category = M('category')->where('status=0')->select();
		$this->assign('g_category',$category);

		$footter = M('footter')->find();
		$this->assign('g_footter',$footter);

		$message_coment = M("Message")->order("id desc")->limit(8)->select();
		$this->assign('message_coment', $message_coment);
	}
	

}