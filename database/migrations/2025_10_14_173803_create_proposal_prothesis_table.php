<?php

use App\Enum\AgePeriod;
use App\Enum\ProposalStatus;
use App\Enum\ProthesisFunction;
use App\Enum\ProthesisType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Run the migrations. */
    public function up(): void
    {
        Schema::create('proposal_protheses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('surname', 50);
            $table->string('patronymic', 50)->nullable();
            $table->string('email', 50);
            $table->string('phone', 12);
            $table->string('city', 50);
            $table->enum('age_period', AgePeriod::values());
            $table->boolean('is_program')->default(false);
            $table->enum('prothesis_type', ProthesisType::values());
            $table->enum('prothesis_function', ProthesisFunction::values());
            $table->string('questions', 500)->nullable();
            $table->enum('status', ProposalStatus::values())->default(ProposalStatus::NEW);
            $table->timestamps();
        });
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        Schema::dropIfExists('proposal_protheses');
    }
};
