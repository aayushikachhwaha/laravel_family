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
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('family_head_id');
            $table->foreign('family_head_id')->references('id')->on('family_heads')->onDelete('cascade');
            $table->string('name');
            $table->date('birthdate');
            $table->string('marital_status');
            $table->date('wedding_date')->nullable();
            $table->string('education')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_members');
    }
};
