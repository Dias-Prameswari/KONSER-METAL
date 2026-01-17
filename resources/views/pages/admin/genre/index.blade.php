<x-layouts.admin title="Manajemen Genre">
    @if (session('success')) {{-- menampilkan notifikasi sukses --}}
    <div class="toast toast-bottom toast-center">
        <div class="alert alert-success">
            <span>
                {{ session('success') }}
            </span>
        </div>
    </div>

    <script>
        setTimeout(() => {
            document.querySelector('.toast').remove();
        }, 3000);
    </script>
    @endif

    <!-- pembuka -->
    <div class="container mx-auto p-10">
        <div class="flex">
            <h1 class="text-3xl font-semibold mb-4">
                Manajemen Genre
            </h1>
            <button class="btn btn-primary ml-auto" onclick="add_modal.showModal()">
                Tambah Genre
            </button>
        </div>

        <div class="overflow-x-auto rounded-box bg-white p-5 shadow-xs">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="w-3/4">Nama Genre</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- menampilkan data genre -->
                    @forelse ($genres as $index => $genre)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $genre->nama }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary mr-2"
                                onclick="openEditModal(this)"
                                data-id="{{ $genre->id }}"
                                data-nama="{{ $genre->nama }}">
                                Edit
                            </button>

                            <button class="btn btn-sm bg-red-500 text-white"
                                onclick="openDeleteModal(this)"
                                data-id="{{ $genre->id }}">
                                Hapus
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">
                            Tidak ada genre tersedia.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- penutup -->
    </div>

    <!-- Add Genre Modal -->
    <dialog id="add_modal" class="modal">
        <form method="POST" action="{{ route('admin.genres.store') }}" class="modal-box">
            @csrf
            <h3 class="text-lg  font-bold mb-4">Tambah Genre</h3>
            <div class="form-control w-full mb-4">
                <label class="label mb-2">
                    <span class="label-text">Nama Genre</span>
                </label>
                <input type="text" placeholder="Masukkan Nama Genre" class="input input-bordered w-full" name="nama" value="{{ old('nama') }}" required />

                @error('nama')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="modal-action">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <button class="btn" onclick="add_modal.close()" type="reset">Batal</button>
            </div>
        </form>
    </dialog>

    <!-- Edit Genre Modal dengan retriieve ID -->
    <dialog id="edit_modal" class="modal">
        <form method="POST" class="modal-box">
            @csrf
            @method('PUT')

            <input type="hidden" name="genres_id" id="edit_genres_id">

            <h3 class="text-lg font-bold mb-4">Edit Genre</h3>
            <div class="form-control w-full mb-4">
                <label class="label mb-2">
                    <span class="label-text">Nama Genre</span>
                </label>
                <input type="text" placeholder="Masukkan Nama Genre" class="input input-bordered w-full" id="edit_genre_nama" name="nama" />

                @error('nama')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="modal-action">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <button class="btn" onclick="edit_modal.close()" type="reset">Batal</button>
            </div>
        </form>
    </dialog>

    <!-- Delete Genre Modal -->
    <dialog id="delete_modal" class="modal">
        <form method="POST" class="modal-box">
            @csrf
            @method('DELETE')

            <input type="hidden" name="genres_id" id="delete_genres_id">

            <h3 class="text-lg font-bold mb-4">Hapus Genre</h3>
            <p>Apakah Anda yakin ingin menghapus genre ini?</p>
            <div class="modal-action">
                <button class="btn btn-error" type="submit">Hapus</button>
                <button class="btn" onclick="delete_modal.close()" type="reset">Batal</button>
            </div>
        </form>
    </dialog>

    <div id="genre-page"
        data-has-error="{{ $errors->has('nama') ? '1' : '0' }}"
        data-old-method="{{ old('_method') }}"
        data-old-nama="{{ old('nama') }}"
        data-old-id="{{ old('genres_id') }}">
    </div>

    @vite('resources/js/admin/genre.js')
</x-layouts.admin>