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
            $table->integer('orderStatus');
            $table->integer('numberOfDays');
            $table->string('requiredResourceType');
            $table->integer('numberOfResources');
            $table->date('dateOfDelivery');
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
