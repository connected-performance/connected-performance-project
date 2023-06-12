<?php

use Hamcrest\Description;
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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->nullable()->constrained('employees')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('form_builder_id')->nullable()->constrained('form_builders')->onUpdate('cascade')->onDelete('cascade');
            $table->string('form_name')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('services')->nullable();
            $table->longText('description')->nullable();
            $table->longText('note')->nullable();
            $table->string('phone')->nullable();
            $table->string('status')->comment('lead = 0 , pending = 1 , customer = 2 , loss =3')->nullable();
            $table->date('lead_date')->nullable();
            $table->string('working_status')->comment('pending = 0 , working = 1 , completed = 2')->default('0');
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
        Schema::dropIfExists('leads');
    }
};
