<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('contact_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained('businesses')->onDelete('cascade');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->onDelete('cascade');
            $table->foreignId('contact_id')->constrained('contacts')->onDelete('cascade');
            $table->date('payment_date');
            $table->string('voucher_number')->unique();
            $table->enum('method', ['Cash', 'Bank', 'Bkash', 'Rocket', 'Online']);
            $table->decimal('payable_amount', 12, 2)->nullable();
            $table->decimal('manager_discount', 10, 2)->nullable();
            $table->decimal('special_discount', 10, 2)->nullable();
            $table->decimal('total_discount', 10, 2)->nullable();
            $table->decimal('payment', 12, 2);
            $table->decimal('current_balance', 12, 2);
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->string('account_number')->nullable();
            $table->string('cheque_no')->nullable();
            $table->date('cheque_app_date')->nullable();
            $table->enum('status', ['Pending', 'Received'])->default('Pending');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();

            $table->index(['contact_id', 'payment_date']);
            $table->index('voucher_number');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_payments');
    }
};
