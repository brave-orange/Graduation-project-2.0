<?php
namespace Admin\Model;

class AdminAuthGroupAccessModel extends BaseModel
{
    protected $tableName = 'admin_auth_group_access';
    
    /**
     * 获取用户所有权限
     * @author luduoliang <luduoliang@imohoo.com> (2016/12/02)
     */
    public function getUserRules($user_id)
    {
        
        $where = array(
            'a.uid' => $user_id,
        );
        $join = 'LEFT JOIN admin_auth_group b ON b.id=a.group_id';
        $rules = $this->alias('a')
                      ->where($where)
                      ->join($join)
                      ->field('b.rules')
                      ->select();
       
        if(!$rules){
            return array();
        }
        
        $rules_str = '';
        foreach($rules as $v){
            $rules_str .= $v['rules'] . ',';
        }
        
        $rules_str = rtrim($rules_str, ',');  //移除最右侧的逗号

        $rules_arr = array_unique(explode(',', $rules_str));//以逗号分开成数组，并且移除重复的
        
        $admin_menu_model = new AdminMenuModel();
        $menus = $admin_menu_model->getMenus($rules_arr);
        
      
        $menus = get_column($menus, 2);
        
        //dump($menus);exit;
        return $menus;
        
    }
}