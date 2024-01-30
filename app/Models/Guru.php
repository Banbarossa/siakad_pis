<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $searchTerm)
    {

        return $query
            ->where('nama_lengkap', 'like', '%' . $searchTerm . '%')
            ->orWhere('tempat_lahir', 'like', '%' . $searchTerm . '%')
            ->orWhere('alamat', 'like', '%' . $searchTerm . '%');

    }

    public function rombels()
    {
        return $this->hasMany(Rombel::class);

    }
}
