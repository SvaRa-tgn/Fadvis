<?php

use App\Enum\GenderType;
use App\Enum\MessengerType;
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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('surname', 50);
            $table->string('name', 50);
            $table->string('patronymic', 50)->nullable();
            $table->date('birth_date');
            $table->enum('gender', GenderType::values());
            $table->string('email', 50);
            $table->string('phone',12);
            $table->enum('messenger', MessengerType::values());
            $table->enum('left_type', ProthesisType::values())->nullable();
            $table->enum('right_type', ProthesisType::values())->nullable();
            $table->enum('left_level', ProthesisLevel::values())->nullable();
            $table->enum('right_level', ProthesisLevel::values())->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
