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
            
            $table->time('Work Time')->nullable();
            $table->string('Department')->nullable();
            $table->time('ATT_Time')->nullable();
            $table->time('Total_kerja')->nullable();
            $table->time('Hari_libur')->nullable();
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
