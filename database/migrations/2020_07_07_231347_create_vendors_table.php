<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name','100');
            $table->string('mobile','20');
            $table->string('address','255');
            $table->string('email','50');
            $table->string('logo_image','100')->nullable();
            $table->unsignedBigInteger('main_category_id');
            $table->string('password');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->boolean('active');
            $table->timestamps();
        });
        Schema::table('vendors',function (Blueprint $table){
            $table->foreign('main_category_id')
                ->references('id')
                ->on('main_categories')
                ->onUpdate('cascade')
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
        Schema::dropIfExists('vendors');
    }
}
