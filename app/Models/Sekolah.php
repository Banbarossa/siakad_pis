<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function rombel()
    {
        return $this->hasMany(Rombel::class);
    }

}
