// create show blade.php js file
const form = document.getElementById("showForm");

if (form) {
    // jika form tidak ada, hentikan eksekusi script
    const fileInput = form.querySelector('input[type="file"]');
    const imagePreview = document.getElementById("imagePreview");
    const previewImg = document.getElementById("previewImg");
    const successAlert = document.getElementById("successAlert");

    if (fileInput) {
        // Preview gambar saat dipilih
        fileInput.addEventListener("change", function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImg && (previewImg.src = e.target.result);
                    imagePreview?.classList.remove("hidden");
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Handle reset
    form.addEventListener("reset", function () {
        imagePreview?.classList.add("hidden");
        successAlert?.classList.add("hidden");
    });
    // penutup create show blade.php js file
}

// index show blade.php js file
window.openDeleteShowModal = (button) => {
    const id = button.dataset.id;
    const modal = document.getElementById("delete_show_modal");
    const form = modal.querySelector("form");
    document.getElementById("delete_show_id").value = id;
    form.action = `/admin/shows/${id}`;
    modal.showModal();  
};

window.openDeletePassModal = (button) => {
  const id = button.dataset.id;
  const modal = document.getElementById("delete_pass_modal");
  const form = modal.querySelector("form");
  document.getElementById("delete_pass_id").value = id;
  form.action = `/admin/passes/${id}`;
  modal.showModal();
};

// penutup index show blade.php js file

// edit model
window.openEditModal = (button) => {
    const id = button.dataset.id;
    const tipe = button.dataset.tipe;
    const harga = button.dataset.harga;
    const stok = button.dataset.stok;

    const form = document.querySelector("#edit_pass_modal form");
    document.getElementById("edit_pass_id").value = id;
    document.getElementById("edit_tipe").value = tipe;
    document.getElementById("edit_harga").value = harga;
    document.getElementById("edit_stok").value = stok;

    // Set action dengan parameter ID
    form.action = `/admin/passes/${id}`;
    edit_pass_modal.showModal();
};
