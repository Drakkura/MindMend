<?php
// File: app/Models/Doctor.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{

    protected $table = 'psikolog';
    protected $primaryKey = 'docid';

    protected $fillable = [
        'docemail',
        'docname',
        'docpassword',
        'doctel',
        'specialties',
    ];

    protected $hidden = [
        'docpassword',
        'remember_token',
    ];

    // Optionally, specify the column for "password" to be used by Laravel's Auth system.
    public function getAuthPassword()
    {
        return $this->docpassword;
    }
}
