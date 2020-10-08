<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelToFrogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('frogs', function (Blueprint $table) {
            $table->unsignedBigInteger('sim_id');
            $table->foreign('sim_id')->references('id')->on('simulations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('frogs', function (Blueprint $table) {
            //
        });
    }
}
