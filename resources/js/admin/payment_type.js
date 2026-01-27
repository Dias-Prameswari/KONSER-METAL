function openEditModal(button) {
    const id = button.dataset.id;
    const nama = button.dataset.nama;
    const form = document.querySelector("#edit_modal form");

    document.getElementById("edit_payment_types_id").value = id;
    document.getElementById("edit_payment_types_nama").value = nama;

    // set action form dinamis berdasarkan ID tipe
    form.action = `/admin/payment_types/${id}`;

    edit_modal.showModal();
}

function openDeleteModal(button) {
    const id = button.dataset.id;
    const form = document.querySelector("#delete_modal form");

    document.getElementById("delete_payment_types_id").value = id;

    // set action form dinamis berdasarkan ID tipe
    form.action = `/admin/payment_types/${id}`;

    delete_modal.showModal();
}

// Auto-open modal saat validasi gagal
document.addEventListener("DOMContentLoaded", () => {
    const el = document.getElementById("payment_type-page");
    if (!el) return;

    const hasError = el.dataset.hasError === "1";
    if (!hasError) return;

    const method = el.dataset.oldMethod;
    const oldNama = el.dataset.oldNama || "";
    const oldId = el.dataset.oldId || "";

    if (method === "PUT") {
        const form = document.querySelector("#edit_modal form");
        if (oldId) {
            form.action = `/admin/payment_types/${oldId}`;
            document.getElementById("edit_payment_types_id").value = oldId;
        }
        document.getElementById("edit_payment_types_nama").value = oldNama;
        edit_modal.showModal();
    } else {
        add_modal.showModal();
    }
});

// bikin fungsi bisa dipanggil dari onclick di HTML
window.openEditModal = openEditModal;
window.openDeleteModal = openDeleteModal;
