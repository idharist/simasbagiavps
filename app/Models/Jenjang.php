<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenjang extends Model
{
    use HasFactory;
    protected $table = "jenjang";
    protected $fillable = ['nama_jenjang', 'deskripsi'];

    public function Siswa()
    {
        return $this->hasMany('App\Models\Siswa', 'id_jenjang', 'id');
    }
}
