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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('trans_ref')->unique();
            $table->float('amount');
            $table->enum('type', ['withdrawal', 'purchase', 'deposit'])->default('purchase');
            $table->enum('status', ['success', 'failed']);
            $table->foreignid('user_id')->constrained()
                ->ondelete('cascade')
                ->onUpdate('cascade');
            $table->foreignid('order_id')->nullabel()
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignid('withdrawal_id')->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
