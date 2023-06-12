<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('transactionID')->nullable();
            $table->string('marchent_name')->nullable();
            $table->string('amount')->nullable();
            $table->string('category')->nullable();
            $table->string('reportNumber')->nullable();
            $table->string('expenseNumber')->nullable();
            $table->string('date')->nullable();
            $table->string('description')->nullable();
            $table->string('currency')->nullable();
            $table->string('type')->nullable();
            $table->string('hasTax')->nullable();
            $table->string('inserted')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
};
