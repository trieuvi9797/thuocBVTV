<?php

use App\Models\Category;
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
            $table->string('image');
            $table->longText('description');
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
            $table->double('price');
            $table->double('sale');
            $table->bigInteger('quantity');
            $table->bigInteger('view')->nullable();
            $table->bigInteger('sold')->nullable();
            $table->bigInteger('likes')->nullable();
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
