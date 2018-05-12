<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TaoBangCaSi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('singers');
        Schema::create('singers', function (Blueprint $table) {
            $table->increments('idcasi');
            $table->string('ten');
            $table->longText('thongtin');
            $table->string('urlanh');
            $table->integer('idtheloai')->unsigned();
            $table->foreign('idtheloai')->references('idtheloai')->on('theloai')->onDelete('cascade');
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
        Schema::dropIfExists('singers');
    }
}
