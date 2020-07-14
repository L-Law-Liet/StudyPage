<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnRating extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('rating', function($table) {
            $table->integer('category_id')->after('id')->unsigned()->nullable();
            $table->dropColumn('statistic_analysis');
            $table->dropColumn('loyalty_index');
            $table->dropColumn('online_resource');

            $table->foreign('category_id')->references('id')->on('rating_categories')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
