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
        Schema::create('meeting_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_lead_id')->constrained('leads')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('fk_user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->date('meeting-date');
            $table->time('meeting-time');
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
        Schema::dropIfExists('_meeting_schedules');
    }
};
