<?php
namespace Index\Controller;
use Index\Controller\IndexBaseController;
class MessageController extends IndexBaseController {
	
	public function __construct(){
		parent::__construct();
		
	}

	/**
	 * 带分页的信息展示
	 */
	public function index(){

		//查询条件
		$condation = array();
        $condation['status'] = 0;
		//分类id
		$category_id = intval(I("request.category_id"));
		if(!empty($category_id)){
			$condation['category_id'] = $category_id;
		}

		//标题

		$title = trim(I("request.title"));
		if(!empty($title)){
            $condation['_string'] = " title like '%{$title}%'  OR  content like '%{$title}%' ";
		}


		$count = M("Message")->where($condation)->count();
		$count = empty($count) ? 0 : $count;
		$Page = new \Think\Page($count,3);

		//分页的html
		$pagehtml = $Page->show();

		$message = M("Message")->where($condation)->order("id desc")->limit("$Page->firstRow,$Page->listRows")->select();
		$message_coment = M("Message")->where("status=0")->order("comment_num desc")->limit(8)->select();
		$this->assign('message_coment', $message_coment);

		$this->assign('current', 'message');
		$this->assign('result', $message);
		$this->assign('pagehtml', $pagehtml);
 		$this->display();
	}

    /**
     * 添加趣事或知道先登录再进入添加界面
     */

	public function add(){

        if(empty($_SESSION['current_user_a']) || $_SESSION['current_user_a'] == " "){
            $this->error("请先登录~",U("Index/Authority/index"));
        }
        $category = M("Category")->select();
        $this->assign("category",$category);
        $this->display();
    }

    /**
     * 添加趣事或知道先登录再实现功能
     */
    function add_do(){

        if(empty($_SESSION['current_user_a']) || $_SESSION['current_user_a'] == " "){
            $this->error("请先登录~",U("Index/Authority/index"));
        }

        $data['title'] = I("post.title");
        $data['content'] = I("post.content");
        $data['info'] = ($data['content'])?(substr($data['content'],0,255)) : "";
        $data['category_id'] = I("post.category_id");
        $data['status'] = 1;
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

        //等待审核
        $result = D("Message");
        if($result->create($data)){
            if($result->add()){
                $this->success("添加成功,等待审核~",U("Index/Message/index"));
            }
            $this->error("添加失败!");
        }else{
            $this->error($result->getError());
        }

    }


	/**
	 * 详情展示
	 */
	public function info(){

		$id = intval(I('request.id'));

		//查询一条记录
		$result = M("Message")->where('id='.$id)->find();
		$this->assign('result',$result);

		$message_coment = M("Message")->where("status=0")->order("comment_num desc")->limit(8)->select();
		$this->assign('message_coment', $message_coment);

		$comment = M('comment')->where('message_id='.$id)->select();
		foreach($comment as $k=>$v)
		{
			$comment[$k]['user'] = M("user")->where('uid='.$v['uid'])->find();
		}
        $result = M("Message")
                ->field('as_category.title')
		        ->join('as_category')
                ->where("as_category.id = as_message.category_id and as_message.id = {$id}")
                ->select();
		$title = $result[0]["title"];

		$this->assign('title',$title);
        $this->assign('comment', $comment);
		$this->display();
	}

	/**
	 * 添加评论
	 */
	public function comment()
	{


        if(empty($_SESSION['current_user_a']) || $_SESSION['current_user_a'] == " "){

            $this->error("请先登录~",U("Index/Authority/index"));

        }
        $this->current_user_a = $this->get_current_user_a();

		$id = intval(I('request.id'));
		$content = I("request.content");
		$data['message_id'] = $id;
		$data['content'] = $content;
		$data['uid'] = $this->current_user_a['uid'];
		$data['ctime'] = time();
        M('comment')->add($data);


		M('message')->where('id='.$id)->setInc('comment_num');

		$this->success("评论成功");

	}
}