<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome')->unique();
            $table->string('descricao')->nullable();
            $table->timestamps();
        });

        /**
         * Tabela Pivo: permissao x funcao
         */
        Schema::create('funcao_permissao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('permissao_id');
            $table->unsignedBigInteger('funcao_id');

            $table->foreign('permissao_id')
                        ->references('id')
                        ->on('permissaos')
                        ->onDelete('cascade');
            $table->foreign('funcao_id')
                        ->references('id')
                        ->on('funcaos')
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
        Schema::dropIfExists('funcao_permissao');
        Schema::dropIfExists('funcaos');
    }
}
