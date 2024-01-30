<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }

    public function rombels()
    {
        return $this->hasMany(Rombel::class);
    }

    public function anggotaRombels()
    {
        return $this->belongsTo(Semester::class);
    }
}
