<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->string('code',5);
            $table->string('name',50);
            $table->char('type',1);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['code', 'name', 'type', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('races');
    }
}
