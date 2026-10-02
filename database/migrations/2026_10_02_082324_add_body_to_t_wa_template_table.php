<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBodyToTWaTemplateTable extends Migration
{
    public function up()
    {
        Schema::table('t_wa_template', function (Blueprint $table) {
            $table->text('body')->nullable()->after('header');
        });
    }

    public function down()
    {
        Schema::table('t_wa_template', function (Blueprint $table) {
            $table->dropColumn('body');
        });
    }
}
