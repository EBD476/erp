<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLOMsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hnt_lom', function (Blueprint $table) {
            $table->increments('hl_id');
            $table->string('hl_product_code');
            $table->string('hl_product_name');
            $table->string('hl_product_model');
            $table->string('hl_product_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('l_o_ms');
    }
}
