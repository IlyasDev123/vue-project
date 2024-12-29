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
        Schema::table('company_user_matches', function (Blueprint $table) {
            $table->text('details')->nullable()->after('interview_end_date_time')->comment('comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_user_matches', function (Blueprint $table) {
            $table->dropColumn('details');
        });
    }
};
