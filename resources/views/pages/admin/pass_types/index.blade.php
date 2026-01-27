<x-layouts.admin title="Manajemen Tipe Pass">
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
                Manajemen Tipe Pass
            </h1>
            <button class="btn btn-primary ml-auto" onclick="add_modal.showModal()">
                Tambah Tipe
            </button>
        </div>

        <div class="overflow-x-auto rounded-box bg-white p-5 shadow-xs">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="w-3/4">Nama Tipe</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- menampilkan data tipe -->
                    @forelse ($passTypes as $index => $passType)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $passType->nama }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary mr-2"
                                onclick="openEditModal(this)"
                                data-id="{{ $passType->id }}"
                                data-nama="{{ $passType->nama }}">
                                Edit
                            </button>

                            <button class="btn btn-sm bg-red-500 text-white"
                                onclick="openDeleteModal(this)"
                                data-id="{{ $passType->id }}">
                                Hapus
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">
                            Tidak ada tipe tersedia.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- penutup -->
    </div>

    <!-- Add tipe Modal -->
    <dialog id="add_modal" class="modal">
        <form method="POST" action="{{ route('admin.pass-types.store') }}" class="modal-box">
            @csrf
            <h3 class="text-lg  font-bold mb-4">Tambah Tipe</h3>
            <div class="form-control w-full mb-4">
                <label class="label mb-2">
                    <span class="label-text">Nama Tipe</span>
                </label>
                <input type="text" placeholder="Masukkan Nama Tipe" class="input input-bordered w-full" name="nama" value="{{ old('nama') }}" required />

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

    <!-- Edit tipe Modal dengan retriieve ID -->
    <dialog id="edit_modal" class="modal">
        <form method="POST" class="modal-box">
            @csrf
            @method('PUT')

            <input type="hidden" name="pass_types_id" id="edit_pass_types_id">

            <h3 class="text-lg font-bold mb-4">Edit Tipe</h3>
            <div class="form-control w-full mb-4">
                <label class="label mb-2">
                    <span class="label-text">Nama Tipe</span>
                </label>
                <input type="text" placeholder="Masukkan Nama Tipe" class="input input-bordered w-full" id="edit_pass_types_nama" name="nama" />

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

    <!-- Delete tipe Modal -->
    <dialog id="delete_modal" class="modal">
        <form method="POST" class="modal-box">
            @csrf
            @method('DELETE')

            <input type="hidden" name="pass_types_id" id="delete_pass_types_id">

            <h3 class="text-lg font-bold mb-4">Hapus Tipe</h3>
            <p>Apakah Anda yakin ingin menghapus tipe ini?</p>
            <div class="modal-action">
                <button class="btn btn-error" type="submit">Hapus</button>
                <button class="btn" onclick="delete_modal.close()" type="reset">Batal</button>
            </div>
        </form>
    </dialog>

    <div id="pass_type-page"
        data-has-error="{{ $errors->has('nama') ? '1' : '0' }}"
        data-old-method="{{ old('_method') }}"
        data-old-nama="{{ old('nama') }}"
        data-old-id="{{ old('pass_types_id') }}">
    </div>

    @vite('resources/js/admin/pass_type.js')
</x-layouts.admin>