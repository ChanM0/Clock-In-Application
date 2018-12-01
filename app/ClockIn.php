<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ClockIn extends Model
{
    protected $guarded = [];

    protected $casts = [
        'day_of' => 'date:Y-m-d',
    ];
}