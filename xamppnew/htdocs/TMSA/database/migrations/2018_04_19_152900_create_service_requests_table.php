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
            $table->string('deliverTo');
            $table->string('contactDetails');
            $table->string('contactName');
            $table->string('contactPhone');
            $table->string('itemDescription');
            $table->date('pickUpDate');
            $table->string('pickUpTime');
            $table->string('estimatedWgt');
            $table->decimal('valueOfHaulage', 15, 2);
            $table->integer('orderStatus');/*
            $table->integer('packagingType');*/
            //$table->string('requiredResourceType');
            $table->integer('typeOfHaulage');
            $table->integer('clientOrderID');
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
