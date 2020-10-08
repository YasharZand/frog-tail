<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttrToFrogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('frogs', function (Blueprint $table) {
            $table->enum('gender',['M','F']);
            $table->enum('energy',['E','I']);
            $table->smallInteger('age')->default(0);
            $table->string('cog',2);
            $table->smallInteger('lifespan');

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
