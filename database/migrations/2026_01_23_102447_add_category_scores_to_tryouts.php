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
        Schema::table('tryouts', function (Blueprint $table) {
            //
            $table->integer('score_twk')->default(0);
            $table->integer('score_tiu')->default(0);
            $table->integer('score_tkp')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        Schema::table('tryouts', function (Blueprint $table) {
            //
            $table->dropColumn(['score_twk', 'score_tiu','score_tkp']);
        });
    }
};
