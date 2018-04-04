<?php
/**
 * Created by PhpStorm.
 * User: yongcheng
 * Date: 2018/3/22
 * Time: 21:40
 */

namespace Admin\Model;
use Think\BaseModel;

class UsersModel extends BaseModel
{
    public function register($user)    //注册用户
    {
        return $this->addData($user);
    }
    public function ChangeRole()    //改变角色
    {

    }
    public function GetID()
    {

    }
}