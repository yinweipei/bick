<?php
namespace app\admin\controller;
use think\Request;
class Index extends Common
{
    public function index(Request $request)
    {
    	//session('name','chenzewen');
    	//dump($request->session());die;
        return view();
    }
}
