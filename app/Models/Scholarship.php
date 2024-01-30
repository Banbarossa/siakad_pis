<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeSearch($query, $term)
    {

        $columns = ['student_id', 'tahun', 'sumber', 'jumlah'];
        foreach ($columns as $column) {
            $query->where($column, 'like', "%{$term}%");
        }
        return $query;
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
