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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 255);
            $table->string('email', 255)->unique();
            $table->string('no_hp', 15);
            $table->string('alamat', 255);
            $table->text('foto')->default('profile-blank.jpeg');
            $table->string('password');
            $table->enum('role', ['Admin', 'Customer']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
