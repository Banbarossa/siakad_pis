<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function anggotaRombels()
    {
        return $this->hasMany(AnggotaRombel::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
