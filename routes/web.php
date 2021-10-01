<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('calculator/index','My\CalculatorController@index');//首页
Route::any('calculator/add','My\CalculatorController@add');//添加
Route::any('calculator/update','My\CalculatorController@update');//修改
Route::get('calculator/delete','My\CalculatorController@delete');//删除
Route::post('calculator/uploader/webuploader','My\UploaderController@webuploader');//上传文件到本地
Route::post('calculator/uploader/qiniu','My\UploaderController@qiniu');//上传文件到七牛
Route::get('calculator/export','My\CalculatorController@export');//导出
Route::any('calculator/import','My\CalculatorController@import');//导入