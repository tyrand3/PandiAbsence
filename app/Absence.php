<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    protected $fillable = ['emp no', 'Name','Date','Timetable','On Duty','Off Duty','Clock In','Clock Out','Late',
    'Early','Absent','OT Time','Work Time', 'Department','ATT_Time','Total_kerja','Hari Libur'];
}
