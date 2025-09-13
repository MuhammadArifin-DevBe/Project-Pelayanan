@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Pesanan</h2>

    <form action="{{ route('dashboard.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
            <input name="nama" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label for="falkutas" class="block text-sm font-medium text-gray-700">Falkutas</label>
            <input name="falkutas" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label for="npm" class="block text-sm font-medium text-gray-700">NPM</label>
            <input name="npm" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="product_id" class="block text-sm font-medium text-gray-700">Pilih Produk</label>
            <select name="product_id" id="product_id" onchange="updateHarga()" required class="mt-1 block w-full border border-gray-300 rounded px-3 py-2">
                <option value=""> Pilih Pesanan </option>
                @foreach ($products as $product)
                <option value="{{ $product->id }}" data-harga="{{ $product->harga }}">{{ $product->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
            <input type="number" name="harga" id="harga" readonly class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 bg-gray-100">
        </div>

        <div class="mb-4">
            <label for="qty" class="block text-sm font-medium text-gray-700">QTY</label>
            <input type="number" name="qty" id="qty" oninput="hitungJumlah()" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" readonly class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 bg-gray-100">
        </div>

        <div class="mb-6 flex justify-end">
            <a href="{{ route('dashboard') }}" class="mr-3 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
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