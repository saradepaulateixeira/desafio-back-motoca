<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['car', 'motorcycle'])->default('car');
            $table->string('brand', 50)->default('Honda');
            $table->string('model', 100);
            $table->integer('year');
            $table->decimal('price', 12, 2);
            $table->string('color', 30)->nullable();
            $table->integer('mileage')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};