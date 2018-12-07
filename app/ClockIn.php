<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ClockIn extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'username', 'time_in', 'time_out', 'day_of', 'id'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'password', 'id', 'user_id',
    ];

    protected $casts = [
        'day_of' => 'date:Y-m-d',
    ];

    public function userIdToUsername()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

}