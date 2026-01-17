<x-layouts.admin title="Edit Show">
    <div class="container mx-auto p-10">
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title text-2xl mb-6">Edit Show</h2>

                <form id="showForm" class="space-y-4" method="post"
                    action="{{ route('admin.shows.update', $show->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- nama show -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Judul Show</span>
                        </label>
                        <input type="text" name="judul" placeholder="Contoh: Konser Musik Rock"
                            class="input input-bordered w-full" value="{{ $show->judul }}" required />
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Deskripsi</span>
                        </label>
                        <br>
                        <textarea name="deskripsi" placeholder="Deskripsi lengkap tentang show..."
                            class="textarea textarea-bordered h-24 w-full" required>{{ $show->deskripsi }}</textarea>
                    </div>

                    <!-- Tanggal & Waktu -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Tanggal & Waktu</span>
                        </label>
                        <input type="datetime-local" name="tanggal_waktu" class="input input-bordered w-full"
                            value="{{ $show->tanggal_waktu->format('Y-m-d\TH:i') }}" required />
                    </div>

                    <!-- Lokasi -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Lokasi</span>
                        </label>
                        <input type="text" name="lokasi" placeholder="Contoh: Stadion Utama"
                            class="input input-bordered w-full" value="{{ $show->lokasi }}" required />
                    </div>

                    <!-- genre -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Genre</span>
                        </label>
                        <select name="genre_id" class="select select-bordered w-full" required>
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
                            class="file-input file-input-bordered w-full" />
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

                    <!-- Tombol Submit -->
                    <div class="card-actions justify-end mt-6">
                        <button type="reset" class="btn btn-ghost">Reset</button>
                        <button type="submit" class="btn btn-primary">Simpan Show</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Alert Success -->
        <div id="successAlert" class="alert alert-success mt-4 hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Show berhasil disimpan!</span>
        </div>
    </div>

    @vite('resources/js/admin/show.js')
</x-layouts.admin>