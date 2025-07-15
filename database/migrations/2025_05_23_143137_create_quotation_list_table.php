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
        Schema::create('quotation_list', function (Blueprint $table) {
            $table->bigInteger('quLilld',20);
            $table->integer('quoId',11);
            $table->string('code',100);
            $table->string('users',100);
            $table->string('item',100);
            $table->integer('quantity',11);
            $table->bigInteger('price',255);
            $table->integer('discount',11);
            $table->longText('description');
            $table->text('image');
            $table->bigInteger('subtotal',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_list');
    }
};
