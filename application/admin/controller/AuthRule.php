<?php
namespace app\Admin\controller;
use app\admin\model\AuthRule as AuthRuleModel;

class AuthRule extends Common
{ 
    public function lst()
    {
        $authRule=new AuthRuleModel();
        if(request()->isPost()){
            $sorts=input('post.');
            foreach ($sorts as $k => $v) {
                $authRule->update(['id'=>$k,'sort'=>$v]);
            }
            $this->success('更新排序成功！',url('lst')); 
            return;
        }

        $authRuleRes=$authRule->authRuleTree();
        $this->assign('authRuleRes',$authRuleRes);
        return view();
    }

    public function add()
    {
        if(request()->isPost()){
            $data=input('post.');
            $plevel=db('auth_rule')->where('id',$data['pid'])->field('level')->find();
            if($plevel){
                $data['level']=$plevel['level']+1;
            }else{
                $data['level']=0;
            }
            
            $add=db('auth_rule')->insert($data);
            if($add){
                $this->success('添加权限成功！',url('lst'));
            }else{
                $this->error('添加权限失败！');
            }
            return;     
        }
        $authRule=new AuthRuleModel();
        $authRuleRes=$authRule->authRuleTree();
        $this->assign('authRuleRes',$authRuleRes);
        return view();
    }
    
    public function edit()
    {
        if(request()->isPost()){
            $data=input('post.');
            $plevel=db('auth_rule')->where('id',$data['pid'])->field('level')->find();
            if($plevel){
                $data['level']=$plevel['level']+1;
            }else{
                $data['level']=0;
            }

            $save=db('auth_rule')->update($data);
            if($save !== false){
                $this->success('修改权限成功！',url('lst'));
            }else{
                $this->error('修改权限失败！');
            }
            return;  
        }
        $authRule=new AuthRuleModel();
        $authRuleRes=$authRule->authRuleTree();
        $authRules=$authRule->find(input('id'));

        $this->assign('authRules',$authRules);//原有信息
        $this->assign('authRuleRes',$authRuleRes);//权限子树
        return view();
    }

    public function del()
    {
        $authRule=new AuthRuleModel();
        $authRuleIds=$authRule->getchildrenid(input('id'));
        $authRuleIds[]=input('id');
       
        $del=AuthRuleModel::destroy($authRuleIds);
        if($del !== false){
            $this->success('删除权限成功！',url('lst'));
        }else{
            $this->error('删除权限失败！');
        }
    }
}
