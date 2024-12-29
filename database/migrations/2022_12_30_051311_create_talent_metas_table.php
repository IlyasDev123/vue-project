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
        Schema::create('talent_metas', function (Blueprint $table) {
            $table->id();
            $table->string('current_role')->nullable();
            $table->string('description', 1000)->nullable();
            $table->foreignId('talent_id')->constrained('users')->cascadeOnDelete();
            $table->string('cv')->nullable();
            $table->foreignId('salary_id')->nullable()->constrained('salaries')->nullOnDelete();
            $table->foreignId('state_id')->nullable()->constrained('states')->nullOnDelete();
            $table->foreignId('prefer_work_location_id')->nullable()->constrained('prefer_work_locations')->nullOnDelete();
            $table->foreignId('employer_selection_preference_id')->nullable()->constrained('employer_selection_preferences')->nullOnDelete();
            $table->foreignId('coworker_review_id')->nullable()->constrained('coworker_reviews')->nullOnDelete();
            $table->foreignId('hobby_id')->nullable()->constrained('hobbies')->nullOnDelete();
            $table->boolean('is_searching')->default(false);
            $table->fullText(['current_role', 'description'])->language('english');
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
        Schema::dropIfExists('talent_metas');
    }
};