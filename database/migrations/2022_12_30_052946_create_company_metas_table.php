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
        Schema::create('company_metas', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('current_role');
            $table->string('description', 1000)->nullable();
            $table->foreignId('prefer_work_location_id')->nullable()->constrained('prefer_work_locations')->nullOnDelete();
            $table->foreignId('team_loveable_aspect_id')->nullable()->constrained('team_lovable_aspects')->nullOnDelete();
            $table->foreignId('company_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('state_id')->nullable()->constrained('states')->nullOnDelete();
            $table->boolean('is_hiring')->default(false);
            $table->tinyInteger('premium_status')->default(1)->comment('1 => free, 2=> premium, 3 => pending, 4 => reject ');
            $table->fullText(['company_name', 'current_role', 'description'])->language('english');
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
        Schema::dropIfExists('company_metas');
    }
};