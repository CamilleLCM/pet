<?php
namespace Admin\Controller;
use Admin\Controller\IndexBaseController;
class VeterinaryController extends IndexBaseController {
	
	public function __construct(){
		parent::__construct();
	}

	/**
	 * 管理员的列表页面
	 */
 	public function index(){
 		
 		
 		$keyword = trim(I("request.keyword"));

		$condation = array();
 		if(!empty($keyword)){
 			$condation['title'] = array("LIKE","%{$keyword}%");
 		}

 		
 		$count = M("Veterinary")->where($condation)->count();
	   	$count = empty($count) ? 0 : $count;
	   	$Page = new \Think\Page($count,10);
 	
	   	$pagehtml = $Page->show();
 		$result = M("Veterinary")->where($condation)->order("id desc")->limit("$Page->firstRow,$Page->listRows")->select();
 		

 		$this->assign("keyword",$keyword);
 		$this->assign("pagehtml",$pagehtml);
 		$this->assign("result",$result);

 		$this->display();
 	}

	/**
	 * 添加管理员
	 */
 	function add(){
 		
 		$this->display();
 	}

	/**
	 * 添加管理员
	 */
 	function add_do(){
 			
 		$data['title'] = I("post.title");
 		$data['content'] = I("post.content");
 		$data['num'] = I("post.num");
 		$data['major'] = I("post.major");
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
 		
 		$result = M("Veterinary")->add($data);
 		
 		if($result){
 			$this->success("添加成功",U("Admin/Veterinary/index"));
 			exit;
 		}
 		
 	}

	/**
	 * 编辑管理员
	 */
 	function edit(){
 		 	
 		$id = intval(I("request.id"));
 
 		if ($id<1){
 			$this->error("操作有误");
 		}
 		
 		$result = M("Veterinary")->where("id=".$id)->find();
 		$this->assign("result",$result);
 		$this->display();
 	}

	/**
	 * 编辑管理员
	 */
 	function edit_do(){
 			
 		$id = intval(I("request.id"));

		$data['title'] = I("post.title");
		$data['content'] = I("post.content");
		$data['num'] = I("post.num");
		$data['major'] = I("post.major");
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

 		$result = M("Veterinary")->where('id='.$id)->save($data);
 		if($result){
			$this->success("修改成功");
 		}else{
			$this->error("修改失败");
		}
 		
 	}


	/**
	 * 删除管理员列表
	 */
 	function del_by_id(){
 		
 		$id = intval(I("request.id",0));
 		
 		if($id>0){
 			$data['status']=3;
 			M("Veterinary")->where("id=".$id)->delete();
 		}
 	
 		$this->success("删除成功！");
 	}

}