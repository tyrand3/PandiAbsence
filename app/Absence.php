<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
<<<<<<< HEAD
    protected $fillable = ['emp no', 'Name','Date','Timetable','On Duty','Off Duty','Clock In','Clock Out','Late',
    'Early','Absent','OT Time','Work Time', 'Department','ATT_Time','Total_kerja'];
=======
    protected $fillable = ['id', 'name','date', 'work_time','absent'];
>>>>>>> 822d2f07d58a88f420fe6bfce0d26289dcb686c8
}
