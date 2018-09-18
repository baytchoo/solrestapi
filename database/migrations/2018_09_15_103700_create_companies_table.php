<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name');
            $table->string('tax_reg_nr');
            $table->string('business_reg_nr');
            $table->string('email');
            $table->unsignedInteger('person_id');
            $table->unsignedInteger('address_id')->nullable();
            $table->timestamps();

            $table->foreign('person_id')->references('id')->on('people');
            $table->foreign('address_id')->references('id')->on('addresses');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
