function openEditModal(button) {
    const id = button.dataset.id;
    const nama = button.dataset.nama || "";
    const type = button.dataset.type || "percent";
    const value = button.dataset.value || "";
    const start = button.dataset.start || "";
    const end = button.dataset.end || "";
    const active = button.dataset.active === "1";

    const form = document.querySelector("#edit_modal form");
    // set action form dinamis berdasarkan ID tipe
    form.action = `/admin/discounts/${id}`;

    document.getElementById("edit_discounts_id").value = id;
    document.getElementById("edit_discounts_nama").value = nama;
    document.getElementById("edit_discounts_type").value = type;
    document.getElementById("edit_discounts_value").value = value;
    document.getElementById("edit_discounts_start").value = start;
    document.getElementById("edit_discounts_end").value = end;
    document.getElementById("edit_discounts_active").checked = active;

    edit_modal.showModal();
}

function openDeleteModal(button) {
    const id = button.dataset.id;
    const form = document.querySelector("#delete_modal form");
    // set action form dinamis berdasarkan ID tipe
    form.action = `/admin/discounts/${id}`;

    document.getElementById("delete_discounts_id").value = id;
    delete_modal.showModal();
}

// Auto-open modal saat validasi gagal
document.addEventListener("DOMContentLoaded", () => {
    const el = document.getElementById("discounts-page");
    if (!el) return;

    const hasError = el.dataset.hasError === "1";
    if (!hasError) return;

    const method = el.dataset.oldMethod;
    const oldId = el.dataset.oldId || "";

    if (method === "PUT") {
        const form = document.querySelector("#edit_modal form");
        if (oldId) form.action = `/admin/discounts/${oldId}`;

        document.getElementById("edit_discounts_id").value = oldId;
        document.getElementById("edit_discounts_nama").value =
            el.dataset.oldNama || "";
        document.getElementById("edit_discounts_type").value =
            el.dataset.oldType || "percent";
        document.getElementById("edit_discounts_value").value =
            el.dataset.oldValue || "";
        document.getElementById("edit_discounts_start").value =
            el.dataset.oldStart || "";
        document.getElementById("edit_discounts_end").value =
            el.dataset.oldEnd || "";
        document.getElementById("edit_discounts_active").checked =
            el.dataset.oldActive === "1";

        edit_modal.showModal();
    } else {
        add_modal.showModal();
    }
});

// bikin fungsi bisa dipanggil dari onclick di HTML
window.openEditModal = openEditModal;
window.openDeleteModal = openDeleteModal;
