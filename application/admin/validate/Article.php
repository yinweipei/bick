<?php 
namespace app\admin\validate;
use think\Validate;

class Article extends Validate
{
	protected $rule = [
        'title'  =>  'unique:article|require|max:25',
        'cateid' =>  'require',
        'content' =>  'require',
    ];

    protected $message  =   [
        'title.require' => '文章标题不得为空',
        'title.max' => '文章标题不得超过25个字符',
        'title.unique' => '文章标题不得重复',
        'cateid.require' => '文章地址不得为空',
        'content.require' => '文章内容不得为空',
    ];

    protected $scene  =  [
    	'add' => ['title','cateid','content'],
    	'edit' => ['title','cateid','content'],
    ];

} 