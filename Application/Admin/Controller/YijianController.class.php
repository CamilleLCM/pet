<?php
namespace Admin\Controller;
use Admin\Controller\IndexBaseController;
class YijianController extends IndexBaseController {
	
	public function __construct(){
		parent::__construct();
	}

	/**
	 * 信息的列表页面
	 */
 	public function index(){
 		

 		$count = M("Yijian")->count();
	   	$count = empty($count) ? 0 : $count;
	   	$Page = new \Think\Page($count,10);
 	
	   	$pagehtml = $Page->show();
 		$result = M("Yijian")->order("id desc")->limit("$Page->firstRow,$Page->listRows")->select();

		foreach($result as $k=>$v)
		{
			$result[$k]['user'] = M("user")->where('uid='.$v['uid'])->find();
		}


 		$this->assign("keyword",$keyword);
 		$this->assign("pagehtml",$pagehtml);
 		$this->assign("result",$result);

 		$this->display();
 	}

	/**
	 * 删除信息列表
	 */
	function del_by_id(){

		$id = intval(I("request.id",0));

			M("Yijian")->where("id=".$id)->delete();

		$this->success("删除成功！");
	}


}