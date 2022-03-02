<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEPSsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epss', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('code',3);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['name', 'code', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('epss');
    }
}
