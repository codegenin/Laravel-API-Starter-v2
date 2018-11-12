<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDownloadImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('download_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')
                  ->index();
            $table->boolean('is_done')
                  ->default(0);
            $table->boolean('has_error')
                  ->default(0);
            $table->text('error_message')
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
        Schema::dropIfExists('download_images');
    }
}
