<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_type_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('code',8);
            $table->string('name',50);
            $table->string('lastname',50);
            $table->date('birthdate')->nullable();
            $table->string('document',15)->nullable();
            $table->string('email',50)->nullable();
            $table->string('mobile',11)->nullable();
            $table->string('phone',11)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['code', 'deleted_at']);
            $table->foreign('document_type_id')
                ->references('id')
                ->on('document_types')
                ->onDelete('cascade');
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
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
        Schema::dropIfExists('customers');
    }
}
