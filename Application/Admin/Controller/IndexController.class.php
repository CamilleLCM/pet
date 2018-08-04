<?php
namespace Admin\Controller;
use Admin\Controller\IndexBaseController;
class IndexController extends IndexBaseController {
	
    public function index(){ 
    	
    	
    	redirect(U('Admin/Pet/index'));
    }
    
    
    
}