<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSubscriptionsTable
 */
class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')
                ->unsigned()
                ->index();

            $table->integer('orphan_id')
                ->unsigned()
                ->index();


            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('orphan_id')
                ->references('id')
                ->on('orphans')
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
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropForeign([
                'user_id', 'orphan_id'
            ]);
        });

        Schema::dropIfExists('subscriptions');
    }
}
