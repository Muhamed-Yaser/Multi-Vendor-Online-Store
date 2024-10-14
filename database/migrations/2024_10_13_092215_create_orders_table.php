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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('stores');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('number')->unique();//to make analysis or something
            $table->string('payment_method');
            $table->enum('status' , ['pending' , 'processing' , 'delivering' , 'completed' , 'cancelled' , 'defunded'])->default('pending');
            $table->enum('payment_status' , ['pending' , 'paied' , 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
