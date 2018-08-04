<?php
namespace Index\Controller;
use Index\Controller\IndexBaseController;
class YijianController extends IndexBaseController {
	
	public function __construct(){
		parent::__construct();
		
	}

	public function index()
	{
		$this->display();
	}

	public function add(){
		$this->current_user_a = $this->get_current_user_a();
		if(empty($this->current_user_a)){
			$this->error("请先登录",U("Authority/index"));
		}

		$content = I("request.content");

		$data['content'] = $content;
		$data['uid'] = $this->current_user_a['uid'];
		$data['ctime'] = time();

		M('yijian')->add($data);

		$this->success("我们已经收到你的意见",U("Index/Index/index"));
	}
}