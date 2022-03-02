<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribution_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('distribution_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('openstock');
            $table->integer('opendestiny');
            $table->integer('quantity');
            $table->integer('received');
            $table->integer('returned');
            $table->boolean('checked');
            $table->string('observation',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('distribution_id')
                ->references('id')
                ->on('distributions')
                ->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distribution_details');
    }
}
