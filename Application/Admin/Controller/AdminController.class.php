<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/27 0027
 * Time: 22:45
 */

namespace Admin\Controller;


use Think\MyController;

class AdminController extends MyController
{
    public function index()
    {
        $id = $_SESSION['userid'];
        $result = M('users')->where(array('UID'=>$id))->select();
        //var_dump($result);
        $this->assign('result',$result);
        $this->display('admin/index');
    }
    public function addTask()
    {
        $this->display();
    }

}