<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/31 0031
 * Time: 13:37
 */

namespace Admin\Controller;


class TaskController extends CommonController
{
    protected $admin_task_model;
    public function __construct()
    {
        parent::__construct();
        $admin_task_model = D('AdminTaskList');
        $this->admin_task_model = $admin_task_model;
    }
    public function index()
    {
        $task_list = $this->admin_task_model->getTaskList();
        $this->assign('task_list',$task_list['list']);
        $this->assign('page',$task_list['page']);
        $this->display();
    }
    public function SendTask()
    {
        $task_id = I('post.task_id', '', 'intval');
        $task_info = M('admin_form_type')->where(array('Tid' => $task_id))->select();
        $task = M('admin_task_list')->field('id,name')->where(array('id' => $task_id))->find();
        $s = array(27, 28, 29, 30);
        $user_info = M('admin_user as a')
            ->join('admin_auth_group_access as b ON a.id = b.uid')
            ->field('a.id,a.user_name,a.phone')
            ->where(array('b.group_id' => array('IN', $s)))
            ->select();//就这几个级别的能当审核人
        $user_info1 = M('admin_user')->field('id,user_name')->select();
        session('task_id',$task_id);
        $this->assign(array('task_info' => $task_info, 'user_info' => $user_info, 'user_info1' => $user_info1, 'task' => $task));
        $this->display('');

    }

    public function EditWork()
    {
        $work_id = I('post.work_id', '', 'intval');
        $work_info = M('admin_task')
            ->where(array('id'=>$work_id))
            ->find();
        $task = M('admin_task_list')->field('id,name')->where(array('id' => $work_info['tid']))->find();
        $user = M('admin_user')->where(array('id'=>$work_info['createid']))->field('user_name')->find();
        $form_data = M('admin_form_type')
            ->where(array('Tid'=>$work_info['tid']))
            ->select();

        $s = array(27, 28, 29, 30);
        $user_info = M('admin_user as a')
            ->join('admin_auth_group_access as b ON a.id = b.uid')
            ->field('a.id,a.user_name,a.phone')
            ->where(array('b.group_id' => array('IN', $s)))
            ->select();//就这几个级别的能当审核人
        $user_info1 = M('admin_user')->field('id,user_name')->select();

        //传回表单数据、工单数据、所有用户数据（用于选审核、执行人等）

        $this->assign(array('form_data' => $form_data, 'work_info' => $work_info,'user_info' => $user_info, 'user_info1' => $user_info1,'task' => $task,'user'=>$user) );
        $this->display('');


    }
    public function getTaskInfo()
    {
        $task_id = I('post.task_id', '', 'intval');
        $task_info = M('admin_form_type')->where(array('Tid' => $task_id))->select();
        $this->ajaxReturn(json_encode($task_info,JSON_UNESCAPED_UNICODE));

    }

    public function deleteTask()
    {
        $task_id = I('post.task_id','','intval');

        $result = $this->admin_task_model->deleteAdminTask($task_id);

        if($result){
            $this->ajaxSuccess("删除成功");
        }else{
            $this->ajaxError("删除失败");
        }
    }

    public function AddTaskType()         //添加工单类型
    {
        if (IS_POST) {
            $data = I('post.data','','trim');
            $task_name = I('post.task_name','','trim');
            $tablist = array('id'=>'','name'=>$task_name,'createtime'=>time());
            $body = json_decode($data,true);
            //var_dump($body);
            $res = M('admin_task_list')->where(array('name'=>$task_name))->find();

            if(count($res)<=0)
            {
                if(!(M('admin_task_list')->add($tablist)))       //将工单信息加入工单总览表中
                {
                    $this->ajaxError('系统出错！');
                }
                else {
                    $id = M('admin_task_list')->where(array('name' => $task_name))->find();        //找到新插入的工单类型的id

                    foreach ($body as $a) {
                        $datalist[] = array('Tid' => intval($id['id']),'title'=>$a['title'],'type'=>$a['body'],'ziduan'=>$a['ziduan']);
                    }
                    //var_dump($datalist);
                    $insertInfo = M('admin_form_type')->addAll($datalist);       //将工单的自定义部分写入自定义内容表
                    if (!$insertInfo) {
                        $this->ajaxError('插入内容出错！');
                    } else {
                        $this->ajaxSuccess('添加成功');
                    }
                }

            }
            else
            {
                $this->ajaxError('工单名重复！');
            }

        } else {
            $this->display();
        }
    }
    public function addTask()   //插入派发工单记录
    {
        $arr =array();
        foreach ($_POST as  $key => $value)
        {

            switch($key) {
                case "task_id":
                   $tid = $value;
                   break;
                case "user_id":
                    $createid = $value;
                    break;
                case "user_name":
                    $createname = $value;
                    break;
                case "checkid":
                    $checkid = $value;
                    break;
                case "exeid":
                    $exeid = $value;
                    break;
                default:
                    $arr[$key] = $value;
            }
        }
        $formdata = json_encode($arr,JSON_UNESCAPED_UNICODE);
        $data = array(
          'id'=>'',
          'tid'=>$tid,
          'createid'=>$createid,
          'exeid'=>$exeid,
          'checkid'=>$checkid,
          'state'=>0,
          'time'=>time(),
          'data'=>$formdata

        );
        $res = M('admin_task')->add($data);
        if($res)
        {
            $this->ajaxSuccess('派单成功');
        }else{
            $this->ajaxError('插入内容出错！');
        }
    }
    public function taskList()
    {

        $data = M('admin_task as a')
            ->join('left join admin_user as b ON a.createid = b.id')
            ->join('left join admin_user as c ON a.exeid = c.id')
            ->join('left join admin_user as d ON a.checkid = d.id')
            ->join('left join admin_task_list as e ON a.tid = e.id')
            ->field('a.id as id ,a.tid as taskid ,e.name as tid ,b.user_name as createid ,c.user_name as exeid, d.user_name as checkid , a.time as time,a.state as state')
            ->select();

        $user_info = M('admin_user')->field('id,user_name')->select();
        $this->assign(array('data'=>$data,'user_info'=>$user_info));
        $this->display();
    }

    public function deleteWorks()
    {
        $task_id = I('post.work_id','','intval');

        $result = M('admin_task')->where(array('id'=>$task_id))->delete();

        if($result){
            $this->ajaxSuccess("删除成功");
        }else{
            $this->ajaxError("删除失败");
        }
    }
}