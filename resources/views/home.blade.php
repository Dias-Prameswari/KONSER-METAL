<x-layouts.app>
    <div class="hero bg-blue-900 min-h-screen">
        <div class="hero-content text-center text-white">
            <div class="max-w-4xl">
                <h1 class="text-5xl font-bold">Panggungnya Sudah Siap, Tinggal Kamu.</h1>
                <p class="py-6">
                    Cari show favorit, pilih genre, checkout beres.
                </p>
            </div>
        </div>
    </div>

    <section class="max-w-7xl mx-auto py-12 px-6">
        <div class="flex justify-between items-start mb-8">
            <h2 class="text-2xl font-black uppercase italic">Show</h2>

            <div class="flex flex-col items-end gap-2">
                <div class="flex gap-2 flex-wrap justify-end">
                    <a href="{{ route('home', array_filter(['q' => request('q')])) }}">
                        <x-user.genre-pill :label="'Semua'" :active="!request('genre')" />
                    </a>

                    @foreach($genres as $genre)
                    <a href="{{ route('home', array_filter(['genre' => $genre->id, 'q' => request('q')])) }}">
                        <x-user.genre-pill :label="$genre->nama" :active="request('genre') == $genre->id" />
                    </a>
                    @endforeach
                </div>

                @if(request('q'))
                <div class="text-sm text-gray-500">
                    Hasil pencarian: <span class="font-semibold">"{{ request('q') }}"</span>
                    <a href="{{ route('home', array_filter(['genre' => request('genre')])) }}" class="link link-primary ml-2">
                        Reset
                    </a>
                </div>
                @endif
            </div>
        </div>

        @if($shows->isEmpty())
        <div class="alert alert-info mb-6">
            <span>Show tidak ditemukan. Coba kata kunci lain.</span>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($shows as $show)
            <x-user.show-card
                :title="$show->judul"
                :date="$show->tanggal_waktu"
                :location="$show->lokasi"
                :price="$show->passes_min_harga"
                :image="$show->gambar"
                :href="route('shows.show', $show)" />
            @endforeach
        </div>
    </section>
</x-layouts.app>