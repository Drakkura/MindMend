<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $table = 'sessions'; // Sesuaikan dengan nama tabel Anda jika berbeda
    protected $primaryKey = 'id'; // Primary key default

    protected $fillable = [
        'session_date', // dan kolom-kolom lainnya yang relevan
        'other_column',
    ];

    public $timestamps = true; // Sesuaikan dengan kebutuhan Anda
}
