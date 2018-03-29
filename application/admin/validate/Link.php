<?php 
namespace app\admin\validate;
use think\Validate;

class Link extends Validate
{
	protected $rule = [
        'title'  =>  'unique:link|require|max:25',
        'url' =>  'unique:link|require|max:60',
        'desc' =>  'require',
    ];

    protected $message  =   [
        'title.require' => '链接标题不得为空',
        'title.max' => '链接标题不得超过25个字符',
        'title.unique' => '链接标题不得重复',
        'url.unique' => '链接地址不得重复',
        'url.require' => '链接地址不得为空',
        'desc.require' => '链接描述不得为空',
    ];

    protected $scene  =  [
    	'add' => ['title','url','desc'],
    	'edit' => ['title','url'],
    ];

} 