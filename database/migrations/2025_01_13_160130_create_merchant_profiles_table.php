<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('merchant_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 20);
            $table->string('name');
            $table->enum('gender', ['Laki - laki', 'Perempuan']);
            $table->string('phone', 15);
            $table->unsignedBigInteger('religion_id');
            $table->foreign('religion_id')->references('id')->on('religions')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('citys')->onUpdate('cascade')->onDelete('cascade');
            $table->date('date');
            $table->text('address');
            $table->string('ktp_picture');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_profiles');
    }
};
