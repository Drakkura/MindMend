<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    protected $table = 'patient'; // Nama tabel di database adalah 'patient'
    protected $primaryKey = 'pid'; // Primary key adalah 'pid'

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = true;

    // Nama atribut yang bisa diisi massal
    protected $fillable = [
        'pname',
        'pemail',
        'ppassword',
        'paddress',
        'pdob',
        'ptel',
        'usertype',
    ];

    protected $hidden = [
        'ppassword', // Jangan tampilkan password di output JSON
        'remember_token',
    ];

    protected $casts = [
        'pdob' => 'date', // Konversi pdob ke tipe date
    ];

    // Definisikan relasi ke model lain jika ada
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id', 'pid');
    }
}
