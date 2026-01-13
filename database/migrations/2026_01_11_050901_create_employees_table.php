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
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->foreignId('designtion_id')->nullable()->constrained('designations')->nullOnDelete();
            $table->string('first_name', 30);
            $table->string('middle_name', 30)->nullable();
            $table->string('last_name', 30);
            $table->string('email')->unique;
            $table->string('mobile_number', 15);
            $table->string('password', 12)->nullable();
            $table->date('date_of_birth');
            $table->string('profile_picture')->nullable();
            $table->tinyInteger('gender')->comment('1 = male, 2 = female');
            $table->date('date_of_joining')->nullable();
            $table->date('exit_date')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1 - active , 0 = inactive');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
