<?php
namespace Admin\Controller;
use Admin\Controller\IndexBaseController;
class CommentController extends IndexBaseController {
	
	public function __construct(){
		parent::__construct();
	}

	/**
	 * 评论的列表页面
	 */
 	public function index(){
 		

 		$count = M("Comment")->count();
	   	$count = empty($count) ? 0 : $count;
	   	$Page = new \Think\Page($count,10);
 	
	   	$pagehtml = $Page->show();
 		$result = M("Comment")->order("id desc")->limit("$Page->firstRow,$Page->listRows")->select();

		foreach($result as $k=>$v)
		{
			$result[$k]['user'] = M("user")->where('uid='.$v['uid'])->find();
			$result[$k]['message'] = M("message")->where('id='.$v['message_id'])->find();
		}


 		$this->assign("keyword",$keyword);
 		$this->assign("pagehtml",$pagehtml);
 		$this->assign("result",$result);

 		$this->display();
 	}


	/**
	 * 编辑评论
	 */
 	function edit(){

 		$id = intval(I("request.id"));

 		if ($id<1){
 			$this->error("操作有误");
 		}

 		$result = M("Comment")->where("id=".$id)->find();

		$result['user'] = M("user")->where('uid='.$result['uid'])->find();
		$result['message'] = M("message")->where('id='.$result['message_id'])->find();

 		$this->assign("result",$result);
 		$this->display();
 	}

	/**
	 * 编辑评论
	 */
 	function edit_do(){

 		$id = intval(I("request.id"));
		$data['content'] = I("post.content");

 		$result = M("Comment")->where('id='.$id)->save($data);
			$this->success("修改成功");

 	}

    /**
     * 删除评论
     */
    function del_by_id(){

        $id = intval(I("request.id",0));

        $message_id = M("Comment")->field("message_id")->where("id=".$id)->select()[0]["message_id"];

        M("Message")->where("id=".$message_id)->setDec("comment_num");
        $result =  M("Comment")->where("id=".$id)->delete();
        if($result) {
            $this->success("删除成功！");
        }else{
            $this->error("删除失败！");
        }
    }



}