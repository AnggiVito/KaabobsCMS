<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard = 'user';

    protected $table = 'tbl_user';

    protected $fillable = [
        'nip',
        'username',
        'password',
        'role',
        'name',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_telpon',
        'email',
        'tanggal_bergabung',
        'tanggal_berakhir',
        'departemen',
        'status_pekerjaan',
        'foto',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
}
