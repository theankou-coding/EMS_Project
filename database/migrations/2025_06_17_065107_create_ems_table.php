<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');
            $table->string('event_name', 45);
            $table->string('category', 45);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('location', 45);
            $table->timestamps();
        });

        Schema::create('participations', function (Blueprint $table) {
            $table->id('participation_id');
            $table->unsignedBigInteger('event_id');
            $table->uuid('user_id');
            $table->date('participate_date');
            $table->timestamps();

            $table->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('participations');
        Schema::dropIfExists('events');
    }
};
