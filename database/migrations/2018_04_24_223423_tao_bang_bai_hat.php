<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TaoBangBaiHat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('songs');
        Schema::create('songs', function (Blueprint $table) {
            $table->increments('idbaihat');
            $table->string('ten');
            $table->integer('idcasi')->unsigned();
            $table->foreign('idcasi')->references('idcasi')->on('singers')->onDelete('cascade');
            $table->longText('lyrics');
            $table->string('karaoke');
            $table->string('urlthuong');
            $table->string('urlvip');
            $table->string('urlanh');
            $table->integer('luotnghe');
            $table->integer('luottai');
            $table->integer('sosao');
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
        Schema::dropIfExists('songs');
    }
}
