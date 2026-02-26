<?php

use App\Enum\ProthesisLevel;
use App\Enum\ProthesisType;
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
        Schema::table('proposal_protheses', function (Blueprint $table) {
            $table->dropColumn('prothesis_type');

            $table->enum('prothesis_level', ProthesisLevel::values());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proposal_protheses', function (Blueprint $table) {
            $table->dropColumn('prothesis_level');
            $table->enum('prothesis_type', ProthesisType::values());
        });
    }
};
