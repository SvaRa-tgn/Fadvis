<?php

use App\Enum\Status;
use App\Enum\MessengerType;
use App\Enum\UserRoles;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Run the migrations. */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('surname', 50);
            $table->string('name', 50);
            $table->string('patronymic', 50)->nullable();
            $table->string('slug', 100);
            $table->enum('role', UserRoles::values())->default('user');
            $table->string('email', 50)->unique();
            $table->string('phone',12)->unique();
            $table->string('site', 50)->nullable();
            $table->enum('messenger', MessengerType::getAllMessenger());
            $table->string('organization', 50);
            $table->string('address', 255);
            $table->string('inn', 12)->nullable();
            $table->string('ogrn', 15)->nullable();
            $table->enum('status', Status::values())->default(Status::ACTIVE);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
