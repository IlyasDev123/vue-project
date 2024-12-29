<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone_no')->nullable();
            $table->string('social_login_id')->nullable();
            $table->tinyInteger('type')->default(1);
            $table->string('avatar')->nullable();
            $table->boolean('is_directly_assign')->default(false);
            $table->boolean('is_agree_with_terms_condition')->default(false);
            $table->boolean('is_blocked')->default(false);
            $table->foreignId('recruiter_id')->nullable()->constrained('users')->nullOnDelete();
            // $table->tinyInteger('premium_status')->default(1)->comment('1 => free, 2 => paid, 3 =>pending');
            $table->timestamp('email_verified_at')->nullable();
            $table->fullText(['first_name', 'last_name', 'email'])->language('english');
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};