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
        Schema::create('sub_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignid('sub_order_id')->constrained()
            ->ondelete('cascade')
            ->onupdate('cascade');
            $table->foreignid('product_id')->constrained()
            ->ondelete('cascade')
            ->onupdate('cascade');
            $table->float('price');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_order_items');
    }
};
