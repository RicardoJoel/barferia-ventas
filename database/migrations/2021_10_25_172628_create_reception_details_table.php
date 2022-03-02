<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceptionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reception_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reception_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('received')->nullable();
            $table->integer('returned')->nullable();
            $table->string('observation',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('reception_id')
                ->references('id')
                ->on('receptions')
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
        Schema::dropIfExists('reception_details');
    }
}
