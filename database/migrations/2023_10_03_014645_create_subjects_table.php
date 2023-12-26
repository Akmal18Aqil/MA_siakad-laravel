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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->bigInteger('lecturer_id')->unsigned();
            $table->string('semester')->nullable();
            $table->string('academic_year')->nullable();
            $table->integer('sks')->nullable();
            $table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('lecturer_id', 'lecturerid_foreign')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};