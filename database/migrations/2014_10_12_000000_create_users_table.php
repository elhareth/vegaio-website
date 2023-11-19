<?php

use App\Enums\UserStatus;
use App\Enums\UserRole;

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('user_status', 15)->default(UserStatus::PENDING);
            $table->string('user_role', 15)->default(UserRole::USER);
            $table->jsonb('user_info')->default(json_encode([]));
            $table->timestamp('email_verified_at')->nullable();
            $table->datetime('activated_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
