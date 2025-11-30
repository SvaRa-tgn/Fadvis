<?php

use App\Enum\ProposalStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Run the migrations. */
    public function up(): void
    {
        Schema::create('proposal_prices', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('surname', 50);
            $table->string('patronymic', 50)->nullable();
            $table->string('email', 50);
            $table->string('phone', 12);
            $table->string('organization',50);
            $table->string('city', 50);
            $table->string('interest', 255)->nullable();
            $table->string('questions', 500)->nullable();
            $table->enum('status', ProposalStatus::values())->default(ProposalStatus::NEW);
            $table->timestamps();
        });
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        Schema::dropIfExists('proposal_prices');
    }
};
