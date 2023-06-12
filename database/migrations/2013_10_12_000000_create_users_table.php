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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('sortname');
            $table->string('name');
            $table->string('papulation')->nullable();
            $table->string('rate_per')->nullable();
            $table->string('phonecode');
            $table->timestamps();
        });
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('country_id');
            $table->timestamps();
        });
        
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('papulation');
            $table->string('state_id');
            $table->timestamps();
        });

    // public function up()
    // {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid');
            $table->string('ebiz_customer_id')->nullable();
            $table->string('ebiz_customer_internal_id')->nullable();
            $table->string('ebiz_customer_number')->nullable();
            $table->string('ebiz_customer_payment_methd')->nullable();
            // $table->foreignId('role_id')->constrained('roles')->onUpdate('cascade')->onDelete('cascade');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->nullable();
            $table->string('email');
            $table->foreignId('countrie_id')->nullable()->constrained('countries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('state_id')->nullable()->constrained('states')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('citie_id')->nullable()->constrained('cities')->onUpdate('cascade')->onDelete('cascade');
            $table->text('address')->nullable();
            $table->date('dob')->nullable();
            $table->string('phone_number')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_employe')->default(false);
            $table->boolean('is_customer')->default(false);
            $table->boolean('is_lead')->default(false);
            $table->char('active_portal')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('status')->comment('1 = active , 0 = banned');
            $table->string('avatar')->nullable();
            $table->string('locale')->default('');
            $table->string('timezone')->default('');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
