<div>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
</div>
@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Update Pesanan</h2>

    <form action="{{ route('dashboard.update', $dashboard->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="product_id" class="block text-sm font-medium text-gray-700">Pilih Produk</label>
            <select name="product_id" id="product_id" onchange="updateHarga()" required class="mt-1 block w-full border border-gray-300 rounded px-3 py-2">
                <option value="">-- Pilih Produk --</option>
                @foreach ($products as $product)
                <option value="{{ $product->id }}" data-harga="{{ $product->harga }}"
                    {{ $product->id == $dashboard->product_id ? 'selected' : '' }}>
                    {{ $product->nama }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
            <input type="number" name="harga" id="harga" value="{{ $dashboard->product->harga }}" readonly class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 bg-gray-100">
        </div>

        <div class="mb-4">
            <label for="qty" class="block text-sm font-medium text-gray-700">QTY</label>
            <input type="number" name="qty" id="qty" value="{{ old('qty', $dashboard->qty) }}" oninput="hitungJumlah()" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', $dashboard->jumlah) }}" readonly class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 bg-gray-100">
        </div>

        <div class="mb-6 flex justify-end">
            <a href="{{ route('dashboard.index') }}" class="mr-3 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>

<script>
    function updateHarga() {
        const select = document.getElementById('product_id');
        const harga = select.options[select.selectedIndex].getAttribute('data-harga');
        document.getElementById('harga').value = harga || 0;
        hitungJumlah();
    }

    function hitungJumlah() {
        const harga = parseInt(document.getElementById('harga').value) || 0;
        const qty = parseInt(document.getElementById('qty').value) || 0;
        document.getElementById('jumlah').value = harga * qty;
    }
</script>
@endsection