<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTWaLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_wa_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agenda_id')->nullable();
            $table->unsignedBigInteger('pendamping_id')->nullable();
            $table->string('nama_pendamping')->nullable();
            $table->string('no_hp')->nullable();
            $table->text('pesan')->nullable();
            $table->boolean('status')->default(false);
            $table->text('response')->nullable();
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
        Schema::dropIfExists('t_wa_log');
    }
}
