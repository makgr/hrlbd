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
        Schema::create('contact_ledgers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained('businesses')->onDelete('cascade');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->onDelete('cascade');
            $table->foreignId('contact_id')->constrained('contacts')->onDelete('cascade');
            $table->date('date');
            $table->enum('transaction_type', ['Collection', 'Payment', 'Cash Back', 'Payment Back', 'Replace', 'Purchases', 'Others']);
            $table->text('description')->nullable();
            $table->decimal('previous_balance', 12, 2)->default(0);
            $table->decimal('debit_amount', 12, 2)->default(0);
            $table->decimal('credit_amount', 12, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('balance', 12, 2)->default(0);
            $table->tinyInteger('insert_status')->comment('1-collection, 2-payment, 3-cash back, 4-payment back, 5-replacement, 6-purchase, 7-others');
            $table->unsignedBigInteger('insert_id')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();

            $table->index(['contact_id', 'date']);
            $table->index('transaction_type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_ledgers');
    }
};
