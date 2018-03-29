<?php
namespace app\Admin\controller;
use app\admin\model\Cate as CateModel;
use app\admin\model\Article as ArticleModel;

class Article extends Common
{
    public function lst()
    {
        $artres=db('article')->field('a.*,b.catename')->alias('a')->join('bk_cate b','a.cateid=b.id')->paginate(2);
        $this->assign('artres',$artres);
        return view();
    }

    public function add()
    {
        if(request()->isPost()){
            $data=input('post.');
            $data['time']=time();
            $validate = \think\Loader::validate('Article');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            // if($_FILES['thumb']['tmp_name']){
            //     $file=request()->file('thumb');
            //     $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            //     if($info){
            //         $thum = ROOT_PATH . 'public' . DS . 'uploads'.'/'.$info->getSaveName();
            //         $data['thumb']=$thum;
            //     }
            // }
            $article=new ArticleModel;
            if($article->save($data)){
                $this->success('添加文章成功！',url('lst'));
            }else{
                $this->error('添加文章失败！');
            }
            return;
        }
        $cate = new CateModel();
        $cateres=$cate->catetree();
        $this->assign('cateres',$cateres);
        return view();
    }

    public function edit()
    {
        if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('Article');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }

            $article=new ArticleModel;
            $save=$article->update($data);
            if($save){
                $this->success('修改文章成功！',url('lst'));
            }else{
                $this->error('修改文章失败！');
            }
        }
        $cate = new CateModel();
        $cateres=$cate->catetree();
        $arts=db('article')->find(input('id'));

        $this->assign('arts',$arts);
        $this->assign('cateres',$cateres);
        return view();
    }

    public function del()
    {
        if(ArticleModel::destroy(input('id'))){
            $this->success('删除文章成功！',url('lst'));
        }else{
            $this->error('删除文章失败！');
        }
    }
}
