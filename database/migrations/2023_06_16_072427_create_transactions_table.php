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
            // $table->float('admin_commission');
            $table->enum('type', ['purchase', 'deposit'])->default('purchase');
            $table->enum('status', ['success', 'failed']);

            $table->foreignid('user_id')->constrained()
                ->ondelete('cascade')
                ->onUpdate('cascade');

            $table->foreignid('order_id')->nullabel()
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
        });

        Schema::create('sub_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('trans_ref');
            $table->float('total');
            $table->float('vendor_commission');
            $table->string('admin_commission');
            $table->enum('type', ['purchase', 'deposit'])->default('purchase');
            $table->enum('status', ['success', 'failed']);

            $table->foreignid('user_id')->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignid('vendor_id')->constrained('users','id')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignid('order_id')->nullabel()
                ->constrained('sub_orders')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('sub_transactions');
    }
};
