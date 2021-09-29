<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->longText('introduccion')->nullable();
            $table->longText('descripcion')->nullable();
            $table->string('imagen')->nullable();
            $table->longText('contenido')->nullable();
            $table->string('imagen2')->nullable();
            $table->longText('diferenciadores')->nullable();
            $table->boolean('status')->nullable();
            $table->longText('carac_adi')->nullable();
            $table->longText('info_adi')->nullable();
            $table->string('slug');
            $table->timestamps();
            //FK
            $table->unsignedBigInteger('padre_id')->nullable();
            $table->foreign('padre_id')->references('id')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropForeign('menus_padre_id_foreign');
        });
        Schema::dropIfExists('menus');
    }
}
