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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_code');
            $table->bigInteger('invoice_number');
            $table->foreignId('created_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->date('issue_date');
            $table->date('due_date');
            $table->double('balance');
            $table->string('balance_status')->comment('0 = pendding , 1 = paid')->default('0');
            $table->longText('description');
            $table->string('time_period');
            $table->bigInteger('duration');
            $table->string('total_amount')->nullable();
            // $table->string('sub_total_amount')->nullable();
            $table->string('status')->default('0')->comment('0 = drift , 1 = send , 2 = expaired')->default('0');
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
        Schema::dropIfExists('invoices');
    }
};
