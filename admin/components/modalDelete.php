<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-xl font-semibold mb-4">Konfirmasi Hapus</h2>
        <p class="mb-4">Apakah Anda yakin ingin menghapus produk ini?</p>
        <div class="flex justify-end space-x-2">
            <button onclick="closeModalDelete()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
            <a id="confirmDeleteBtn" href="#" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</a>
        </div>
    </div>
</div>



<script>
    function DeleteData(productId) {
        const modal = document.getElementById('deleteModal');
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        confirmBtn.href = `deleteProduct.php?id=${productId}`;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModalDelete() {
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
</script>