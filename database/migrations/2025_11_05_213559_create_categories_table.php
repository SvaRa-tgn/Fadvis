<?php

use App\Enum\Status;
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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->string('slug', 60)->unique();
            $table->string('second_name', 100);
            $table->string('description_index', 500);
            $table->string('description_page', 2000);
            $table->string('link', 300);
            $table->string('path', 300);
            $table->enum('status', Status::values())->default(Status::ACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
