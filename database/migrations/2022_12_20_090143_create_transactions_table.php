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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('invoice_id')->nullable()->constrained('invoices')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('extra_charge')->nullable()->constrained('ectra_charges')->onUpdate('cascade')->onDelete('cascade');
            $table->string('transaction_type')->comment('1 = customer , 2 = employee , 3 = admin')->nullable();
            $table->string('ammount')->nullable();
            $table->string('status')->comment('0 = decline 1 = success')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
