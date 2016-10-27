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
class ProductController extends HomeController {
	//系统首页
    public function detail($id = 0){
    	//详情
    	$map['status'] = 1;
        $info = D('Product')->where($map)->find($id);
    	$this->assign('info', $info);

        //产品图片
        $galleries = D('ProductGallery')->where(array('pid'=>$id))->select();
        $this->assign('galleries', $galleries);

        //列表
        $maplists['status'] = 1;
        $maplists['id'] = array('EGT',$id);
        $lists = D('Product')->where($maplists)->order("id asc")->limit(10)->select(); 
        $this->assign('lists', $lists);
        $this->display();
    }
}