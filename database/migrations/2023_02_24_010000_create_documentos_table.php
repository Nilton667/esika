<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('armario_id');
            $table->string('nome')->unique();
            $table->string('tipo');
            $table->string('descricao')->nullable();
            $table->integer('visualizacao')->default(0);
            $table->string('ficheiro');
            $table->string('tamanho');
            $table->string('tipoficheiro');
            $table->string('estado');
            $table->timestamps();

            $table->foreign('armario_id')
            ->references('id')
            ->on('armarios')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos');
    }
}
