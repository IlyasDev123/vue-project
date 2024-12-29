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
        Schema::create('company_user_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talent_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('position_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('company_id')->constrained('users')->cascadeOnDelete();
            $table->tinyInteger('status')->nullable()->comment('1 => send request by talent 2 => send request by company 3 => accept by Both, 4 => accept by talent, 5 => reject ');
            $table->tinyInteger('interview_request')->nullable()->comment('1 => send request by company  2 => send request by admin');
            $table->dateTimeTz('interview_start_date_time')->nullable();
            $table->dateTimeTz('interview_end_date_time')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('company_user_matches');
    }
};