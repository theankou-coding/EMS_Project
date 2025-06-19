<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $primaryKey = 'event_id';

    protected $fillable = [
        'event_name', 'category', 'start_date', 'end_date', 'location',
    ];

    public function participations()
    {
        return $this->hasMany(Participation::class, 'event_id', 'event_id');
    }
}

class User extends Model
{
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'username', 'gender', 'date_of_birth', 'location',
        'email', 'password', 'phone_number', 'registration_date'
    ];

    public function participations()
    {
        return $this->hasMany(Participation::class, 'user_id', 'user_id');
    }
}

class Participation extends Model
{
    protected $primaryKey = 'participation_id';

    protected $fillable = [
        'event_id', 'user_id', 'participate_date'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}

class Admin extends Model
{
    protected $primaryKey = 'admin_id';

    protected $fillable = [
        'name', 'email', 'password'
    ];
}