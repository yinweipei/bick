<?php
namespace app\index\controller;
use think\Controller;

class Common extends Controller
{
    public function _initialize()
    {
        $conf = new \app\index\model\Conf();
        $_confres=$conf->getAllConf();
        $confres=array();
        foreach ($_confres as $k => $v) {
        	$confres[$v['enname']]=$v['cnname'];
        }
        //dump($confres);
        $this->assign('confres',$confres);
    }

    public function abc()
    {
    	echo "abc";
    }
}
