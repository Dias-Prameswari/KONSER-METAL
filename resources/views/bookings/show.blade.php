<x-layouts.app>
  <section class="max-w-4xl mx-auto py-12 px-6">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-bold">Detail Pemesanan</h1>
      <div class="text-sm text-gray-500">Booking #{{ $booking->id }} •
        {{ $booking->order_date->translatedFormat('d F Y, H:i') }}
      </div>
    </div>

    <div class="card bg-base-100 shadow-md">
      <div class="lg:flex ">
        <div class="lg:w-1/3 p-4">
          <img
            src="{{ $booking->show?->gambar ? 
            asset('storage/' . $booking->show->gambar) 
            : 'https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp' }}"
            alt="{{ $booking->show?->judul ?? 'Show' }}" class="w-full object-cover mb-2" />
          <h2 class="font-semibold text-lg">{{ $booking->show?->judul ?? 'Show' }}</h2>
          <p class="text-sm text-gray-500 mt-1">{{ $booking->show?->lokasi ?? '' }}</p>
        </div>
        <div class="card-body lg:w-2/3">


          <div class="space-y-3">
            @foreach($booking->bookingItems as $d)
            <div class="flex justify-between items-center">
              <div>
                <div class="font-bold">{{ $d->pass->passType->nama ?? '-' }}</div>
                <div class="text-sm text-gray-500">Qty: {{ $d->jumlah }}</div>
              </div>
              <div class="text-right">
                <div class="font-bold">Rp {{ number_format($d->subtotal_harga, 0, ',', '.') }}</div>
              </div>
            </div>
            @endforeach
          </div>

          <div class="divider"></div>

          <div class="space-y-2">
            <div class="flex justify-between items-center">
              <span class="font-bold">Total</span>
              <span class="font-bold">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
            </div>

            <div class="flex justify-between items-center">
              <span class="text-sm text-gray-500">
                Diskon {{ $booking->discount?->nama ? '(' . $booking->discount->nama . ')' : '' }}
              </span>
              <span class="text-sm text-gray-500">
                - Rp {{ number_format($booking->discount_amount, 0, ',', '.') }}
              </span>
            </div>

            <div class="divider my-1"></div>

            <div class="flex justify-between items-center">
              <span class="font-bold text-lg">Total Bayar</span>
              <span class="font-bold text-lg">Rp {{ number_format($booking->final_total, 0, ',', '.') }}</span>
            </div>
          </div>

          <div class="flex justify-between items-center mt-2">
            <span class="text-sm text-gray-500">Metode Pembayaran</span>
            <span class="font-semibold">{{ $booking->paymentType?->nama ?? '-' }}</span>
          </div>

          
        </div>
      </div>
    </div>
    <div class="mt-6">
      <a href="{{ route('bookings.index') }}" class="btn btn-primary text-white">Kembali ke Riwayat Pemesanan</a>
    </div>
  </section>
</x-layouts.app>