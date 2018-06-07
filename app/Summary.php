<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    protected $fillable = ['nama','total_hari_kerja', 'total_absen','terlambat','att_time'];
}
