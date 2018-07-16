<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('en_title')
                  ->nullable();
            $table->string('fr_title')
                  ->nullable();
            $table->string('en_complete_title')
                  ->nullable();
            $table->string('fr_complete_title')
                  ->nullable();
            $table->string('artist')
                  ->nullable();
            $table->string('en_date')
                  ->nullable();
            $table->string('fr_date')
                  ->nullable();
            $table->string('en_location')
                  ->nullable();
            $table->string('fr_location')
                  ->nullable();
            $table->string('en_collection')
                  ->nullable();
            $table->string('fr_collection')
                  ->nullable();
            $table->string('en_art_medium')
                  ->nullable();
            $table->string('fr_art_medium')
                  ->nullable();
            $table->text('credit_line')
                  ->nullable();
            $table->string('museum')
                  ->nullable();
            $table->string('image_url')
                  ->nullable();
            $table->string('en_department')
                  ->nullable();
            $table->string('fr_department')
                  ->nullable();
    
            $table->boolean('imported')
                  ->default(0);
            $table->text('import_error')
                  ->nullable();
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
        Schema::dropIfExists('import_records');
    }
}
