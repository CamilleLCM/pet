<?php
namespace Index\Controller;
use Index\Controller\IndexBaseController;
class DepartmentController extends IndexBaseController {
	
	public function __construct(){
		parent::__construct();
		
	}

	/**
	 * 带分页的信息展示
	 */
	public function index(){

		//查询条件
		$condition = array();

		//宠物id
		$id = intval(I("request.id"));
        $condition['status'] = 0;
		if(!empty($id)){
            $condition['id'] = $id;
		}

		//搜索
		$title = trim(I("request.title"));

		if(!empty($title)){
            $condition['_string'] = " title like '%{$title}%'  OR  content like '%{$title}%'";
		}

		$count = M("Department")->where($condition)->count();

		$count = empty($count) ? 0 : $count;
		$Page = new \Think\Page($count,3);


		//分页的html
		$pagehtml = $Page->show();
		$message = M("Department")->where($condition)->order("id desc")->limit("$Page->firstRow,$Page->listRows")->select();

		$this->assign('title', $title);

		$this->assign('current', 'pet');
		$this->assign('result', $message);
		$this->assign('pagehtml', $pagehtml);
 		$this->display();
	}

    /*添加信息
    先登录
    */
    function add(){

        if(empty($_SESSION['current_user_a']) || $_SESSION['current_user_a'] == " "){
            $this->error("请先登录~",U("Index/Authority/index"));
        }

        $this->display();
    }

    /**
     * 添加宠物
     */
    function add_do(){

        if(empty($_SESSION['current_user_a']) || $_SESSION['current_user_a'] == " "){
            $this->error("请先登录~",U("Index/Authority/index"));
        }

        $data['title'] = I("post.title");
        $data['content'] = I("post.content");
        $data['status'] = "1";
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
        //审核
        $result = D("Department");
        if($result->create($data)){
            if($result->add()){
                $this->success("添加成功,等待审核~",U("Index/Department/index"));
            }
            $this->error("添加失败!");
        }else{
            $this->error($result->getError());
        }


    }



}