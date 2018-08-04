<?php
namespace Index\Controller;
use Index\Controller\IndexBaseController;
class PetController extends IndexBaseController {
	
	public function __construct(){
		parent::__construct();
		
	}

	/**
	 * 带分页的信息展示
	 */
	public function index(){

		//查询条件
		$condation = array();

		//宠物id
		$id = intval(I("request.id"));
		$condation['status'] = 0;
		if(!empty($id)){
			$condation['id'] = $id;
		}
		//标题
		$title = trim(I("request.title"));
		if(!empty($title)){
            $condation['_string'] = " title like '%{$title}%'  OR  content like '%{$title}%' OR num like '%{$title}%'";
		}

		$count = M("Pet")->where($condation)->count();
		$count = empty($count) ? 0 : $count;
		$Page = new \Think\Page($count,3);

		//分页的html
		$pagehtml = $Page->show();


		$message = M("Pet")->where($condation)->order("id desc")->limit("$Page->firstRow,$Page->listRows")->select();


		$this->assign('title', $title);

		$this->assign('current', 'pet');
		$this->assign('result', $message);
		$this->assign('pagehtml', $pagehtml);
 		$this->display();
	}


	/**
	 * 详情展示
	 */
	public function info(){

		$id = intval(I('request.id'));

		//查询一条记录
		$result = M("Message")->where('id='.$id)->find();
		$this->assign('result',$result);

		$this->display();
	}

}