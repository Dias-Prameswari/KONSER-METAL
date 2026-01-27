<x-layouts.admin title="Riwayat Pemesanan">
    <div class="container mx-auto p-10">
        <div class="flex">
            <h1 class="text-3xl font-semibold mb-4">Riwayat Pemesanan</h1>
        </div>
        <div class="overflow-x-auto rounded-box bg-white p-5 shadow-xs">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pembeli</th>
                        <th>Show</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($riwayats as $index => $riwayat)
                    <tr>
                        <th>{{ $index + 1 }}</th>
                        <td>{{ $riwayat->user->name }}</td>
                        <td>{{ $riwayat->show?->judul ?? '-' }}</td>
                        <td>{{ $riwayat->order_date->format('d M Y') }}</td>
                        <td>{{ number_format($riwayat->total_harga, 0, ',', '.') }}</td>
                        <td>{{ $r->paymentType?->nama ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.riwayats.show', $riwayat->id) }}" class="btn btn-sm btn-info text-white">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada riwayat pemesanan tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>