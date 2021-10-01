<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Calculator\calculator;

class TestImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $row)
    {
        //
        $data=$row->all();
         //dd($data);

        $temp=[];
        foreach($data as $key => $value){
            //排除表头
            if($key == '0')
            {
                continue;
            }
            //此时value是数组
            $temp[]=[
                'bill_name' => $value[1],
                'bill_num' => $value[2],
                'unit_price' => $value[3],
                'total_price' => $value[4],
                'created_at' => $value[5],
                'updated_at' => $value[6],              
            ];
        }
        //写入数据库
        $result=calculator::insert($temp);
        return $result;
    }
}
