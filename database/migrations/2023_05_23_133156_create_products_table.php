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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->enum('status', ['pending', 'published', 'draft', 'trash'])->default('pending');
            $table->float('price');
            $table->unsignedBigInteger('vendor_id');
            // $table->foreignid('category_id')->constrained()
            //     ->ondelete('cascade')
            //     ->onupdate('cascade'); 
            
            $table->foreign('vendor_id')->references('id')->on('shops')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('cover_img')->nullable();
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
