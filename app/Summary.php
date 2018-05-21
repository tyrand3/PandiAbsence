<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    protected $fillable = ['id', 'name','date', 'work time','absent'];
}
