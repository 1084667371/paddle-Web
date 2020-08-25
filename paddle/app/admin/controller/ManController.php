<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 小夏 < 449134904@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use app\admin\model\AdminMenuModel;

class ManController extends AdminBaseController
{
    //一键抠图
    public function index(){
        //接收传过来的值
        $koutufile = $this->request->param('koutufile');
        if(empty($koutufile)==False){
            //完整路径
            $koutufile = "http://".$_SERVER['HTTP_HOST']."/paddle/public/output/humanseg_output/".$koutufile;
        }
        $this->assign('koutufile', $koutufile);
        return $this->fetch();

    }
    //一键抠图开始
    public function koutu_add(){
        //接收传过来的图片
    	$file = $this->request->param('image');
        //判断是否为空
        if(empty($file)==False){
            //完整路径
            $file = $_SERVER['DOCUMENT_ROOT']."/paddle/public/upload/".$file;
            //运行python
            $output = shell_exec('python D:/phpstudy_pro/WWW/paddle/public/gongneng/koutu.py '.$file);
            //去掉python文件返回的值最后的空格，否则传值的时候无法传输
            $output = str_replace(array("\r\n", "\r", "\n"), "", $output);
            //跳转并传值
            $this->success('抠图成功', url('Man/index',['koutufile'=>$output]));
            
        }else{
            $this->error('请上传图片');
        }
    	
    }

    //风格迁移
    public function style(){
        //接收第一个参数
        $image = $this->request->param('image');
        //接收第二个参数
        $file = $this->request->param('file');
        //判断是否为空
        if(empty($image)==False){
            //将..转换回来
            $file =str_replace("..","/",$file);
            //完整路径
            $file = "http://".$_SERVER['HTTP_HOST']."/paddle/public/upload/".$file;
            //将pengzhaoshuai转换回来
            $image =str_replace("pengzhaoshuai","/",$image);
            //完整路径
            $image = "http://".$_SERVER['HTTP_HOST']."/paddle/public/upload/admin/".$image;
        }
        $this->assign('style', $image);
        $this->assign('image', $file);
        return $this->fetch();
    }
    //风格迁移开始
    public function style_add(){
        //接收第一张图片
        $file = $this->request->param('image');
        //接收第二张图片
        $style = $this->request->param('style');
        //完整的第一张图片路径
        $fileimage = $_SERVER['DOCUMENT_ROOT']."paddle/public/upload/".$file;
        //完整的第二张图片路径
        $style = $_SERVER['DOCUMENT_ROOT']."paddle/public/upload/".$style;
        //运行python文件并传值
        $output = shell_exec('python D:/phpstudy_pro/WWW/paddle/public/gongneng/style.py '.$fileimage.' '.$style);
        //去掉python文件返回的值最后的空格，否则传值的时候无法传输
        $output = str_replace(array("\r\n", "\r", "\n"), "", $output);
        //传值的时候不能带/符号先转换一下
        $file =str_replace("/","..",$file);
        $this->success('迁移成功', url('Man/style',['image' => $output , 'file' => $file]));
        
    }

    //图像合并
    public function merge(){
        //接收第一个参数
        $image = $this->request->param('image');
        //接收第二个参数
        $file = $this->request->param('file');
        //判断是否为空
        if(empty($image)==False){
            //将..转换回来
            $file =str_replace("..","/",$file);
            //完整路径
            $file = "http://".$_SERVER['HTTP_HOST']."/paddle/public/upload/".$file;
            //将pengzhaoshuai转换回来
            $image =str_replace("pengzhaoshuai","/",$image);
            //完整路径
            $image = "http://".$_SERVER['HTTP_HOST']."/paddle/public/upload/admin/".$image;
        }
        $this->assign('style', $image);
        $this->assign('image', $file);
        return $this->fetch();
    }
    //图像合并开始
    public function merge_add(){
        //接收第一张图片
        $file = $this->request->param('image');
        //接收第二张图片
        $style = $this->request->param('style');
        //完整的第一张图片路径
        $fileimage = $_SERVER['DOCUMENT_ROOT']."paddle/public/upload/".$file;
        //完整的第二张图片路径
        $style = $_SERVER['DOCUMENT_ROOT']."paddle/public/upload/".$style;
        //运行python文件并传值
        $output = shell_exec('python D:/phpstudy_pro/WWW/paddle/public/gongneng/merge.py '.$fileimage.' '.$style);
        //去掉python文件返回的值最后的空格，否则传值的时候无法传输
        $output = str_replace(array("\r\n", "\r", "\n"), "", $output);
        //传值的时候不能带/符号先转换一下
        $file =str_replace("/","..",$file);
        $this->success('合并成功', url('Man/merge',['image' => $output , 'file' => $file]));
        
    }
}
