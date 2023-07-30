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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->foreignid('shop')->constrained()
                ->onDelete('cascade')->onUpdate('cascade');
            $table->enum('discountType', ['percent', 'fixed'])
                ->default('percent');
            $table->string('code');
            $table->integer('value');
            $table->integer('usable');
            $table->integer('used');
            $table->boolean('expired')->default(false);
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
