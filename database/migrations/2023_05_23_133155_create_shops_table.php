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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('decription')->nullable();
            $table->string('image')->nullable();
            $table->string('cover_img')->nullable();
            $table->string('address')->nullable();
            $table->float('reting')->nullable();
            $table->boolean('is_active')->default(false);
            $table->unsignedBigInteger('vendor_id');
            
            $table->foreign('vendor_id')->references('id')->on('users')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
