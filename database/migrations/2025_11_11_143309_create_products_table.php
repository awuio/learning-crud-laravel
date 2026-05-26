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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('quantity');

            // ส่วนสำคัญคือชุดคำสั่งนี้:
            $table->foreignId('category_id')
                ->constrained('categories') // 1. ผูกความสัมพันธ์กับตาราง categories
                ->restrictOnDelete();       // 2. บังคับไม่ให้ลบหมวดหมู่ถ้ามีสินค้านี้อยู่

            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
