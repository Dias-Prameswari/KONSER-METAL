<x-layouts.admin title="Manajemen Tipe Diskon">
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
                Manajemen Diskon
            </h1>
            <button class="btn btn-primary ml-auto" onclick="add_modal.showModal()">
                Tambah Diskon
            </button>
        </div>

        <div class="overflow-x-auto rounded-box bg-white p-5 shadow-xs">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tipe</th>
                        <th>Value</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Show</th>
                        <th>Aktif</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- menampilkan data diskon -->
                    @forelse ($discounts as $index => $discount)
                    @php
                    $startVal = $discount->start_at ? $discount->start_at->format('Y-m-d\TH:i') : '';
                    $endVal = $discount->end_at ? $discount->end_at->format('Y-m-d\TH:i') : '';
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $discount->nama }}</td>
                        <td>{{ $discount->type }}</td>
                        <td>
                            @if ($discount->type === 'percent')
                            {{ rtrim(rtrim(number_format($discount->value, 2, '.', ''), '0'), '.') }}%
                            @else
                            Rp {{ number_format($discount->value, 0, ',', '.') }}
                            @endif
                        </td>
                        <td>{{ $discount->start_at ? $discount->start_at->format('d M Y H:i') : '-' }}</td>
                        <td>{{ $discount->end_at ? $discount->end_at->format('d M Y H:i') : '-' }}</td>
                        <td>{{ $discount->show?->judul ?? 'Semua Event' }}</td>
                        <td>{{ $discount->is_active ? 'Ya' : 'Tidak' }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary mr-2"
                                onclick="openEditModal(this)"
                                data-id="{{ $discount->id }}"
                                data-show-id="{{ $discount->show_id }}"
                                data-nama="{{ $discount->nama }}"
                                data-type="{{ $discount->type }}"
                                data-value="{{ $discount->value }}"
                                data-start="{{ $startVal }}"
                                data-end="{{ $endVal }}"
                                data-active="{{ $discount->is_active ? '1' : '0' }}">
                                Edit
                            </button>

                            <button class="btn btn-sm bg-red-500 text-white"
                                onclick="openDeleteModal(this)"
                                data-id="{{ $discount->id }}">
                                Hapus
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">
                            Tidak ada diskon tersedia.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- penutup -->
    </div>

    <!-- Add diskon Modal -->
    <dialog id="add_modal" class="modal">
        <form method="POST" action="{{ route('admin.discounts.store') }}" class="modal-box">
            @csrf
            <h3 class="text-lg  font-bold mb-4">Tambah Diskon</h3>

            <div class="form-control w-full mb-4">
                <label class="label mb-2">
                    <span class="label-text">Nama</span>
                </label>
                <input type="text" placeholder="Masukkan Nama Diskon" class="input input-bordered w-full" name="nama" value="{{ old('nama') }}" required />

                @error('nama')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-control w-full mb-4">
                <label class="label"><span class="label-text">Tipe</span></label>
                <select class="select select-bordered w-full" name="type" required>
                    <option value="" disabled {{ old('type') ? '' : 'selected' }}>Pilih tipe</option>
                    <option value="percent" {{ old('type') === 'percent' ? 'selected' : '' }}>percent</option>
                    <option value="fixed" {{ old('type') === 'fixed' ? 'selected' : '' }}>fixed</option>
                </select>
                @error('type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="form-control w-full mb-4">
                <label class="label"><span class="label-text">Show</span></label>
                <select class="select select-bordered w-full" name="show_id">
                    <option value="">Semua Event (Global)</option>
                    @foreach($shows as $s)
                    <option value="{{ $s->id }}" {{ old('show_id') == $s->id ? 'selected' : '' }}>
                        {{ $s->judul }}
                    </option>
                    @endforeach
                </select>
                @error('show_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="form-control w-full mb-3">
                <label class="label"><span class="label-text">Value</span></label>
                <input type="number" step="0.01" min="0" class="input input-bordered w-full" name="value" value="{{ old('value') }}" required>
                @error('value') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="form-control w-full mb-3">
                <label class="label"><span class="label-text">Mulai</span></label>
                <input type="datetime-local" class="input input-bordered w-full" name="start_at" value="{{ old('start_at') }}">
                @error('start_at') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="form-control w-full mb-3">
                <label class="label"><span class="label-text">Selesai</span></label>
                <input type="datetime-local" class="input input-bordered w-full" name="end_at" value="{{ old('end_at') }}">
                @error('end_at') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="form-control w-full mb-3">
                {{-- biar selalu terkirim 0/1 --}}
                <input type="hidden" name="is_active" value="0">
                <label class="label cursor-pointer justify-start gap-3">
                    <input type="checkbox" class="checkbox" name="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                    <span class="label-text">Aktif</span>
                </label>
                @error('is_active') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="modal-action">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <button class="btn" onclick="add_modal.close()" type="reset">Batal</button>
            </div>
        </form>
    </dialog>

    <!-- Edit diskon Modal dengan retriieve ID -->
    <dialog id="edit_modal" class="modal">
        <form method="POST" class="modal-box">
            @csrf
            @method('PUT')

            <input type="hidden" name="discounts_id" id="edit_discounts_id">

            <h3 class="text-lg font-bold mb-4">Edit Diskon</h3>
            <div class="form-control w-full mb-4">
                <label class="label mb-2">
                    <span class="label-text">Nama Diskon</span>
                </label>
                <input type="text" placeholder="Masukkan Nama Diskon" class="input input-bordered w-full" id="edit_discounts_nama" name="nama" />

                @error('nama')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-control w-full mb-3">
                <label class="label"><span class="label-text">Tipe</span></label>
                <select class="select select-bordered w-full" id="edit_discounts_type" name="type" required>
                    <option value="percent">percent</option>
                    <option value="fixed">fixed</option>
                </select>
                @error('type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="form-control w-full mb-3">
                <label class="label"><span class="label-text">Value</span></label>
                <input type="number" step="0.01" min="0" class="input input-bordered w-full" id="edit_discounts_value" name="value">
                @error('value') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="form-control w-full mb-4">
                <label class="label"><span class="label-text">Show</span></label>
                <select class="select select-bordered w-full" id="edit_discounts_show_id" name="show_id">
                    <option value="">Semua Event (Global)</option>
                    @foreach($shows as $s)
                    <option value="{{ $s->id }}">{{ $s->judul }}</option>
                    @endforeach
                </select>
                @error('show_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="form-control w-full mb-3">
                <label class="label"><span class="label-text">Mulai</span></label>
                <input type="datetime-local" class="input input-bordered w-full" id="edit_discounts_start" name="start_at">
                @error('start_at') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="form-control w-full mb-3">
                <label class="label"><span class="label-text">Selesai</span></label>
                <input type="datetime-local" class="input input-bordered w-full" id="edit_discounts_end" name="end_at">
                @error('end_at') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="form-control w-full mb-3">
                <input type="hidden" name="is_active" value="0">
                <label class="label cursor-pointer justify-start gap-3">
                    <input type="checkbox" class="checkbox" id="edit_discounts_active" name="is_active" value="1">
                    <span class="label-text">Aktif</span>
                </label>
                @error('is_active') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="modal-action">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <button class="btn" onclick="edit_modal.close()" type="reset">Batal</button>
            </div>
        </form>
    </dialog>

    <!-- Delete diskon Modal -->
    <dialog id="delete_modal" class="modal">
        <form method="POST" class="modal-box">
            @csrf
            @method('DELETE')

            <input type="hidden" name="discounts_id" id="delete_discounts_id">

            <h3 class="text-lg font-bold mb-4">Hapus Diskon</h3>
            <p>Apakah Anda yakin ingin menghapus diskon ini?</p>
            <div class="modal-action">
                <button class="btn btn-error" type="submit">Hapus</button>
                <button class="btn" onclick="delete_modal.close()" type="reset">Batal</button>
            </div>
        </form>
    </dialog>

    <div id="discounts-page"
        data-has-error="{{ $errors->any() ? '1' : '0' }}"
        data-old-method="{{ old('_method') }}"
        data-old-id="{{ old('discounts_id') }}"
        data-old-nama="{{ old('nama') }}"
        data-old-type="{{ old('type') }}"
        data-old-value="{{ old('value') }}"
        data-old-start="{{ old('start_at') }}"
        data-old-end="{{ old('end_at') }}"
        data-old-show-id="{{ old('show_id') }}"
        data-old-active="{{ old('is_active') }}">
    </div>

    @vite('resources/js/admin/discounts.js')
</x-layouts.admin>