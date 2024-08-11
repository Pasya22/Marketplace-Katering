<?php
namespace App\Models;

use App\Models\Pembelian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';

    protected $fillable = [
        'id_user', 'nama_menu', 'jenis_menu', 'foto',
        'harga', 'deskripsi',
    ];

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'id_menu', 'id_menu');
    }
}
