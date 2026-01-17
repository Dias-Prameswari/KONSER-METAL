<x-layouts.admin title="Dashboard Admin">
    <!-- pembuka -->
    <div class="container mx-auto p-10">
        <h1 class="text-3xl font-semibold mb-4">
            Dashboard Admin
        </h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-5">
            <!-- Total Shows Card -->
            <div class="card bg-base-100 card-sm shadow-xs p-2">
                <div class="card-body">
                    <h2 class="card-title text-md">
                        Total Shows
                    </h2>
                    <p class="font-bold text-4xl">
                        {{ $totalShows ?? 0 }}
                    </p>
                </div>
            </div>

            <!-- Total Bookings Card -->
            <div class="card bg-base-100 card-sm shadow-xs p-2">
                <div class="card=body">
                    <h2 class="card-title text-md">
                        Genre
                    </h2>
                    <p class="font-bold text-4xl">
                        {{ $totalGenre ?? 0 }}
                    </p>
                </div>
            </div>

            <!-- Total Passes Card -->
            <div class="card bg-base-100 card-sm shadow-xs p-2">
                <div class="card=body">
                    <h2 class="card-title text-md">
                        Total Transaksi
                    </h2>
                    <p class="font-bold text-4xl">
                        {{ $totalBookings ?? 0 }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- penutup -->
</x-layouts.admin>