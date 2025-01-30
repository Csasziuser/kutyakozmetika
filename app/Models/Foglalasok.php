<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Foglalasok extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['foglalo_neve','nap','ora'];
    protected $table = 'foglalasok';

}
