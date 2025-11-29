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
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            // Claves foraneas
            $table->foreignId("student_id")
                  ->constrained();

            $table->foreignId("subject_id")
                  ->constrained();

            // Para que un alumno no se pueda inscribir mas de una vez
            $table->unique(["student_id","subject_id"]);
            
            //Atributos
            $table->timestamp("registration_date")->useCurrent();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
