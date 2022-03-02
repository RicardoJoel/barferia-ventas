<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dependent_type_id');
            $table->unsignedBigInteger('user_id');
            $table->string('fullname',100);
            $table->date('birthdate');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('dependent_type_id')
                ->references('id')
                ->on('dependent_types')
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
        Schema::dropIfExists('dependents');
    }
}
