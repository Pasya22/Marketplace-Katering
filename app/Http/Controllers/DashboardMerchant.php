<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class DashboardMerchant extends Controller
{
    public function DashboardMerchant()
    {
        return view('Dashboard-merchant.Dashboard');
    }
    public function DataMakanan()
    {
        $menus = Menu::all();
        return view('Dashboard-merchant.DataMakanan',compact('menus'));
    }

    public function merchant_tambah()
    {
        return view('Dashboard-merchant.merchantTambah');
    }
    public function merchant_edit()
    {
        return view('Dashboard-merchant.merchantEdit');

    }
    public function merchant_delete()
    {

    }
}
