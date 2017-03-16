<?php
namespace app\admin\controller;

use think\Controller;
class Upload extends Common
{
    public function picture()
    {
        $file = request()->file('file');
        $info = $file->move('./uploads/');
        if (!empty($info)) {
            $attachment['filename'] = $info->getFilename();
            $attachment['filepath'] = 'uploads/' . pathConvert($info->getSaveName());
            $attachment['fileext'] = $info->getExtension();
            $attachment['filesize'] = $info->getSize();
            $attachment['inputtime'] = request()->time();
            db('attachment')->insert($attachment);
            $data['path'] = __ROOT__ . '/uploads/' . pathConvert($info->getSaveName());
            $data['code'] = 1;
            $data['message'] = '上传成功！';
        } else {
            $data['path'] = '';
            $data['code'] = 0;
            $data['message'] = '上传失败！';
        }
        return json($data);
    }
    
    public function ueditor()
    {
        $config = ["savePath" => "uploads/", "maxSize" => 1024, "allowFiles" => [".gif", ".png", ".jpg", ".jpeg", ".bmp"]];
        $up = new \org\Uploader("upfile", $config);
        $info = $up->getFileInfo();
		db('attachment')->insert(array('filename' => $info['name'], 'filepath' => $info['url'], 'fileext' =>str_replace('.','',$info['type']), 'filesize' => $info['size'], 'inputtime' => request()->time()));
        echo json_encode($info);
    }
}