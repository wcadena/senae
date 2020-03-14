<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repodos', function (Blueprint $table) {
            $table->id();

            $table->string('row');
            $table->string('customer');
            $table->string('from');
            $table->string('to');
            $table->string('bkg');
            $table->string('cabin');
            $table->string('class');
            $table->string('seat');
            $table->string('accept');
            $table->string('codeshare');
            $table->string('incarriage');
            $table->string('incarriagefrom');
            $table->string('arrivaltime');
            $table->string('bagdetails');

            $table->softDeletes();
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
        Schema::dropIfExists('repodos');
    }
}
