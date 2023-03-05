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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_name');
            $table->foreignId('course_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('year_level_id');
            $table->unsignedBigInteger('academic_year_id');
            $table->timestamps();

            $table->foreign('year_level_id')
                ->references('id')
                ->on('year_level')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('academic_year_id')
                ->references('id')
                ->on('year_level')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
