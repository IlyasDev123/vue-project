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
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profession_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('salary_id')->nullable()->constrained('salaries')->nullOnDelete();
            $table->foreignId('company_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('experience_id')->nullable()->constrained('experiences')->nullOnDelete();
            $table->foreignId('state_id')->nullable()->constrained('states')->nullOnDelete();
            $table->foreignId('prefer_work_location_id')->nullable()->constrained('prefer_work_locations')->nullOnDelete();
            $table->boolean('is_specfic_state')->default(1);
            $table->string('description', 1500)->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('positions');
    }
};
