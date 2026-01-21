<x-layouts.admin title="Detail Show">
    <div class="container mx-auto p-10">
        @if (session('success'))
        <div class="toast toast-bottom toast-center z-50">
            <div class="alert alert-success">
                <span>{{ session('success') }}</span>
            </div>
        </div>

        <script>
            setTimeout(() => {
                document.querySelector('.toast')?.remove()
            }, 3000)
        </script>
        @endif
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title text-2xl mb-6">Detail Show</h2>

                <form id="showForm" class="space-y-4" method="post"
                    action="{{ route('admin.shows.update', $show->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Nama show -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Judul Show</span>
                        </label>
                        <input type="text" name="judul" placeholder="Contoh: Konser Musik Rock"
                            class="input input-bordered w-full" value="{{ $show->judul }}" disabled required />
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Deskripsi</span>
                        </label>
                        <br>
                        <textarea name="deskripsi" placeholder="Deskripsi lengkap tentang show..."
                            class="textarea textarea-bordered h-24 w-full" disabled required>{{ $show->deskripsi }}</textarea>
                    </div>

                    <!-- Tanggal & Waktu -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Tanggal & Waktu</span>
                        </label>
                        <input type="datetime-local" name="tanggal_waktu" class="input input-bordered w-full"
                            value="{{ $show->tanggal_waktu->format('Y-m-d\TH:i') }}" disabled required />
                    </div>

                    <!-- Lokasi -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Lokasi</span>
                        </label>
                        <input type="text" name="lokasi" placeholder="Contoh: Stadion Utama"
                            class="input input-bordered w-full" value="{{ $show->lokasi }}" disabled required />
                    </div>

                    <!-- genre -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Genre</span>
                        </label>
                        <select name="genre_id" class="select select-bordered w-full" required disabled>
                            <option value="" disabled selected>Pilih Genre</option>
                            @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}"
                                {{ $genre->id == $show->genre_id ? 'selected' : '' }}>
                                {{ $genre->nama }}
                            </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- Upload Gambar -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Gambar Show</span>
                        </label>
                        <input type="file" name="gambar" accept="image/*"
                            class="file-input file-input-bordered w-full" disabled />
                        <label class="label">
                            <span class="label-text-alt">Format: JPG, PNG, max 5MB</span>
                        </label>
                    </div>

                    <!-- Preview Gambar -->
                    <div id="imagePreview" class="overflow-hidden {{ $show->gambar ? '' : 'hidden' }}">
                        <label class="label">
                            <span class="label-text font-semibold">Preview Gambar</span>
                        </label>
                        <br>
                        <div class="avatar max-w-sm">
                            <div class="w-full rounded-lg">
                                @if ($show->gambar)
                                <img id="previewImg" src="{{ asset('storage/' . $show->gambar) }}"
                                    alt="Preview">
                                @else
                                <img id="previewImg" src="" alt="Preview">
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- menampilkan pass -->
    <div class="mt-10">
        <div class="flex">
            <h1 class="text-3xl font-semibold mb-4">List Pass</h1>
            <button onclick="add_pass_modal.showModal()" class="btn btn-primary ml-auto">Tambah Pass</button>
        </div>
        <div class="overflow-x-auto rounded-box bg-white p-5 shadow-xs">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="w-1/3">tipe</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($passes as $index => $pass)
                    <tr>
                        <th>{{ $index + 1 }}</th>
                        <td>{{ $pass->passType->nama ?? '-' }}</td>
                        <td>{{ $pass->harga }}</td>
                        <td>{{ $pass->stok }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary mr-2" onclick="openEditModal(this)"
                                data-id="{{ $pass->id }}"
                                data-pass-type-id="{{ $pass->pass_type_id }}"
                                data-harga="{{ $pass->harga }}"
                                data-stok="{{ $pass->stok }}">Edit</button>
                            <button type="button" class="btn btn-sm bg-red-500 text-white"
                                onclick="openDeletePassModal(this)"
                                data-id="{{ $pass->id }}">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada pass tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- tambah pass modal -->
    <dialog id="add_pass_modal" class="modal">
        <form method="POST" action="{{ route('admin.passes.store') }}" class="modal-box">
            @csrf

            <h3 class="text-lg font-bold mb-4">Tambah Pass</h3>

            <input type="hidden" name="show_id" value="{{ $show->id }}">

            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text font-semibold">Tipe Pass</span>
                </label>
                <select name="pass_type_id" class="select select-bordered w-full" required>
                    <option value="" disabled selected>Pilih Tipe Pass</option>
                    @foreach ($passTypes as $pt)
                    <option value="{{ $pt->id }}">{{ $pt->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text font-semibold">Harga</span>
                </label>
                <input type="number" name="harga" placeholder="Contoh: 50000" class="input input-bordered w-full"
                    required />
            </div>
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text font-semibold">Stok</span>
                </label>
                <input type="number" name="stok" placeholder="Contoh: 100" class="input input-bordered w-full"
                    required />
            </div>
            <div class="modal-action">
                <button class="btn btn-primary" type="submit">Tambah</button>
                <button class="btn" onclick="add_pass_modal.close()" type="reset">Batal</button>
            </div>
        </form>
    </dialog>

    <!-- edit pass modal -->
    <dialog id="edit_pass_modal" class="modal">
        <form method="POST" class="modal-box">
            @csrf
            @method('PUT')

            <input type="hidden" name="pass_id" id="edit_pass_id">

            <h3 class="text-lg font-bold mb-4">Edit Pass</h3>

            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text font-semibold">Tipe Pass</span>
                </label>
                <select name="pass_type_id" id="edit_pass_type_id" class="select select-bordered w-full" required>
                    <option value="" disabled selected>Pilih Tipe Pass</option>
                    @foreach ($passTypes as $pt)
                    <option value="{{ $pt->id }}">{{ $pt->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text font-semibold">Harga</span>
                </label>
                <input type="number" name="harga" id="edit_harga" placeholder="Contoh: 50000"
                    class="input input-bordered w-full" required />
            </div>
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text font-semibold">Stok</span>
                </label>
                <input type="number" name="stok" id="edit_stok" placeholder="Contoh: 100"
                    class="input input-bordered w-full" required />
            </div>
            <div class="modal-action">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <button class="btn" onclick="edit_pass_modal.close()" type="reset">Batal</button>
            </div>
        </form>
    </dialog>

    <!-- delete pass modal -->
    <dialog id="delete_pass_modal" class="modal">
        <form method="POST" class="modal-box">
            @csrf
            @method('DELETE')

            <input type="hidden" name="pass_id" id="delete_pass_id">

            <h3 class="text-lg font-bold mb-4">Hapus Pass</h3>
            <p>Apakah Anda yakin ingin menghapus pass ini?</p>
            <div class="modal-action">
                <button class="btn btn-primary" type="submit">Hapus</button>
                <button type="button" class="btn" onclick="document.getElementById('delete_pass_modal').close()" type="reset">Batal</button>
            </div>
        </form>
    </dialog>


    @vite('resources/js/admin/show.js')
</x-layouts.admin>