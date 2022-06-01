<?php
namespace addons\ppvod\controller;
use think\Db;

class Index extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
	
		
		 return $this->view->fetch('/index');
	}

    public function del()
    {
        $param = input();
        $ids = $param['ids'];
        $all = $param['all'];
        if(!empty($ids)){
            $where=[];
            $where['plog_id'] = ['in',$ids];
            if($all==1){
                $where['plog_id'] = ['gt',0];
            }
            $res = model('Plog')->delData($where);
            if($res['code']>1){
                return $this->error($res['msg']);
            }
            return $this->success($res['msg']);
        }
        return $this->error('参数错误');
    }

}
