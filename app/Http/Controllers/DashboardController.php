<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Dashboard;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use App\Models\OrderHistory;

class DashboardController extends Controller
{
    public function index(): View
    {
        $dashboard = Dashboard::with('product')->latest()->paginate(10);
        return view('dashboard.index', compact('dashboard'));
    }

    public function print()
    {
        $dashboard = Dashboard::with('product')->latest()->get();

        // Render view menjadi PDF dan simpan ke variabel
        $pdf = Pdf::loadView('dashboard.print', compact('dashboard'));
        $pdfOutput = $pdf->output(); // proses PDF dulu

        // Pindahkan data ke order_histories
        foreach ($dashboard as $item) {
            OrderHistory::create([
                'nama' => $item->nama,
                'falkutas' => $item->falkutas,
                'npm' => $item->npm,
                'product_id' => $item->product_id,
                'qty' => $item->qty,
                'jumlah' => $item->jumlah,
            ]);
        }

        // Hapus semua data setelah dipindah
        Dashboard::truncate();

        // Kembalikan file PDF sebagai download response
        return response($pdfOutput)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="laporan-pesanan.pdf"');
    }

    public function reset()
    {
        Dashboard::truncate(); // reset data
        return response()->json(['status' => 'reset']); // balikan ke JS
    }

    public function history()
    {
        $history = OrderHistory::with('product')->latest()->get();

        return view('dashboard.history', compact('history'));
    }

    public function create()
    {
        $products = Product::all();
        return view('dashboard.create', compact('products'));
    }

    public function store(Request $request)
    {
            // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'falkutas' => 'required|string|max:255',
            'npm' => 'required|string|max:50',
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|numeric|min:1',
        ]);

        $product = Product::find($request->product_id);
        $jumlah = $request->qty * $product->harga;

        Dashboard::create([
            'nama' => $request->nama,
            'falkutas' => $request->falkutas,
            'npm' => $request->npm,
            'product_id' => $product->id,
            'qty' => $request->qty,
            'jumlah' => $jumlah,
        ]);

        return redirect()->route('dashboard')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $dashboard = Dashboard::findOrFail($id);
        $products = Product::all();
        return view('dashboard.edit', compact('dashboard', 'products'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'falkutas' => 'required|string|max:255',
            'npm' => 'required|string|max:50',
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|numeric|min:1',
        ]);

        $dashboard = Dashboard::findOrFail($id);
        $product = Product::find($request->product_id);
        $jumlah = $request->qty * $product->harga;

        $dashboard->update([
            'nama' => $request->nama,
            'falkutas' => $request->falkutas,
            'npm' => $request->npm,
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'jumlah' => $jumlah,
        ]);

        return redirect()->route('dashboard')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        Dashboard::findOrFail($id)->delete();
        return redirect()->route('dashboard')->with('success', 'Data berhasil dihapus!');
    }
}
