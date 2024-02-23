<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function istripegawai()
    {
        return $this->hasOne(Istripegawai::class);
    }

    public function anakpegawai()
    {
        return $this->hasMany(Anakpegawai::class);
    }

    public function rombels()
    {
        return $this->hasMany(Pegawai::class);
    }

    public function sekolah()
    {
        return $this->hasMany(Sekolah::class);
    }
}
