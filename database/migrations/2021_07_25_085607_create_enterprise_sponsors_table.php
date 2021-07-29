<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnterpriseSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprise_sponsors', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->string('contact_person');
            $table->string('address');
            $table->string('first_telephone');
            $table->string('sec_telephone');
            $table->string('email')->unique();
            $table->bigInteger('country_id')->unsigned();
            $table->string('password');


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
        Schema::dropIfExists('enterprise_sponsors');
    }
}
