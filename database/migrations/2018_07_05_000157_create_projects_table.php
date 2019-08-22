<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hnt_projects', function (Blueprint $table) {
            $table->increments('hp_id');
            $table->string('hp_project_name');
            $table->string('hp_project_owner');
            $table->string('hp_project_owner_phone');
            $table->tinyInteger('hp_project_type');
            $table->tinyInteger('hp_project_land_use');
            $table->integer('hp_project_units');
            $table->tinyInteger('hp_project_state');
            $table->tinyInteger('hp_project_city');
            $table->string('hp_project_address');
            $table->string('hp_project_location');
            $table->string('hp_project_description');
            $table->string('hp_project_options');
//            $table->integer('hp_project_completed');
//            $table->date('hp_project_complete_date');
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
        Schema::drop('hnt_projects');
    }
}
