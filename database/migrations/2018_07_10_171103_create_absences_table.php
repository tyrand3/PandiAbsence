<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emp no');
            $table->string('Name');
            $table->Date('Date');
            $table->string('Timetable');
            $table->time('On Duty');
            $table->time('Off Duty');
            $table->time('Clock In')->nullable();
            $table->time('Clock Out')->nullable();
            $table->time('Late')->nullable();
            $table->time('Early')->nullable();
            $table->boolean('absent')->nullable();
            $table->time('OT Time')->nullable();
            //Hari Libur','Cuti','PerDin Lk','Perdin Dalkot','Sakit','Tanpa keterangan','Keterangan'
            $table->time('Work Time')->nullable();
            $table->string('Department')->nullable();
            $table->time('ATT_Time')->nullable();
            $table->time('Total_kerja')->nullable();
            $table->string('Hari_libur')->nullable();
            $table->boolean('Cuti')->nullable();
            $table->boolean('PerDin LK')->nullable();
            $table->boolean('PerDin Dalkot')->nullable();
            $table->boolean('Sakit')->nullable();
            $table->boolean('Tanpa Keterangan')->nullable();
            $table->boolean('Keterangan')->nullable();
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
        Schema::dropIfExists('absences');
    }
}
