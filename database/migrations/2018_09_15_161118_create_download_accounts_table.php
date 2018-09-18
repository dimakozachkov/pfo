<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDownloadAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('download_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('orphan_id')->unsigned();
            $table->integer('template_id')->unsigned();
            $table->timestamps();
	
	        $table->foreign('user_id')
		        ->references('id')
		        ->on('users')
		        ->onDelete('cascade');
	        
	        $table->foreign('orphan_id')
		        ->references('id')
		        ->on('orphans')
		        ->onDelete('cascade');
	        
	        $table->foreign('template_id')
		        ->references('id')
		        ->on('templates')
		        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('download_accounts');
    }
}
