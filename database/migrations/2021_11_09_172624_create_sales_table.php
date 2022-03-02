<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('center_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('payment_method_id');
            $table->string('code',13);
            $table->string('status',20);
            $table->datetime('happened_at');
            $table->date('requested_at')->nullable();
            $table->time('ini_hour')->nullable();
            $table->time('end_hour')->nullable();
            $table->float('discount')->nullable();
            $table->float('paidout')->nullable();
            $table->float('delivery')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['code','deleted_at']);
            $table->foreign('center_id')
                ->references('id')
                ->on('centers')
                ->onDelete('cascade');
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');
            $table->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->onDelete('cascade');
            $table->foreign('payment_method_id')
                ->references('id')
                ->on('payment_methods')
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
        Schema::dropIfExists('sales');
    }
}
