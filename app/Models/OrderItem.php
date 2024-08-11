<?php

namespace App\Models;

use App\Models\Menu;
use App\Models\Pembelian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $fillable = [
        'id_pembelian', 'id_menu', 'jumlah_porsi', 'harga'
    ];

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'id_pembelian');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}

