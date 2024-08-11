<?php
namespace App\Models;

use App\Models\Invoice;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';
    protected $fillable = ['menu_id', 'user_id', 'nama_pembelian', 'harga_pembelian', 'jumlah_porsi', 'tanggal_pembelian'];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu', 'id_menu');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'id_pembelian', 'id_pembelian');
    }
}
