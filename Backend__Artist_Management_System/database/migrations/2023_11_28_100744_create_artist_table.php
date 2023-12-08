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
        Schema::create('artist', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('dob');
            $table->enum('gender',['m','f','o']);
            $table->string('address');
            $table->date('first_release_year')->format('Y');
            $table->string('no_of_albums_released');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist');
    }
};
