<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\OrderItem;
use App\Models\Invoice;
use Illuminate\Support\Facades\Validator;

class PembelianController extends Controller
{
    public function index()
    {
        return Pembelian::with('orderItems')->get();
    }

    public function show($id)
    {
        $pembelian = Pembelian::with('orderItems')->find($id);
        if ($pembelian) {
            return response()->json($pembelian);
        }
        return response()->json(['message' => 'Pembelian not found'], 404);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.menu_id' => 'required|exists:menu,id',
            'items.*.jumlah_porsi' => 'required|integer',
            'items.*.harga' => 'required|numeric',
        ]);

        $pembelian = Pembelian::create([
            'user_id' => $request->user()->id,
            'tanggal_pembelian' => now(),
        ]);

        foreach ($validated['items'] as $item) {
            OrderItem::create([
                'pembelian_id' => $pembelian->id,
                'menu_id' => $item['menu_id'],
                'jumlah_porsi' => $item['jumlah_porsi'],
                'harga' => $item['harga'],
            ]);
        }

        $invoice = Invoice::create([
            'pembelian_id' => $pembelian->id,
            'nomor_invoice' => 'INV-' . $pembelian->id,
            'total_harga' => array_sum(array_column($validated['items'], 'harga')),
            'tanggal_invoice' => now(),
            'status' => 'pending',
        ]);

        return response()->json([
            'pembelian' => $pembelian,
            'order_items' => $pembelian->orderItems,
            'invoice' => $invoice
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $pembelian = Pembelian::find($id);
        if (!$pembelian) {
            return response()->json(['message' => 'Pembelian not found'], 404);
        }

        $validated = $request->validate([
            'tanggal_pembelian' => 'sometimes|required|date',
        ]);

        $pembelian->update($validated);

        return response()->json($pembelian);
    }

    public function destroy($id)
    {
        $pembelian = Pembelian::find($id);
        if ($pembelian) {
            $pembelian->delete();
            return response()->json(['message' => 'Pembelian deleted successfully']);
        }
        return response()->json(['message' => 'Pembelian not found'], 404);
    }
}
