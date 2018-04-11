<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSongs extends Migration
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
            $table->increments('idBaiHat');
            $table->string('ten');
            $table->string('theloai');
            $table->longText('lyrics');
            $table->string('karaoke');
            $table->integer('idCaSi')->unsigned();
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
