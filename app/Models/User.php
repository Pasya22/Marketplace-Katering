<?php
namespace App\Models;

use App\Models\Menu;
use App\Models\Pembelian;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model implements AuthenticatableContract
{
    use HasApiTokens, HasFactory, Notifiable,Authenticatable;

    protected $table = 'users';

    protected $fillable = [
        'username', 'password', 'email', 'nama_perusahaan',
        'alamat', 'no_telp', 'deskripsi', 'level'
    ];

    protected $hidden = [
        'password',
    ];

    public function menu()
    {
        return $this->hasMany(Menu::class, 'id_user', 'id');
    }

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'id_user', 'id');
    }
}
