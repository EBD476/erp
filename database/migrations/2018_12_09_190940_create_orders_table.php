<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hnt_orders', function (Blueprint $table) {
            $table->increments('ho_id');
            $table->string('ho_project_name');
            $table->string('ho_project_owner');
            $table->string('ho_project_owner_phone');
            $table->string('ho_project_type');
            $table->string('ho_project_land_use');
            $table->integer('ho_project_units');
            $table->string('ho_project_address');
            $table->string('ho_project_location');
            $table->string('ho_project_description');
            $table->string('hp_project_features');
            $table->integer('ho_user');
            $table->boolean('ho_technical_accept');
            $table->boolean('ho_master_accept');
            $table->boolean('ho_finance_accept');
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
        Schema::dropIfExists('orders');
    }
}
