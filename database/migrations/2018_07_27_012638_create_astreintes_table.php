<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAstreintesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('astreintes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('type_astreinte_id');
            $table->integer('status_astreinte_id');
            $table->date('start_at_date');
            $table->date('end_at_date');
            $table->time('start_at_time');
            $table->time('end_at_time');
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
        Schema::dropIfExists('astreintes');
    }
}
