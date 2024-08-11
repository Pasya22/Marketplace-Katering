<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('pembelian')->get();
        return response()->json($invoices);
    }

    public function show($id)
    {
        $invoice = Invoice::with('pembelian')->find($id);
        if ($invoice) {
            return response()->json($invoice);
        }
        return response()->json(['message' => 'Invoice not found'], 404);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pembelian' => 'required|exists:pembelian,id_pembelian',
            'nomor_invoice' => 'required|unique:invoice,nomor_invoice',
            'total_harga' => 'required|numeric',
            'tanggal_invoice' => 'required|date',
            'status' => 'required|in:pending,paid,cancelled',
        ]);

        $invoice = Invoice::create($validated);
        return response()->json($invoice, 201);
    }

    public function update(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found'], 404);
        }

        $validated = $request->validate([
            'id_pembelian' => 'sometimes|required|exists:pembelian,id_pembelian',
            'nomor_invoice' => 'sometimes|required|unique:invoice,nomor_invoice,' . $id,
            'total_harga' => 'sometimes|required|numeric',
            'tanggal_invoice' => 'sometimes|required|date',
            'status' => 'sometimes|required|in:pending,paid,cancelled',
        ]);

        $invoice->update($validated);
        return response()->json($invoice);
    }

    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        if ($invoice) {
            $invoice->delete();
            return response()->json(['message' => 'Invoice deleted successfully']);
        }
        return response()->json(['message' => 'Invoice not found'], 404);
    }
}
