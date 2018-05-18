<?php
namespace Admin\Controller;

class IndexController extends CommonController {
    public function index()
    {
        $user_info = session('user_info');
        /* @var $admin_auth_group_access_model \Admin\Model\AdminAuthGroupAccessModel */
        $admin_auth_group_access_model = D('AdminAuthGroupAccess');
        $menus = $admin_auth_group_access_model->getUserRules($user_info['id']);
        
        $this->assign('menus', $menus);
        $this->display();
    }
    
    public function nav()
    {
        $this->display();
    }
    
    
    public function login()
    {
       $this->display();
    }
    
    public function form()
    {
        $this->display();
    }
    
    
    public function table()
    {
       $this->display();
       
    }
    
    public function main()
    {
        $userid = $_SESSION['user_info']['id'];
        $where =  array('exeid'=>$userid,'a.state'=>0);
        $recive = M('admin_task as a') //待接单任务
            ->join('left join admin_user as b ON a.createid = b.id')
            ->join('left join admin_user as c ON a.exeid = c.id')
            ->join('left join admin_user as d ON a.checkid = d.id')
            ->join('left join admin_task_list as e ON a.tid = e.id')
            ->field('a.id as id ,a.level,a.tid as taskid ,e.name as tid ,b.user_name as createid ,c.user_name as exeid, d.user_name as checkid , a.time as time,a.state as state,a.title as title')
            ->where($where)
            ->select();
        $where =  array('checkid'=>$userid,'a.state'=>3);
        $check = M('admin_task as a')//待审核
            ->join('left join admin_user as b ON a.createid = b.id')
            ->join('left join admin_user as c ON a.exeid = c.id')
            ->join('left join admin_user as d ON a.checkid = d.id')
            ->join('left join admin_task_list as e ON a.tid = e.id')
            ->field('a.id as id ,a.level,a.tid as taskid ,e.name as tid ,b.user_name as createid ,c.user_name as exeid, d.user_name as checkid , a.time as time,a.state as state,a.title as title')
            ->where($where)
            ->select();
        $where =  array('exeid'=>$userid,'a.state'=>1);
        $exe = M('admin_task as a')    //待执行
            ->join('left join admin_user as b ON a.createid = b.id')
            ->join('left join admin_user as c ON a.exeid = c.id')
            ->join('left join admin_user as d ON a.checkid = d.id')
            ->join('left join admin_task_list as e ON a.tid = e.id')
            ->field('a.id as id ,a.level,a.tid as taskid ,e.name as tid ,b.user_name as createid ,c.user_name as exeid, d.user_name as checkid , a.time as time,a.state as state,a.title as title')
            ->where($where)
            ->select();
        $where = array('exeid'=>$userid,'a.state'=>array('GT',1));
        $ing = M('admin_task as a')    //待执行
        ->join('left join admin_user as b ON a.createid = b.id')
            ->join('left join admin_user as c ON a.exeid = c.id')
            ->join('left join admin_user as d ON a.checkid = d.id')
            ->join('left join admin_task_list as e ON a.tid = e.id')
            ->field('a.id as id ,a.level,a.tid as taskid ,e.name as tid ,b.user_name as createid ,c.user_name as exeid, d.user_name as checkid , a.time as time,a.state as state,a.title as title')
            ->where($where)
            ->select();
        $this->assign(array('recive_num'=>count($recive),'check_num'=>count($check),'exe_num'=>count($exe),'check_info'=>$check,'exe_info'=>$exe,'recive'=>$recive,'ing_info'=>$ing));
        $this->display();
    }
    public function upload()
    {
        if(IS_POST){
           $img = $_FILES['file'];
           $upload = new \Think\Upload();// 实例化上传类
           $upload->maxSize   = 3145728 ;// 设置附件上传大小
           $upload->exts      = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
           $upload->rootPath  = './Public/'; // 设置附件上传根目录
           $upload->savePath  = 'upload/'; // 设置附件上传（子）目录
           // 上传文件
           $info   =   $upload->uploadOne($img);
          
          
           if(!$info) {// 上传错误提示错误信息
               echo json_encode(array('status' => 'error','msg' => $upload->getError()));
               exit;
           }else{// 上传成功
               
               $imgpath = $info['savepath'].$info['savename'];
               echo json_encode(array('status' => 'success','url'=>'/Public/'.$imgpath));
               exit;
           }
           
        }else{
            $this->display();
        }
        
    }
    //验证码
    public function verify(){
        $Verify = new \Think\Verify();   
        $Verify->codeSet = '0123456789';// 设置验证码字符为纯数字   
        $Verify->length = 4;
        $Verify->imageH = 37;
        $Verify->imageW = 120;
        $Verify->fontSize = 18;
        $Verify->useNoise = true;
        $Verify->useCurve = true;
        $Verify->fontttf = "5.ttf";
        $Verify->bg = array(196,223,246);    
        $Verify->entry();    
    }

    public function getSbWorkinfo(){
        $uid = $_POST['uid'];

        $exe_num = M('admin_task')
            ->where(array('exeid'=>$uid))
            ->count();
        $check_num = M('admin_task')
            ->where(array('checkid'=>$uid))
            ->count();
        $create_num = M('admin_task')
            ->where(array('createid'=>$uid))
            ->count();
        $str = array(array('value'=>$create_num,'name'=>'我创建任务数'),array('value'=>$exe_num,'name'=>'我执行任务数'),array('value'=>$check_num,'name'=>'我审核任务数'));
        $this->ajaxReturn($str);
    }
    public function getSbWorkcount(){      //七天的工作分布的工作
        $date = strtotime(date('Y-m-d',time()))-604800;
        $uid = $_POST['uid'];
        while($date<strtotime(date('Y-m-d',time()))){
            $exe[] = M('admin_task')->where(array('exe_time'=>array('between',array($date,$date+86400)),'exeid'=>$uid))->count();
            $check[] = M('admin_task')->where(array('check_time'=>array('between',array($date,$date+86400)),'checkid'=>$uid))->count();
            $create[] = M('admin_task')->where(array('time'=>array('between',array($date,$date+86400)),'createid'=>$uid))->count();
            $date1[] = date('m-d',$date);
            $date += 86400;
        }
        $str = array('exe'=>$exe,'check'=>$check,'create'=>$create,'date'=>$date1);
        $this->ajaxReturn($str);
    }


}