<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrphanPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orphan_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orphan_id')->unsigned()->index();
            $table->foreign('orphan_id')->references('id')->on('orphans')->onDelete('cascade');
            $table->string('url', 255);
            $table->boolean('main')->default(false);
            $table->integer('weight')->unsigned()->default(0);
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
        Schema::dropIfExists('orphan_photos');
    }
}
