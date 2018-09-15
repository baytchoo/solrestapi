<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndividualClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individual_clients', function (Blueprint $table) {
            $table->integer('client_id');
            $table->string('first_name');
            $table->string('last_name');

            $table->foreign('client_id')->references('id')->on('clients')
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('individual_clients');
    }
}
