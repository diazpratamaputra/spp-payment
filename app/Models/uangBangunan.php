<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class uangBangunan extends Model
{
    use HasFactory;
    protected $table = "uangBangunan";
    protected $fillable = ['id_siswa', 'nominal', 'total', 'sisa'];
}
