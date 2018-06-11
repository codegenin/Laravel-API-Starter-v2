<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media', function (Blueprint $table) {
            $table->unsignedInteger('user_id')
                  ->nullable()
                  ->after('id');
            $table->string('title')
                  ->nullable()
                  ->after('user_id');
            $table->string('location')
                  ->nullable()
                  ->after('title');
            $table->unsignedInteger('year')
                  ->nullable()
                  ->after('location');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('media', function (Blueprint $table) {
        
        });
    }
}
