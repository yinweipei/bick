<?php
namespace app\admin\model;
use think\Model;

class AuthRule extends Model
{
	public function authRuleTree()
	{
		$authRuleTree=$this->order('sort desc')->select();
		return $this->sort($authRuleTree);
	}

	public function sort($data,$pid=0)
	{
		static $arr=array();
		foreach ($data as $k => $v) {
			if($v['pid']==$pid){
				$v['dataid']=$this->getparentid($v['id']);
				$arr[]=$v;
				$this->sort($data,$v['id']);
			}
		}
		return $arr;
	}

	public function getchildrenid($authRuleId)
	{
		$authRuleRes=$this->select();
		return $this->_getchildrenid($authRuleRes,$authRuleId);
	}

	public function _getchildrenid($authRuleRes,$authRuleId)
	{
		static $arr = array();
		foreach ($authRuleRes as $k => $v) {
			if($v['pid']==$authRuleId){
				$arr[]=$v['id'];
				$this->_getchildrenid($authRuleRes,$v['id']);
			}
		}
		return $arr;
	}

	public function getparentid($authRuleId)
	{
		$authRuleRes=$this->select();
		return $this->_getparentid($authRuleRes,$authRuleId,true);
	}

	public function _getparentid($authRuleRes,$authRuleId,$clear=false)
	{
		static $arr = array();
		if($clear){
			$arr=array();
		}
		foreach ($authRuleRes as $k => $v) {
			if($v['id']==$authRuleId){
				$arr[]=$v['id'];
				$this->_getparentid($authRuleRes,$v['pid'],false);
			}
		}
		asort($arr);
		$arrStr=implode('-', $arr);
		return $arrStr;
	}
}