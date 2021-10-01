<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use App\Calculator\calculator;


class TestExport implements FromArray
{
    
    public function array(): array
    {
        $data = [
            // 设置表头信息
            ['序号','账目','数量','单价','总价','添加时间','修改时间'],
        ];
        // 取出需求导出的数据
        $billdata=calculator::get();
        foreach($billdata as $key => $value){
            $data[]=[
                $value -> id,
                $value -> bill_name,
                $value -> bill_num,
                $value -> unit_price,
                $value -> total_price,
                $value -> created_at,
                $value -> updated_at,
            ];
        }
 
        return $data;
    }
}
