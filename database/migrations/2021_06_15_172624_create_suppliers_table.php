<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('document_type_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('ubigeo_id')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->string('name',100);
            $table->string('code',8);
            $table->string('document',15);
            $table->string('other_profile',100)->nullable();
            $table->string('other_ubigeo',300)->nullable();
            $table->string('address',100)->nullable();
            $table->string('mobile',11)->nullable();
            $table->string('phone',11)->nullable();
            $table->string('annex',6)->nullable();
            $table->string('email',50)->nullable();
            $table->string('account',20)->nullable();
            $table->string('cci',23)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['code', 'deleted_at']);
            $table->foreign('profile_id')
                ->references('id')
                ->on('profiles')
                ->onDelete('cascade');
            $table->foreign('document_type_id')
                ->references('id')
                ->on('document_types')
                ->onDelete('cascade');
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('cascade');
            $table->foreign('ubigeo_id')
                ->references('id')
                ->on('districts')
                ->onDelete('cascade');
            $table->foreign('bank_id')
                ->references('id')
                ->on('banks')
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
        Schema::dropIfExists('suppliers');
    }
}
