<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSourceCol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranking_source', function (Blueprint $table) {
            $table->increments('id');
            $table->string('source');
            $table->timestamps();
        });

        Schema::table('cost_education', function ($table) {
            $table->string('source')->after('passing_score_kz');
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
