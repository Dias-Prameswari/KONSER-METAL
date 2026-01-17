<x-layouts.admin title="Manajemen Show">
    @if (session('success'))
    <div class="toast toast-bottom toast-center">
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

    <div class="container mx-auto p-10">
        <div class="flex">
            <h1 class="text-3xl font-semibold mb-4">Manajemen Show</h1>
            <a href="{{ route('admin.shows.create') }}" class="btn btn-primary ml-auto">Tambah Show</a>
        </div>
        <div class="overflow-x-auto rounded-box bg-white p-5 shadow-xs">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="w-1/3">Judul</th>
                        <th>Genre</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($shows as $index => $show)
                    <tr>
                        <th>{{ $index + 1 }}</th>
                        <td>{{ $show->judul }}</td>
                        <td>{{ $show->genre->nama }}</td>
                        <td>{{ $show->tanggal_waktu->format('d M Y') }}</td>
                        <td>{{ $show->lokasi }}</td>
                        <td>
                            <a href="{{ route('admin.shows.show', $show->id) }}" class="btn btn-sm btn-info mr-2">Detail</a>
                            <a href="{{ route('admin.shows.edit', $show->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                            <button type="button" class="btn btn-sm bg-red-500 text-white" 
                            onclick="openDeleteShowModal(this)" data-id="{{ $show->id }}">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada show tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Modal -->
    <dialog id="delete_show_modal" class="modal">
        <form method="POST" class="modal-box">
            @csrf
            @method('DELETE')

            <input type="hidden" name="show_id" id="delete_show_id">

            <h3 class="text-lg font-bold mb-4">Hapus Show</h3>
            <p>Apakah Anda yakin ingin menghapus show ini?</p>
            <div class="modal-action">
                <button class="btn btn-primary" type="submit">Hapus</button>
                <button type="button" class="btn" onclick="document.getElementById('delete_show_modal').close()">Batal</button>
            </div>
        </form>
    </dialog>

    @vite('resources/js/admin/show.js')
</x-layouts.admin>