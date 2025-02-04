<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi'; // nama tabel

    protected $fillable = [
        'user_id',
        'tanggal_absen',
        'jam_masuk',
        'status',
        'note' 
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
