<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMediaTranslationsTableAddTimePeriodColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media_translations', function (Blueprint $table) {
            $table->string('time_period')->nullale()->after('location');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('media_translations', function (Blueprint $table) {
            $table->dropColumn('time_period');
        });
    }
}
