<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUser1sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user1s', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('email');
            $table->string('name');
            $table->string('password');
            $table->rememberToken();
            $table->string('img')->default('https://firebasestorage.googleapis.com/v0/b/imagenes-de-perfil.appspot.com/o/silhouette-4.jpg?alt=media&token=fa5a8750-f371-43ed-9a5d-15044d9e0ce8');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user1s');
    }
}
