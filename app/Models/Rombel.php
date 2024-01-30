<?php

namespace App\Models;

use App\Models\Guru;
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

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
