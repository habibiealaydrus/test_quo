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
        Schema::create('roles', function (Blueprint $table) {
            $table->bigInteger('rolesId');
            $table->string('rolesName',50);
            $table->tinyInteger('developer');
            $table->tinyInteger('superAdmin');
            $table->tinyInteger('generalManager');
            $table->tinyInteger('administrator');
            $table->tinyInteger('salesManager');
            $table->tinyInteger('salesSupervisor');
            $table->tinyInteger('salesEngineer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
