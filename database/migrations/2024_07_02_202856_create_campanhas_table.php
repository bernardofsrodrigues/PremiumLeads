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
        Schema::create('campanhas', function (Blueprint $table) {
            $table->id();
            $table->foreignId("banco_id")->constrained("bancos");
            $table->foreignId("user_id")->constrained('users')->onDelete('cascade');
            $table->string("nome");
            $table->string("uuid_tabela");
            $table->integer("sit_campanha")->default(0);
            $table->integer("registros");
            $table->integer("processados")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campanhas');
    }
};
