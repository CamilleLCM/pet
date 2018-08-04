<?php
namespace Admin\Controller;
use Admin\Controller\IndexBaseController;
class CategoryController extends IndexBaseController {
	
	public function __construct(){
		parent::__construct();
	}

	/**
	 * 信息类别的列表页面
	 */
 	public function index(){
 		
 		
 		$keyword = trim(I("request.keyword"));

		$condation = array();
 		if(!empty($keyword)){
 			$condation['title'] = array("LIKE","%{$keyword}%");
 		}

 		
 		$count = M("Category")->where($condation)->count();
	   	$count = empty($count) ? 0 : $count;
	   	$Page = new \Think\Page($count,10);
 	
	   	$pagehtml = $Page->show();
 		$result = M("Category")->where($condation)->order("id desc")->limit("$Page->firstRow,$Page->listRows")->select();
 		

 		$this->assign("keyword",$keyword);
 		$this->assign("pagehtml",$pagehtml);
 		$this->assign("result",$result);

 		$this->display();
 	}

	/**
	 * 添加信息类别
	 */
 	function add(){
 		
 		$this->display();
 	}

	/**
	 * 添加信息类别
	 */
 	function add_do(){
 			
 		$data['title'] = I("post.title");
 		$data['ctime'] = time();
 		
 		$result = M("Category")->add($data);
 		
 		if($result){
 			$this->success("添加成功",U("Admin/Category/index"));
 			exit;
 		}
 		
 	}

	/**
	 * 编辑信息类别
	 */
 	function edit(){
 		 	
 		$id = intval(I("request.id"));
 
 		if ($id<1){
 			$this->error("操作有误");
 		}
 		
 		$result = M("Category")->where("id=".$id)->find();
 		$this->assign("result",$result);
 		$this->display();
 	}

	/**
	 * 编辑信息类别
	 */
 	function edit_do(){
 			
 		$id = intval(I("request.id"));

		$data['title'] = I("post.title");

 		$result = M("Category")->where('id='.$id)->save($data);
 		if($result){
			$this->success("修改成功");
 		}
 		
 	}


	/**
	 * 删除信息类别列表
	 */
 	function del_by_id(){
 		
 		$id = intval(I("request.id",0));
 		
 		if($id>0){
 			M("Category")->where("id=".$id)->delete();
 		}
 	
 		$this->success("删除成功！");
 	}

}