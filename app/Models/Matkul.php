<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;

    protected $table = 'matkul';
    
    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'matkul_mahasiswa', 'matkul_id', 'mahasiswa_id');
    }
}
