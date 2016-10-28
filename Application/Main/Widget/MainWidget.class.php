<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Main\Widget;
use Think\Controller;

/**
 * 分类widget
 * 用于动态调用分类信息
 */

class MainWidget extends Controller{
	
	/* 显示指定分类的同级分类或子分类列表 */
	public function topHtml(){
		//Banner
                $ban['status'] = 1;
                $ban['pos_id'] = 5;
                $banners = D('Adv')->where($ban)->order('sort desc')->select();
                $this->assign('banners',$banners);

                //four
                //Banner
                $four['status'] = 1;
                $four['pos_id'] = 6;
                $fours = D('Adv')->where($four)->limit(4)->order('sort desc')->select();
                $this->assign('fours',$fours);
        	$this->display('Widget/tophtml');
	}
        public function hour24(){
                //48小时快报
                $map['create_time'] = array('gt',(time()-3600*48));
                $hots = D('Document')->where($map)->limit('10')->order('create_time asc')->lists(null);
                $this->assign('hots',$hots);
                $this->display('Widget/hour24');
        }
        /* 显示指定分类的同级分类或子分类列表 */
        public function newsBanner(){
                //Banner
                $ban['status'] = 1;
                $ban['pos_id'] = 7;
                $banners = D('Adv')->where($ban)->order('sort desc')->select();
                $this->assign('banners',$banners);

                
                $this->display('Widget/newsBanner');
        }
	
}
