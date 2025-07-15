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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->int('compId',5);
            $table->string('name',255);
            $table->string('email',255)->unique();
            $table->string('password');
            $table->string('role');
            $table->longText('address_office');
            $table->longText('phone_office');
            $table->longText('website_office');
            $table->string('kode_cabang');
            $table->enum('userStatus', ['Active', 'Inactive'])->default('Active');
            $table->timestamp('last_login_at');
            $table->string('login_ip',25);
            $table->string('login_browser',50);
            $table->string('login_device',25);
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
