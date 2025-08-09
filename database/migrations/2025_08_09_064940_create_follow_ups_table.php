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
        Schema::create('follow_ups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained('businesses')->onDelete('cascade');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->onDelete('cascade');
            $table->foreignId('contact_id')->constrained('contacts')->onDelete('cascade');
            $table->foreignId('assigned_to')->constrained('users')->onDelete('cascade');
            $table->string('subject');
            $table->text('description')->nullable();
            $table->enum('status', ['Pending', 'Completed', 'Overdue'])->default('Pending');
            $table->date('due_date');
            $table->date('follow_up_date');
            $table->timestamps();

            $table->index(['contact_id', 'status']);
            $table->index(['assigned_to', 'status']);
            $table->index('due_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('follow_ups');
    }
};
