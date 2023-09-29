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
        Schema::table('customers', function (Blueprint $table) {
            $table->boolean('is_converted')->default(0);
            $table->timestamp('convert_date')->nullable();
            $table->enum('convert_reason',['no-renew','contract-broken'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('is_converted');
            $table->dropColumn('conert_date');
            $table->dropColumn('convert_reason');
        });
    }
};
