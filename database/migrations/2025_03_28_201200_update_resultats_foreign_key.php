<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        
        Schema::table('resultats', function (Blueprint $table) {
            // Supprimer l'ancienne contrainte
            $table->dropForeign(['student_id']);

            // Ajouter la nouvelle contrainte avec suppression en cascade
            $table->foreign('student_id')
                  ->references('id')->on('students')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('resultats', function (Blueprint $table) {
            $table->dropForeign(['student_id']);

            // Remettre la contrainte sans cascade (optionnel)
            $table->foreign('student_id')
                  ->references('id')->on('students');
        });
    }
};
