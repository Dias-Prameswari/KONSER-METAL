<x-layouts.app>
  <section class="max-w-6xl mx-auto py-12 px-6">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-bold">Riwayat Pemesanan</h1>
    </div>

    <div class="space-y-4">
      @forelse($bookings as $booking)
        <article class="card lg:card-side bg-base-100 shadow-md overflow-hidden">
          <figure class="lg:w-48">
            <img
              src="{{ $booking->show?->gambar ? 
              asset('storage/' . $booking->show->gambar) 
              : 'https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp' }}"
              alt="{{ $booking->show?->judul ?? 'Show' }}" class="w-full h-full object-cover" />
          </figure>

          <div class="card-body flex justify-between ">
            <div>
              <div class="font-bold">booking #{{ $booking->id }}</div>
              <div class="text-sm text-gray-500 mt-1">{{ $booking->order_date->translatedFormat('d F Y, H:i') }}</div>
              <div class="text-sm mt-2">{{ $booking->show?->judul ?? 'Show' }}</div>
            </div>

            <div class="text-right">
              <div class="font-bold text-lg">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</div>
              <a href="{{ route('bookings.show', $booking) }}" class="btn btn-primary mt-3 text-white">Lihat Detail</a>
            </div>
          </div>
        </article>
      @empty
        <div class="alert alert-info">Anda belum memiliki pesanan.</div>
      @endforelse
    </div>
  </section>
</x-layouts.app>