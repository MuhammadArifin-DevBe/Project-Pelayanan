@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Pesanan</h1>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {!! session('success') !!}
    </div>
    @endif


    <a href="{{ route('dashboard.create') }}" class="text-blue-700 inline-block hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Tambah Pesanan</a>
    <a href="{{ route('dashboard.print') }}" id="btn-cetak" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Cetak PDF
    </a>



    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr class="bg-gray-200 text-left">
                <th scope="col" class="px-6 py-3">#</th>
                <th scope="col" class="px-6 py-3">Nama Produk</th>
                <th scope="col" class="px-6 py-3">Harga</th>
                <th scope="col" class="px-6 py-3">QTY</th>
                <th scope="col" class="px-6 py-3">Jumlah</th>
                <th scope="col" class="px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dashboard as $item)
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->product->nama ?? 'Produk tidak ditemukan' }}</td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Rp{{ number_format($item->product->harga ?? 0, 0, ',', '.') }}
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->qty }}</td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Rp{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <a href="{{ route('dashboard.edit', $item->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded">Edit</a>
                    <form action="{{ route('dashboard.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center px-4 py-4">Belum ada transaksi.</td>
            </tr>
            @endforelse

            <tr class="font-bold bg-gray-100 dark:bg-gray-700">
            <tr class="font-bold bg-gray-100 dark:bg-gray-700">
                <td colspan="4" class="px-6 py-4 text-right">JUMLAH</td>
                <td class="px-6 py-4 text-green-600 text-left">Rp{{ number_format($dashboard->sum('jumlah'), 0, ',', '.') }}</td>
            </tr>
            <td></td>
            </tr>
        </tbody>

    </table>

    <div class="mt-4">
        {{ $dashboard->links() }}
    </div>
</div>
@endsection