<?php

namespace App\Http\Controllers\My;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Calculator\calculator;

use App\Exports\TestExport;
use App\Imports\TestImport;
use Excel;

class CalculatorController extends Controller
{
    //查询显示方法
    public function index(){
        $data=calculator::get();
        return view('/calculator/index',compact('data'));
    }

    //添加方法
    public function add(Request $request){
        //判断请求类型
        if ($request->isMethod('post')) {
            $name=$request->bill_name;
            $num=$request->bill_num;
            $price=$request->unit_price;
            $total=$price * $num;
            $result=calculator::insert([
                'bill_name' => $name,
                'bill_num'  => $num,
                'unit_price' => $price,
                'total_price' => $total,
                'created_at'  =>   date('Y-m-d H:i:s'),

            ]);
            //返回输出
            return $result ? '1' : '0';         

        }else{
            return view('/calculator/add');
        }
    }

    //修改方法
    public function update(Request $request){
        $id=$request->id;
        if($request->isMethod('post')){
            $result=calculator::where('id',$id)->update([
                'bill_name' => $request->bill_name,
                'bill_num'  => $request->bill_num,
                'unit_price' => $request->unit_price,
                'total_price' => $request->bill_num * $request->unit_price,
                'updated_at'  =>   date('Y-m-d H:i:s'),

            ]);
            return $result ? '1' : '0';
            
        }else{
            $data=calculator::where('id',$id)->first();
            return view('/calculator/update',compact('data'));
        }
    }

    //删除方法
    public function delete(Request $request){
        $id=$request->id;
        $result=calculator::destroy($id);
        return Response()->json($result);
        
    }

    //导出
    public function export(){
       return Excel::download(new TestExport(), sha1(time().rand(1000,9999)).'.xlsx');
    }
    //导入
    public function import(Request $request){
        if($request->isMethod('post'))
        {
            $filePath=$request->excelpath;
            //dd($filePath);
            $result=Excel::import(new TestImport($request), storage_path($filePath));
            return $result ? '1' : '0';
        }
        else{
             return view('calculator/import');
        }
       
    }
}
