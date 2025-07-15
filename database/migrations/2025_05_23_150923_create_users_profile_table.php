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
        Schema::create('users_profile', function (Blueprint $table) {
            $table->bigInteger('upId',11);
            $table->integer('usersId',11);
            $table->enum('upGender', ['Male', 'Female', 'Unknown'])->default('Unknown');
            $table->string('upPhone',50);
            $table->string('upNIK',50);
            $table->text('upAddress');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_profile');
    }
};
