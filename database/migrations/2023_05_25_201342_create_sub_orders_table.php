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
        Schema::create('sub_orders', function (Blueprint $table) {
            $table->id();

            $table->foreignid('order_id')->constrained()
            ->ondelete('cascade')
            ->onupdate('cascade');
            $table->foreignid('vendor_id')->constrained('users')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->enum('status', ['pending', 'processing', 'shipped_out', 'received', 'inspection', 'completed', 'declined'])->default('pending');
            $table->float('grand_total');
            $table->integer('item_count');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_orders');
    }
};
