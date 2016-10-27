<?php
/**
 * Created by PhpStorm.
 * User: caipeichao
 * Date: 14-3-14
 * Time: AM10:59
 */

namespace Admin\Controller;

use Admin\Builder\AdminListBuilder;
use Admin\Builder\AdminConfigBuilder;
use Admin\Builder\AdminSortBuilder;

class ProductController extends AdminController
{
    public function index($page = 1, $r = 20)
    {
        //读取产品
        $map = array('status' => array('EGT', 0));
        $model = M('Product');
        $lists = $model->where($map)->page($page, $r)->order('create_time desc')->select();
        $totalCount = $model->where($map)->count();

        //显示页面
        $builder = new AdminListBuilder();
        $builder->title('新产品列表')
            ->buttonNew(U('edit'))
            ->buttonDelete()
            ->setStatusUrl(U('setStatus'))
            ->keyId()
            ->keyTitle()
            ->keyCreateTime()
            ->keyStatus()
            ->keyDoActionEdit('edit?id=###')
            ->data($lists)
            ->pagination($totalCount, $r)
            ->display();
    }
    public function edit($id = 0){

        $isEdit = $id?1:0;
        $model = D('Product');
        if(IS_POST){
            $data = $model->create();
            if($isEdit){
                $data = $model->create();
                $res = $model->save($data);
                D('ProductGallery')->where('pid = '.I('post.id'))->delete();
            }else{
                $data = $model->create();
                $res = $model->add($data);
                $id = $res;
            }
            if($res){
                $pgs = I('post.ProductGallery');
                $gpData = array();
                foreach($pgs as $key=>$vo){
                    $gpData[$key]['path'] = $vo;
                    $gpData[$key]['pid'] = $id;
                }
                D('ProductGallery')->addAll($gpData);
                $this->success('提交成功');
            }else{
                $this->error('错误操作');
            }
        }else{
            //读取规则内容
            if ($isEdit) {
                $data = M('Product')->where(array('id' => $id))->find();
            } else {
                $data = array('status' => 1);
            }
            //显示页面
            $builder = new AdminConfigBuilder();
            $builder->title($isEdit ? '编辑产品' : '添加产品')
                ->keyId()
                ->keyText('title', '名称')
                ->keyText('desc', '描述')
                ->keyEditor('content','详情')
                ->keyImageGallery('ProductGallery','产品图片',null,'PICTURE_GALLERY')
                ->keyStatus()
                ->data($data)
                ->buttonSubmit(U('edit'))->buttonBack()
                ->display();
        }
        
    }
    public function setStatus($ids, $status)
    {
        $builder = new AdminListBuilder();
        $builder->doSetStatus('Product', $ids, $status);
    }
}