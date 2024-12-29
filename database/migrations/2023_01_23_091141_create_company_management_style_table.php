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
        Schema::create('company_meta_management_style', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_meta_id')->constrained('company_metas')->cascadeOnDelete();
            $table->foreignId('management_style_id')->constrained('management_styles')->cascadeOnDelete();
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
        Schema::dropIfExists('company_meta_management_style');
    }
};
