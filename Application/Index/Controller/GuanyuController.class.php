<?php
namespace Index\Controller;
use Index\Controller\IndexBaseController;
class GuanyuController extends IndexBaseController {



    public function index(){ 

        $result = M("Guanyu")->find();

        $this->assign("current", "guanyu");
        $this->assign("result",$result);
  	  $this->display();
    }
    
}