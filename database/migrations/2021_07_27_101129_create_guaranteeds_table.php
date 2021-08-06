<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuaranteedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guaranteeds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('warranty_type');
            $table->integer('money');
            $table->unsignedBigInteger('personal_sponsor_id')->nullable();;
            $table->foreign('personal_sponsor_id')->references('id')->on('personal_sponsors')->nullOnDelete();
            $table->bigInteger('currency_id')->unsigned();
            $table->date('add_data');
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
        Schema::dropIfExists('guaranteeds');
    }
}
