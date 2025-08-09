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
        Schema::create('vendor_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained('businesses')->onDelete('cascade');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->onDelete('cascade');
            $table->foreignId('vendor_id')->constrained('contacts')->onDelete('cascade');
            $table->enum('service_type', ['Flight', 'Hotel', 'Visa', 'Transport']);
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('set null');
            $table->decimal('price', 10, 2);
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();

            $table->index(['vendor_id', 'service_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('vendor_prices');
    }
};
