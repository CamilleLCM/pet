<?php
namespace Admin\Controller;
use Admin\Controller\IndexBaseController;
class DepartmentController extends IndexBaseController {
	
	public function __construct(){
		parent::__construct();
	}

	/**
	 * 宠物的列表页面
	 */
 	public function index(){

		$condation = array();
        $condation['status'] = "0";

 		
 		$count = M("Department")->where($condation)->count();
	   	$count = empty($count) ? 0 : $count;
	   	$Page = new \Think\Page($count,10);
 	
	   	$pagehtml = $Page->show();
 		$result = M("Department")->where($condation)->order("id desc")->limit("$Page->firstRow,$Page->listRows")->select();


 		$this->assign("pagehtml",$pagehtml);
 		$this->assign("result",$result);

 		$this->display();
 	}

    /**
     *审核宠物领养列表页面
     */
    function examinelist(){

        $condation = array();
        $condation['status'] = "1";


        $count = M("Department")->where($condation)->count();
        $count = empty($count) ? 0 : $count;
        $Page = new \Think\Page($count,10);

        $pagehtml = $Page->show();
        $result = M("Department")->where($condation)->order("id desc")->limit("$Page->firstRow,$Page->listRows")->select();


        $this->assign("pagehtml",$pagehtml);
        $this->assign("result",$result);

        $this->display();
    }

    /**
     *审核宠物领养列表
     */
    function examine(){

        $id = intval(I("request.id"));

        if ($id<1){
            $this->error("操作有误");
        }

        $result = M("Department")->where("id=".$id)->find();
        $this->assign("result",$result);
        $this->display();

    }
    //审核功能
    function examine_do(){
        $id = intval(I("request.id"));
        if(I("request.type") == 'no'){
            $img =  M("Department")->where("id=".$id)->select()[0]['img'];
            $img_file = 'Public/Uploads/'.$img;
            @unlink($img_file);
            $result = M("Department")->where("id=".$id)->delete();
            if($result){
                $this->error("未通过审核,已删除!",U("Admin/Department/examinelist"));
                exit;
            }
        }

        $data['status'] = "0";
        $result = M("Department")->where('id='.$id)->save($data);
        if($result){
            $this->success("通过审核!",U("Admin/Department/examinelist"));
        }
    }


	/**
	 * 添加宠物
	 */
 	function add(){
 		
 		$this->display();
 	}

	/**
	 * 添加宠物
	 */
 	function add_do(){
 			
 		$data['title'] = I("post.title");
 		$data['content'] = I("post.content");
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
 		
 		$result = M("Department")->add($data);
 		
 		if($result){
 			$this->success("添加成功",U("Admin/Department/index"));
 			exit;
 		}
 		
 	}

	/**
	 * 编辑宠物
	 */
 	function edit(){
 		 	
 		$id = intval(I("request.id"));
 
 		if ($id<1){
 			$this->error("操作有误");
 		}
 		
 		$result = M("Department")->where("id=".$id)->find();
 		$this->assign("result",$result);
 		$this->display();
 	}

	/**
	 * 编辑宠物
	 */
 	function edit_do(){
 			
 		$id = intval(I("request.id"));

		$data['title'] = I("post.title");
		$data['content'] = I("post.content");
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
		
 		$result = M("Department")->where('id='.$id)->save($data);
 		if($result){
			$this->success("修改成功");
 		}
 		
 	}


	/**
	 * 删除宠物认领列表
	 */
 	function del_by_id(){
 		
 		$id = intval(I("request.id",0));

 		$img = M("Department")->where("id=".$id)->select()[0]["img"];
        $img_file = 'Public/Uploads/'.$img;
        @unlink($img_file);
        $result = M("Department")->where("id=".$id)->delete();

        if($result) {
            $this->success("删除成功！");
        }else{
            $this->error("删除失败");
        }
 	}

}