<?php
namespace Admin\Controller;
use Admin\Controller\IndexBaseController;
class FootterController extends IndexBaseController {
	
	public function __construct(){
		parent::__construct();
	}

	/**
	 * 编辑信息
	 */
 	function index(){
 		 	
 		$result = M("Footter")->find();
 		$this->assign("result",$result);
 		$this->display();
 	}

	/**
	 * 编辑信息
	 */
 	function edit_do(){
 			
 		$id = intval(I("request.id"));

		$data['title'] = I("post.title");
		$data['content'] = I("post.content");

 		$result = M("Footter")->where('id='.$id)->save($data);
 		if($result){
			$this->success("修改成功");
 		}
 		
 	}


}