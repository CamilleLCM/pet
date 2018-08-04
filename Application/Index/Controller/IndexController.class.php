<?php
namespace Index\Controller;
use Index\Controller\IndexBaseController;
class IndexController extends IndexBaseController {
    public function __construct(){
        parent::__construct();

    }
    public function index(){ 
        //banner
        $banner = M('Banner')->select();

        //宠物课堂
        $pet = M('Pet')->order('id desc')->limit('10')->select();

        //宠物认领
        $department = M('department')->order('id desc')->limit('10')->select();

        //趣事知道
        $message = M('Message')->order('id desc')->limit('10')->select();



        $this->assign('department',$department);
        $this->assign('message',$message);
        $this->assign('current','index');
        $this->assign('banner',$banner);
        $this->assign('pet',$pet);

  	    $this->display();
    }

}