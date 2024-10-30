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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id')->unique();
            $table->string('emp_name');
            $table->date('join_date');
            $table->enum('gender', ['male', 'female']);
            $table->integer('age');
            $table->string('family_status');
            $table->string('finger_id');
            $table->enum('emp_status', ['active', 'inactive', 'on_leave']);
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('division_id')->nullable();
            $table->unsignedBigInteger('departmen_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();
            $table->date('contract_from_date')->nullable();
            $table->date('due_date')->nullable();
            $table->date('permanent_date');
            $table->date('resign_date');
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->text('note');
            $table->boolean('inactive')->default(false);
            $table->timestamps();
        });

        // Optional: Adding foreign key constraints
        // $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
        // $table->foreign('division_id')->references('id')->on('divisions')->onDelete('set null');
        // $table->foreign('departmen_id')->references('id')->on('departments')->onDelete('set null');
        // $table->foreign('branch_id')->references('id')->on('branches')->onDelete('set null');
        // $table->foreign('position_id')->references('id')->on('positions')->onDelete('set null');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
