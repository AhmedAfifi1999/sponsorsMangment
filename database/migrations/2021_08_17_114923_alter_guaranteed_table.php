<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterGuaranteedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guaranteeds', function (Blueprint $table) {
            $table->unsignedBigInteger('enterprise_sponsor_id')->nullable();
            $table->foreign('enterprise_sponsor_id')->references('id')->on('enterprise_sponsors')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guaranteeds', function (Blueprint $table) {
            //
        });
    }
}
