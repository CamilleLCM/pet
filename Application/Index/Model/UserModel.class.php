<?php
namespace Index\Model;

use Think\Model;

class UserModel extends Model
{
    //自动验证
    protected $_validate = array(
        array('name', 'require', '用户名不能为空！', 1, '', 3),
        array('name','','用户名已经存在！',0,'unique',1),
        array('pwd', 'require', '密码不能为空！', 1, '', 3),
        array('mobile', '', '该电话已存在！', 1, 'unique', 3),
        array('mobile', 'require', '电话不能为空！', 1, '', 3),
        array('mobile','/^1[3|4|5|8][0-9]\d{4,8}$/','手机号码错误！','0','regex',1),
        array('email', 'require', '邮箱不能为空！', 1, '', 3),
        array('email', '', '邮箱已存在！', 1, 'unique', 3),
        array('email','email','email格式错误'),
    );


}