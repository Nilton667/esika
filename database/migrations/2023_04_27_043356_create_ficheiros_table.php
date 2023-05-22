<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFicheirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ficheiros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ficheiro_final');
            $table->unsignedBigInteger('documento_id');
            $table->timestamps();

            $table->foreign('documento_id')
            ->references('id')
            ->on('documentos')
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
        Schema::dropIfExists('ficheiros');
    }
}
