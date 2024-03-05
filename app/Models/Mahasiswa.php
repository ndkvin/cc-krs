<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    
    protected $guarded = ['id'];

    public function matkul()
    {
        return $this->belongsToMany(Matkul::class, 'matkul_mahasiswa', 'mahasiswa_id', 'matkul_id');
    }
}
