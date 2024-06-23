<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    protected $table = 'patient';
    protected $primaryKey = 'pid';

    protected $fillable = [
        'pemail', 'pname', 'ppassword', 'paddress', 'pdob', 'ptel', 'usertype'
    ];

    protected $hidden = [
        'ppassword', 'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->ppassword;
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id', 'pid');
    }
}