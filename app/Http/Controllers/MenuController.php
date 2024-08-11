<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return response()->json($menus);
    }

    public function show($id)
    {
        $menu = Menu::find($id);
        if ($menu) {
            return response()->json($menu);
        }
        return response()->json(['message' => 'Menu not found'], 404);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id',
            'nama_menu' => 'required',
            'harga' => 'required|numeric',
        ]);

        $menu = Menu::create($validated);
        return response()->json($menu, 201);
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return response()->json(['message' => 'Menu not found'], 404);
        }

        $validated = $request->validate([
            'id_user' => 'sometimes|required|exists:users,id',
            'nama_menu' => 'sometimes|required',
            'harga' => 'sometimes|required|numeric',
        ]);

        $menu->update($validated);
        return response()->json($menu);
    }

    public function destroy($id)
    {
        $menu = Menu::find($id);
        if ($menu) {
            $menu->delete();
            return response()->json(['message' => 'Menu deleted successfully']);
        }
        return response()->json(['message' => 'Menu not found'], 404);
    }
}
