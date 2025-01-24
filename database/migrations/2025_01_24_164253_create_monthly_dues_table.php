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
        Schema::create('monthly_dues', function (Blueprint $table) {
            $table->id();
            $table->string('currency');
            $table->date('date');
            $table->string('photo');
            $table->enum('status', ['Diproses', 'Lunas'])->default('Diproses');
            $table->unsignedBigInteger('month_id');
            $table->foreign('month_id')->references('id')->on('month')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('monthly_dues');
    }
};
