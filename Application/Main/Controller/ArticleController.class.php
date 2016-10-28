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
class ArticleController extends HomeController {

	//系统首页
    public function detail($id = 0){
    	//48小时快报
    	$map['create_time'] = array('gt',(time()-3600*48));
    	$hots = D('Document')->where($map)->limit('10')->order('create_time asc')->lists(null);
    	$this->assign('hots',$hots);
    	//文章信息
    	$Document = D("Document");
    	$info = $Document->detail($id);
    	$this->assign('info', $info);
        $this->display();
    }
    public function news(){
        $Document = D("Document");
        $news = $Document->page(1,20)->lists(null);
       
        $this->assign('news', $news);
        $this->display();
    }
}