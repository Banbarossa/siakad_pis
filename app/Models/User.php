<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeSearch($query, $term)
    {
        $columns = ['name', 'email'];
        foreach ($columns as $column) {
            $query->orWhere($column, 'like', "%{$term}%");
            return $query;
        }

    }

    public function students()
    {
        // return $this->belongsToMany(Student::class, 'user_student', 'user_id', 'student_id');
        return $this->belongsToMany(Student::class)->withPivot('type');
    }

    public function pengajuanSuratDiajukan()
    {
        return $this->hasMany(PengajuanSurat::class, 'diajukan_oleh');
    }

    public function pengajuanSuratDisetujui()
    {
        return $this->hasMany(PengajuanSurat::class, 'disetujui_oleh');
    }

    public function sekolah()
    {
        return $this->hasMany(Sekolah::class);
    }

    public function guru()
    {
        return $this->hasOne(Guru::class);
    }

    public function pegawai()
    {
        return $this->hasOne(user::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

}
