<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ubigeo_id')->nullable();
            $table->string('name',50);
            $table->string('code',3);
            $table->char('type',1);
            $table->string('address',100);
            $table->string('other_ubigeo',300)->nullable();
            $table->string('ref',100)->nullable();
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['name', 'deleted_at']);
            $table->unique(['code', 'deleted_at']);
            $table->foreign('ubigeo_id')
                ->references('id')
                ->on('ubigeos')
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
        Schema::dropIfExists('centers');
    }
}
