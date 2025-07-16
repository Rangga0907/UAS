<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jamaah extends Model
{
    use HasFactory;
    /**
     * Nama tabel yang digunakan oleh model.
     *
     * @var string
     */
    protected $table = 'jamaah';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     * 
     */
    protected $fillable = [
        'nama_lengkap',
        'alamat',
        'no_telepon',
        'jenis_kelamin',
        'tanggal_lahir',
        'status_keaktifan',
    ];
}