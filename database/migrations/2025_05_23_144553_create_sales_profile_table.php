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
        Schema::create('sales_profile', function (Blueprint $table) {
            $table->bigInteger('spId',11);
            $table->integer('usersId',11);
            $table->string('spCode',10);
            $table->enum('spGender', ['Male', 'Female', 'Unknown'])->default('Unknown');
            $table->string('spPhone', 25);
            $table->text('spNIK');
            $table->text('spAddress');
            $table->text('spTtdCode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_profile');
    }
};
