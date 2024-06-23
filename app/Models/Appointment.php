<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointment'; // Sesuaikan dengan nama tabel Anda

    protected $fillable = ['pid', 'apponum', 'scheduleid', 'appodate'];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'pid');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'scheduleid');
    }
}
