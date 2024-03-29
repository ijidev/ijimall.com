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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();

            $table->foreignid('user_id')->constrained()
                ->onUpdate('cascade')->onDelete('cascade');
            
            $table->foreignid('product_id')->constrained()
                ->onDelete('cascade')->onUpdate('cascade');

            $table->integer('quantity');
            $table->double('amount');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
        // Schema::dropIfExists('cart_items');
    }
};
