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
        Schema::create('vendor_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignid('shop_id')->constrained()
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('manager_fname')->nullable();
            $table->string('manager_lname')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('additional_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('bank')->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_infos');
    }
};
