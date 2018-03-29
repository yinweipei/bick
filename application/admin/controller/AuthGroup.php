<?php
namespace app\Admin\controller;
use app\admin\model\AuthGroup as AuthGroupModel;

class AuthGroup extends Common
{ 
    public function lst()
    {
        $authGroupRes=AuthGroupModel::paginate(2);
        $this->assign('authGroupRes',$authGroupRes);
        return view();
    }

    public function add()
    {
        if(request()->isPost()){
            $data=input('post.');
            if($data['rules']){
                $data['rules']=implode(',',$data['rules']);
            }

            $add=db('auth_group')->insert($data);
            if($add){
                $this->success('添加用户组成功！',url('lst'));
            }else{
                $this->error('添加用户组成失败！');
            }
            return;
        }
        $authRule=new \app\admin\model\AuthRule();
        $authRuleRes=$authRule->authRuleTree();
        $this->assign('authRuleRes',$authRuleRes);
        return view();
    }

    public function edit()
    {
        if(request()->isPost()){
            $data=input('post.');
            if($data['rules']){
                $data['rules']=implode(',',$data['rules']);
            }
            
            $_data=array_keys($data);
            //dump($_data);die();
            if(!in_array('status',$_data)){
                $data['status']=0;
            }
            $save=db('auth_group')->update($data);
            if($save !== false){
                $this->success('修改用户组成功！',url('lst'));
            }else{
                $this->error('修改用户组失败！');
            }
            return;
        }
        $authRule=new \app\admin\model\AuthRule();
        $authRuleRes=$authRule->authRuleTree();
        $this->assign('authRuleRes',$authRuleRes);
        $authgroups=db('auth_group')->find(input('id'));
        $this->assign('authgroups',$authgroups);
        return view();
    }

    public function del()
    {
        $del=db('auth_group')->delete(input('id'));
        if($del){
            $this->success('删除用户组成功！',url('lst'));
        }else{
            $this->error('删除用户组成失败！');
        }
    }
}
