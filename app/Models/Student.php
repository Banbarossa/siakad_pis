<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // Scope Aktif
    public function scopeSiswaAktif($query)
    {
        return $query->where('status_siswa', 'aktif');
    }

    // Scope Lulus
    public function scopeSiswaLulus($query)
    {
        return $query->where('status_siswa', 'lulus');
    }

    //Scope Pindah
    public function scopeSiswaPindah($query)
    {
        return $query->where('status_siswa', 'keluar');
    }

    // Scope Pencarian
    public function scopeSearch($query, $term)
    {
        $columns = ['nama', 'nisn', 'nis_sekolah', 'nis_pesantren', 'ayah_nama', 'ibu_nama'];

        foreach ($columns as $column) {
            $query->orWhere($column, 'like', "%{$term}%");
        }
        return $query;
    }

    // Relasi

    public function guardians()
    {
        return $this->belongsToMany(Guardian::class)->withPivot('type');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('type');
    }

    public function akun()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pelanggarans()
    {
        return $this->hasMany(Pelanggaran::class);
    }

    public function prestasis()
    {
        return $this->hasMany(Prestasi::class);
    }

    public function scholarships()
    {
        return $this->hasMany(Student::class);
    }

    public function riwayatpendidikans()
    {
        return $this->hasMany(RiwayatPendidikan::class);
    }

    public function pengajuansurats()
    {
        return $this->hasMany(PengajuanSurat::class);
    }

    public function anggotaRombels()
    {
        return $this->hasMany(AnggotaRombel::class);
    }

    public function rombel()
    {
        return $this->belongsTo(Rombel::class);
    }
    public function alumni()
    {
        return $this->hasOne(Alumni::class);
    }

    public function mutasikeluar()
    {
        return $this->hasOne(MutasiKeluar::class);
    }

    // Relasi Alamat

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

}
