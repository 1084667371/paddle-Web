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

class OcrController extends AdminBaseController
{
    //一键文字识别
    public function index(){
        //接收传过来的值
        $text = $this->request->param('text');
        $this->assign('text', $text);
        return $this->fetch();

    }
    //文字识别开始
    public function ocr_add(){
        //接收传过来的图片
    	$file = $this->request->param('image');
        //判断是否为空
        if(empty($file)==False){
            //完整路径
            $file = $_SERVER['DOCUMENT_ROOT']."/paddle/public/upload/".$file;
            //运行python
            $output = shell_exec('python D:/phpstudy_pro/WWW/paddle/public/gongneng/ocr.py '.$file);
            //转码为UTF-8
            $codeType = mb_detect_encoding($output, array("ASCII","UTF-8","GB2312","GBK","BIG5"));
            $output = iconv($codeType,"UTF-8",$output);
            //去掉python文件返回的值最后的空格，否则传值的时候无法传输
            $output = str_replace(array("\r\n", "\r", "\n"), "", $output);
            //跳转并传值
            $this->success('识别成功', url('Ocr/index',['text'=> $output]));
            
        }else{
            $this->error('请上传图片');
        }
    	
    }
}
