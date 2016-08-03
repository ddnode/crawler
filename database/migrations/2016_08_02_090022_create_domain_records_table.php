<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domain_records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('domain');
            $table->string('company');
            $table->string('company_type');
            $table->string('license');
            $table->string('website');
            $table->string('website_front');
            $table->string('time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('domain_records');
    }
}
