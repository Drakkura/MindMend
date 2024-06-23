<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedule'; // Pastikan sesuai dengan nama tabel yang ada di database

    protected $primaryKey = 'scheduleid'; // Nama kolom primary key

    protected $fillable = [
        'docid',
        'title',
        'scheduledate',
        'scheduletime',
        'nop',
    ];

    // Definisikan relasi ke model Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'docid', 'docid');
    }
}