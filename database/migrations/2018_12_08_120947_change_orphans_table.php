<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeOrphansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orphans', function (Blueprint $table) {
            $table->dropColumn('class');
            $table->text('contact')->nullable();
            $table->date('birthday')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orphans', function (Blueprint $table) {
            $table->string('class', 20)->default('');
            $table->dropColumn('contact');
            $table->date('birthday')->change();
        });
    }
}
