<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bill_id')->nullable();

            $table->foreignId('enterprise_sponsor_id')->nullable()->constrained('enterprise_sponsors', 'id')->nullOnDelete();
            $table->foreignId('personal_sponsor_id')->nullable()->constrained('personal_sponsors', 'id')->nullOnDelete();
            $table->foreignId('guaranteed_id')->nullable()->constrained('guaranteeds', 'id')->nullOnDelete();

            $table->date('start')->nullable();
            $table->date('end')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
