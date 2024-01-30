<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    use HasFactory;

    protected $guarded = [''];

    // scopeSearch

    public function scopeSearch($query, $term)
    {

        $columns = ['nomor_surat', 'jenis_surat', 'tanggal_pengajuan', 'keperluan'];
        foreach ($columns as $column) {
            $query->orWhere($column, 'like', "%{$term}%");
        }
        return $query;
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function pengajusurat()
    {
        return $this->belongsTo(User::class, 'diajukan_oleh');
    }

    public function penerimasurat()
    {
        return $this->belongsTo(User::class, 'disetujui_oleh');
    }
}
