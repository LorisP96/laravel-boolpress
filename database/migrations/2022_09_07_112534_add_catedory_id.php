<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCatedoryId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Aggiungo una colonna
            $table->unsignedBigInteger('category_id')->nullable();
            // Relazione con categories
            $table->foreign('category_id')->references('id')->on('categories')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Rimuovo la relazione
            $table->dropForeign('posts_category_id_foreign');
            // Rimuovo la tabella
            $table->dropColumn('category_id');
        });
    }
}
