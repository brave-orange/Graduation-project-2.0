<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/23 0023
 * Time: 17:54
 */

namespace Admin\Controller;
use Admin\Model\UsersModel;
use Think\MyController;

class RegisterController extends MyController
{
    public function index()
    {
        $this->display('index');
    }
    public function register()
    {
        $id = $_POST['userid'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $password = $_POST['password2'];

        $users = D('Users');
        $data['UID'] = $id;
        $data['name'] = $name;
        $data['Phone'] = $phone;
        $data['password'] = md5($password);
        //var_dump($password,$data);
        $res = $users->register($data);

        if($res)
        {
            echo "注册成功";

        }else{
            echo "注册失败";
        }
    }

}