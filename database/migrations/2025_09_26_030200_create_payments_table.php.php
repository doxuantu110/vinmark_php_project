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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignID('order_id')->constrained('orders')->onDelete('cascade');
            $table->enum('payment_method', ['paypal', 'cash', 'momo']);
            $table->string('transaction_id')->nullable();
            $table->decimal('amount', 10, 2);
            $table->dateTime('paid_at')->nullable();
            $table->enum('status', ['pending','completed', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::DropIfExists(table:'payments');
    }
};
