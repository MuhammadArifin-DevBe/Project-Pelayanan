<div>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
</div>
@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Produk</h2>

    <form action="{{ route('product.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Produk</label>
            <input type="text" name="nama" id="nama"
                value="{{ old('nama', $product->nama) }}"
                class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
            <input type="number" name="harga" id="harga"
                value="{{ old('harga', $product->harga) }}"
                class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
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