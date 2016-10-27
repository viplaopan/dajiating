<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Main\Controller;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends HomeController {

	//系统首页
    public function index(){
    	//48小时快报
    	$map['create_time'] = array('gt',(time()-3600*48));
    	$hots = D('Document')->where($map)->limit('10')->order('create_time asc')->lists(null);
    	$this->assign('hots',$hots);
    	
        //最新资讯
    	$lists = D('Document')->limit('10')->order('create_time desc')->lists(null);
    	$this->assign('lists',$lists);

        //新产品
        $pr['status'] = 1;
        $pros = D('Product')->where($pr)->limit(10)->order("create_time desc")->select();
        $this->assign('pros',$pros);
        $this->display();
    }

}