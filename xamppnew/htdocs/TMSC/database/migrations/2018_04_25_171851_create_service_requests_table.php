<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serviceIDNo');
            $table->string('deliverFrom');
            $table->string('contactDetails');
            $table->string('deliverTo');
            $table->string('estimatedWgt');
            $table->text('itemDescription');
            $table->integer('orderStatus');
            $table->date('dateRequired');
            $table->date('dateReturned');/*
            $table->string('requiredResourceType');*/
            $table->date('pickupDate');
            $table->string('pickUpTime');/*
            $table->string('requiredResourceType');*/
            $table->integer('typeOfHaulage');
            $table->integer('git');
            $table->integer('createdBy')->unsigned()->index();
            $table->foreign('createdBy')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('service_requests');
    }
}
