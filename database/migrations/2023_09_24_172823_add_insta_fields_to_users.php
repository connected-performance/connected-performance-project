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
        Schema::table('users', function (Blueprint $table) {
            $table->string('insta_access_token')->before('created_at');
            $table->string('insta_user_id')->before('created_at');
            $table->timestamp('token_expires_at')->nullable()->before('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('insta_access_token');
            $table->dropColumn('insta_user_id');
            $table->dropColumn('token_expires_at');
        });
    }
};
