<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id');
            $table->tinyInteger('rating')->default(5);
            $table->string('user_name');
            $table->string('user_image');
            $table->string('user_country');
            $table->enum('status', ["PENDING", "APPROVED", "DELETED", "EXPIRED"])->default('PENDING');
            $table->string('message', 1024);
            $table->string('hash')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
