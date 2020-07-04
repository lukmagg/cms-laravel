<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldFilePathToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */



     // Esta miracion fue para agregar la columna file_path a la base de datos
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('file_path')->after('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
