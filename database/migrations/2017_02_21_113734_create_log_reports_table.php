<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('size');
            $table->timestamps();
        });

        DB::insert(

            "INSERT INTO `log_reports` (`name`, `size`) VALUES
                ('laravel.log',0)"
        );

        $now = "'".date('Y-m-d H:i:s')."'";

        DB::update("update `log_reports` set created_at = $now, updated_at = $now");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_reports');
    }
}
