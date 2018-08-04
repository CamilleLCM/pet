<?php
namespace Index\Model;

use Think\Model;

class DepartmentModel extends Model
{
    //自动验证
    protected $_validate = array(
        array('title', 'require', '标题不能为空！', 1, '', 3),
        array('img', 'require', '没有上传图片！', 1, '', 3),
        array('content', 'require', '宠物简介不能为空！', 1, '', 3),

    );


}