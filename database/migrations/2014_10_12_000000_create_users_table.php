<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_admin');
            $table->string('name',50);
            $table->string('lastname',50)->nullable();
            $table->string('document',8)->nullable();
            $table->string('telephone',9)->nullable();
            $table->string('email',50);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',100)->nullable();
            $table->string('confirmation_code',100)->nullable();
            $table->rememberToken()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['email', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
