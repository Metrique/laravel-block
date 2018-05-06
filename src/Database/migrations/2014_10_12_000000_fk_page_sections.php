<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkPageSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_sections', function (Blueprint $table) {
            $table->integer('pages_id')
                ->nullable()
                ->unsigned();

            $table->foreign('pages_id')
                ->references('id')
                ->on('pages')
                ->onDelete('cascade');

            $table->integer('components_id')
                ->nullable()
                ->unsigned();

            $table->foreign('components_id')
                ->references('id')
                ->on('components')
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
        Schema::table('page_sections', function (Blueprint $table) {
            $table->dropForeign('page_sections_pages_id_foreign');
            $table->dropForeign('page_sections_components_id_foreign');
        });
    }
}
