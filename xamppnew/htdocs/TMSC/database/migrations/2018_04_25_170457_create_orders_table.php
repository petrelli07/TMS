<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serviceIDNo');
            $table->string('deliverFrom');
            $table->string('deliverTo');
            $table->string('estimatedWgt');
            $table->text('itemDescription');
            $table->integer('orderStatus');
            $table->date('dateRequired');
            $table->date('dateReturn');
            $table->string('requiredResourceType');
            $table->integer('numberOfResources');
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
        Schema::dropIfExists('orders');
    }
}
