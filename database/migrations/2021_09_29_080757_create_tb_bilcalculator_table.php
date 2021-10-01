<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbBilcalculatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_bilcalculator', function (Blueprint $table) {
            $table -> increments('id');//主键
            $table -> string('bill_name',50) -> notNull();//账目名称
            $table -> Integer('bill_num') -> notNull();//数量
            $table -> decimal('unit_price',7,2) -> notNull();//单价
            $table -> decimal('total_price',7,2) -> notNull();//总价    
            $table -> timestamps();              
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_bilcalculator');
    }
}
