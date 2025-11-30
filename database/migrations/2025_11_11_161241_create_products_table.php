<?php

use App\Enum\ProthesisLevel;
use App\Enum\Status;
use App\Enum\ManufacturerList;
use App\Enum\ProthesisSide;
use App\Enum\ProthesisSize;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->string('article', 50);
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('color_id');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->enum('status', Status::values())->default(Status::ACTIVE->value);
            $table->enum('type', ProthesisType::values());
            $table->enum('level', ProthesisLevel::values());
            $table->string('description', 1000);
            $table->enum('size', ProthesisSize::values());
            $table->enum('side', ProthesisSide::values());
            $table->integer('volume_size')->nullable()->default(null);
            $table->integer('length_size')->nullable()->default(null);
            $table->boolean('is_select_color')->default(true);
            $table->integer('price');
            $table->string('made', 15);
            $table->enum('manufacturer', ManufacturerList::values());
            $table->string('link', 255);
            $table->string('path', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
