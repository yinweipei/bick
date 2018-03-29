<?php
namespace app\admin\controller;
use app\admin\model\Admin as AdminModel;

class Admin extends Common
{

    public function lst()
    {
        $auth=new Auth();
        $admin=new AdminModel();
        $adminres=$admin->getadmin();
        foreach ($adminres as $k => $v) {
            $_groupTitle=$auth->getGroups($v['id']);
            $groupTitle=$_groupTitle[0]['title'];
            $v['groupTitle']=$groupTitle;
        }
        //dump($adminres);die();
        $this->assign('adminres',$adminres);
        return view();
    }

    public function add()
    {
        if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('Admin');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $admin=new AdminModel();
            //$res = db('admin')->insert(input('post.'));
            if($admin->addadmin($data)){
                 $this->success('添加管理员成功！',url('lst'));
            }else{
                 $this->error('添加管理员失败！');
            }
         }
         $authGroupRes=db('auth_group')->select();
         $this->assign('authGroupRes',$authGroupRes);
    	 return view();
    }

    public function edit($id)
    {
        $admins=db('admin')->field('id,name')->find($id);
        if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('Admin');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
    
            $admin=new AdminModel();
            $res=$admin->saveadmin($data);            
            if($res){
                $this->success('修改成功！',url('lst'));
            }else{
                $this->error('修改失败！');
            }
        }
        
        if(!$admins){
            $this->error('该管理员不存在');
        }
        $authGroupAccess=db('auth_group_access')->where(array('uid'=>$id))->find();
        $authGroupRes=db('auth_group')->select();
        $this->assign('authGroupRes',$authGroupRes);
        $this->assign('admin',$admins);
        $this->assign('groupId',$authGroupAccess['group_id']);
    	return view();
    }

    public function del($id)
    {
        $admin=new AdminModel();
        $delnum=$admin->deladmin($id);
        if($delnum == '1'){
            $this->success('删除管理员成功！',url('lst'));
        }else{
            $this->error('删除管理员失败！');
        }
    }

    public function logout()
    {
        session(null);
        $this->success('退出系统成功！',url('login/index'));
    }
}
