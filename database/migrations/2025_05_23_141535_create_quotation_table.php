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
        Schema::create('quotation', function (Blueprint $table) {
            $table->bigInteger('quotationId',11);
            $table->string('quoSlug',50);
            $table->string('quoCode',50);
            $table->string('quoCcompany',100);
            $table->string('quoProject',100);
            $table->string('quoPIC',50);
            $table->string('quoContact',50);
            $table->text('quoAddress',50);
            $table->longText('quoEmail',50);
            $table->string('quoTotal');
            $table->string('quoPeriodNote');
            $table->string('quoPpnNote');
            $table->string('quoTopNote');
            $table->string('quoDeliveryNote');
            $table->string('quoStockNote');
            $table->enum('quoStatus', ['Submited', 'On Process', 'Done', 'Canceled'])->default('Submited');
            $table->integer('usersId',11);
            $table->integer('compsId',11);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation');
    }
};
