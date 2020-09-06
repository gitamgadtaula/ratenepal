<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('shop_id')->unsigned();
            // $table->string('main_img')->nullable()->default('/default/dp.png');
            $table->string('img1')->nullable()->default('/default/dummy.png');
            $table->string('img2')->nullable()->default('/default/dummy.png');
            $table->string('img3')->nullable()->default('/default/dummy.png');
            $table->string('img4')->nullable()->default('/default/dummy.png');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
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
        Schema::dropIfExists('images');
    }
}
