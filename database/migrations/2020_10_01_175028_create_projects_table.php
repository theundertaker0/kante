<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();
            $table->string('lote',5);
            $table->string('frente',200)->nullable();
            $table->string('fondo',200)->nullable();
            $table->string('area',200)->nullable();
            $table->string('m2',200)->nullable();
            $table->string('total',200)->nullable();
            $table->string('enganche',200)->nullable();
            $table->string('saldo',200)->nullable();
            $table->string('coordenadas',500)->nullable();
            $table->string('ext1',200)->nullable();
            $table->string('ext2',200)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lotes');
    }
}
