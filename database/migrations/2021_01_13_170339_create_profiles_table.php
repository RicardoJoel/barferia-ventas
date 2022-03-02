<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('code',3);
            $table->string('name',50);
            $table->string('type',50);
            $table->integer('salary');
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
        Schema::dropIfExists('profiles');
    }
}
