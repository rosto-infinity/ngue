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
        Schema::create('resultats', function (Blueprint $table) {
            $table->id();
            $table->string('note')->default(0);
            $table->unsignedBigInteger("student_id");
            $table->unsignedBigInteger("exam_id");
            $table->string("grade");
            $table->timestamps();

            $table->foreign("student_id")->references("id")->on("students")
            ->onDelete("restrict")
            ->onDelete("restrict");
            $table->foreign("exam_id")->references("id")->on("exams")
            ->onDelete("restrict")
            ->onDelete("restrict");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultats');
    }
};
