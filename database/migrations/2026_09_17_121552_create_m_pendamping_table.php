<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMPendampingTable extends Migration
{
    public function up()
    {
        Schema::create('m_pendamping', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan')->nullable();
            $table->string('no_hp');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_pendamping');
    }
}
