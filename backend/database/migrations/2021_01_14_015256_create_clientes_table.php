<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->nullable();
            $table->string('first_name')->nullable();
            $table->string('razon_social')->nullable();
            $table->string('rif')->nullable();
            $table->string('direccion')->nullable();
            $table->string('avatar')->nullable();
            $table->string('telefono')->nullable();
            $table->string('notas')->nullable();
            $table->integer('estatus')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
