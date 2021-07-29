<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_sponsors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('sec_name');
            $table->string('third_name');
            $table->string('last_name');

            $table->bigInteger('governorate_id')->unsigned();
            $table->bigInteger('city_id')->unsigned();
            $table->bigInteger('neighborhood_id')->unsigned();
            $table->bigInteger('nationality_id')->unsigned();
            $table->bigInteger('country_id')->unsigned();

            $table->string('details');
            $table->string('phone_number');
            $table->string('telephone');
            $table->string('email');
            $table->integer('identification_number');
            $table->string('identification_number_type');


            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_sponsors');
    }
}
