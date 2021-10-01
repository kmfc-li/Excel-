<?php

namespace App\Http\Controllers\My;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;

class UploaderController extends Controller
{

    //上传文件的处理
    public function webuploader(Request $request){
        //判断文件是否上传成功
        if($request -> hasFile('file') && $request -> file('file') -> isValid()){
            //文件上传

            $filename = sha1(time() . $request -> file('file') -> getClientOriginalName()) . '.' . $request -> file('file') -> getClientOriginalExtension();
            //die($filename);

            //文件的保存
            //Storage::disk(磁盘名)->put(文件名，文件内容);
            Storage::disk('public') -> put($filename,file_get_contents($request -> file('file') ->path()));


            //返回数据
            $result = [
                'errCode'   =>     '0',
                'errMsg'    =>     '',
                'succMsg'   =>     '文件上传成功！',
                'path'      =>     '/app/public/' . $filename,
                

            ];
        }
        else{
            //没有文件上传或者出错
            $result = [
                'errCode'    =>   '000001',
                'errMsg'     =>   $request -> file('file') -> getErrorMessage()
            ];

        }
        //返回信息
        return   response() -> json($result);
    }



    //七牛云存储
    public function qiniu(Request $request){
        //判断文件是否上传成功
        if($request -> hasFile('file') && $request -> file('file') -> isValid()){
            //文件上传

            $filename = sha1(time() . $request -> file('file') -> getClientOriginalName()) . '.' . $request -> file('file') -> getClientOriginalExtension();
            //die($filename);

            //文件的保存
            //Storage::disk(磁盘名)->put(文件名，文件内容);
            Storage::disk('qiniu') -> put($filename,file_get_contents($request -> file('file') ->path()));


            //返回数据
            $result = [
                'errCode'   =>     '0',
                'errMsg'    =>     '',
                'succMsg'   =>     '文件上传成功！',
                'path'      =>     Storage::disk('qiniu')->getDriver()->downloadUrl($filename),                //获取下载地址
                

            ];
        }
        else{
            //没有文件上传或者出错
            $result = [
                'errCode'    =>   '000001',
                'errMsg'     =>   $request -> file('file') -> getErrorMessage()
            ];

        }
        //返回信息
        return   response() -> json($result);
    }
}
