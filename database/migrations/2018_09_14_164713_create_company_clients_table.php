<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_clients',
                         function (Blueprint $table){
                                $table->integer('client_id');
                                $table->string('company_name');
                                $table->integer('fiscal_code')->unsigned();

                                $table->foreign('client_id')->references('id')->on('clients');
                        }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_clients');
    }
}
