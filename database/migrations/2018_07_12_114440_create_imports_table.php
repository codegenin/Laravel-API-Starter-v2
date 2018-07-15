<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file');
            $table->integer('total_rows')
                  ->default(0);
            $table->integer('imported_count')
                  ->default(0);
            $table->boolean('status')
                  ->default(0);
            $table->text('error')
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
        Schema::dropIfExists('imports');
    }
}
