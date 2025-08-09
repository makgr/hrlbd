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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('cont_id')->unique();
            $table->foreignId('business_id')->constrained('businesses')->onDelete('cascade');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->onDelete('cascade');
            $table->enum('type_id', ['customer', 'vendor', 'agent']);
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('set null');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('mobile_number');
            $table->string('alternative_number')->nullable();
            $table->string('email')->nullable();
            $table->text('permanent_address')->nullable();
            $table->text('present_address')->nullable();
            $table->string('passport_number');
            $table->string('nid_number');
            $table->date('dob');
            $table->string('occupation')->nullable();
            $table->string('profile_pic')->nullable();
            $table->unsignedBigInteger('division_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('thana_id')->nullable();
            $table->date('expire_date')->nullable();
            $table->date('medical_date')->nullable();
            $table->date('police_verify_date')->nullable();
            $table->date('bmit_date')->nullable();
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active');
            $table->date('date')->nullable();
            $table->foreignId('reference_id')->nullable()->constrained('references')->onDelete('set null');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();

            $table->index(['business_id', 'type_id']);
            $table->index('passport_number');
            $table->index('nid_number');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
