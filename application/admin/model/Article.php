<?php
namespace app\admin\model;
use think\Model;

class Article extends Model
{
	protected static function init()
    {
        Article::event('before_insert', function ($article) {
             if($_FILES['thumb']['tmp_name']){
                $file=request()->file('thumb');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    // $thum = ROOT_PATH . 'public' . DS . 'uploads'.'/'.$info->getSaveName();
                    $thum = '/bick/'. 'public' . DS . 'uploads'.'/'.$info->getSaveName();
                    $article['thumb']=$thum;
                }
            }
        });

        Article::event('before_update', function ($article) {
        	 $article['time']=time();
             if($_FILES['thumb']['tmp_name']){
             	$arts=Article::find($article->id);
             	$thumbpath=$_SERVER['DOCUMENT_ROOT'].$arts['thumb'];
                if(file_exists($thumbpath)){
                	@unlink($thumbpath);
                }
                $file=request()->file('thumb');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    $thumb = '/bick/' . 'public' . DS . 'uploads'.'/'.$info->getSaveName();
                    $article['thumb']=$thumb;
                }
            }
        });

        Article::event('before_delete', function ($article) {
             	$arts=Article::find($article->id);
             	$thumbpath=$_SERVER['DOCUMENT_ROOT'].$arts['thumb'];
                if(file_exists($thumbpath)){
                	@unlink($thumbpath);
                }
        });
    }

}