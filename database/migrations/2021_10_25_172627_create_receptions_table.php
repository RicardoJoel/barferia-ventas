<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('distribution_id');
            $table->unsignedBigInteger('user_id');
            $table->string('code',12);
            $table->datetime('date');
            $table->string('status',20);
            $table->datetime('closed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['code','deleted_at']);
            $table->foreign('distribution_id')
                ->references('id')
                ->on('distributions')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('receptions');
    }
}
