<?php
namespace Admin\Controller;
use Common\Controller\BaseController;
class IndexBaseController extends BaseController {
	
	
	function  _initialize(){
		parent::_initialize();	
		
		$validate = array("Authority");
		if(!in_array(CONTROLLER_NAME, $validate)){
			
			if(empty($this->current_user)){
				redirect(U('Admin/Authority/sign_in'));
			}
		}	
	}
	
	function __construct(){

		parent::__construct();
	
	}
	


}