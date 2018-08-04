<?php
namespace Admin\Controller;
use Admin\Controller\IndexBaseController;
class MessageController extends IndexBaseController {
	
	public function __construct(){
		parent::__construct();
	}

	/**
	 * 信息的列表页面
	 */
 	public function index(){

		$condation = array();
        $condation['status'] = "0";
 		$count = M("Message")->where($condation)->count();
	   	$count = empty($count) ? 0 : $count;
	   	$Page = new \Think\Page($count,10);
 	
	   	$pagehtml = $Page->show();
//		$result = M("Message")->order("id desc")->limit("$Page->firstRow,$Page->listRows")->select();

		$result = M("Message")->field('as_message.img,as_message.id,as_message.title,as_message.title,as_message.ctime,as_category.title as fenlei')->join('right Join as_category ON as_category.id = as_message.category_id')->where("as_message.status='0'")->order("as_message.id desc")->limit("$Page->firstRow,$Page->listRows")->select();


 		$this->assign("pagehtml",$pagehtml);
 		$this->assign("result",$result);

 		$this->display();
 	}
    //宠物认领审核列表
    function examinelist(){

        $condation = array();
        $condation['status'] = "1";
        $count = M("Message")->where($condation)->count();
        $count = empty($count) ? 0 : $count;
        $Page = new \Think\Page($count,10);

        $pagehtml = $Page->show();
//		$result = M("Message")->order("id desc")->limit("$Page->firstRow,$Page->listRows")->select();

        $result = M("Message")->field('as_message.img,as_message.id,as_message.title,as_message.title,as_message.ctime,as_category.title as fenlei')->join('right Join as_category ON as_category.id = as_message.category_id')->where("as_message.status='1'")->order("as_message.id desc")->limit("$Page->firstRow,$Page->listRows")->select();


        $this->assign("pagehtml",$pagehtml);
        $this->assign("result",$result);

        $this->display();
    }

    /**
     *审核宠物领养页面
     */
    function examine(){

        $id = intval(I("request.id"));

        if ($id<1){
            $this->error("操作有误");
        }

        $result = M("Message")
            ->field('as_message.img,as_message.id,as_message.title,as_message.content,as_category.title as fenlei')
            ->join('right Join as_category ON as_category.id = as_message.category_id')
            ->where("as_message.id=".$id)
            ->find();

        $this->assign("result",$result);
        $this->display();

    }
    //审核操作
    function examine_do(){
        $id = intval(I("request.id"));
        if (I("request.type") == 'no') {
            $img = M("Message")->where("id=" . $id)->select()[0]['img'];
            $img_file = 'Public/Uploads/' . $img;
            @unlink($img_file);
            $result = M("Message")->where("id=" . $id)->delete();
            if ($result) {
                $this->error("未通过审核,已删除!", U("Admin/Message/examinelist"));
                exit;
            }
        }

        $data['status'] = "0";
        $result = M("Message")->where('id='.$id)->save($data);
        if($result){
            $this->success("通过审核!",U("Admin/Message/examinelist"));
        }
    }



        /**
	 * 添加信息页面展示
	 */
 	function add(){
		$category = M("Category")->select();
		$this->assign("category",$category);
 		$this->display();
 	}

	/**
	 * 添加信息
	 */
 	function add_do(){

    $data['title'] = I("post.title");
    $data['content'] = I("post.content");
    $data['info'] = ($data['content'])?(substr($data['content'],0,255)) : "";
    $data['category_id'] = I("post.category_id");
    $data['ctime'] = time();

    //图片上传
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize = 3145728 ;// 设置附件上传大小
    $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    $upload->rootPath = './Public/Uploads/'; // 设置附件上传根目录
    $upload->savePath = ''; // 设置附件上传（子）目录
    // 上传文件
    $info = $upload->upload();

    $data['img'] = $info['img']['savepath'].$info['img']['savename'];

    $result = M("Message")->add($data);

    if($result){
        $this->success("添加成功",U("Admin/Message/index"));
        exit;
    }

}

	/**
	 * 编辑信息页面展示
	 */
 	function edit(){
 		 	
 		$id = intval(I("request.id"));
 
 		if ($id<1){
 			$this->error("操作有误");
 		}

		$category = M("Category")->select();
		$this->assign("category",$category);
 		
 		$result = M("Message")->where("id=".$id)->find();
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
		$data['category_id'] = I("post.category_id");
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

 		$result = M("Message")->where('id='.$id)->save($data);
 		if($result){
			$this->success("修改成功");
 		}
 		
 	}


	/**
	 * 删除信息列表
	 */
 	function del_by_id(){
 		
 		$id = intval(I("request.id",0));

        $img =  M("Message")->where("id=".$id)->select()[0]['img'];
        $img_file = 'Public/Uploads/'.$img;
        @unlink($img_file);
        $result = M("Message")->where("id=".$id)->delete();

        if($result){
            $this->success("删除成功！");
        }else{
            $this->error("删除失败！");
        }

 	}

}