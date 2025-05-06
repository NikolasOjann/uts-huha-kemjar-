<div id="addModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Tambah Produk</h2>
        <form method="POST" action="addProduct.php">
            <label class="block mb-2">Nama Produk</label>
            <input type="text" name="name" required class="w-full border rounded px-3 py-2 mb-4">

            <label class="block mb-2">Harga</label>
            <input type="number" name="price" required class="w-full border rounded px-3 py-2 mb-4">

            <label class="block mb-2">URL Gambar</label>
            <input type="text" name="image" required class="w-full border rounded px-3 py-2 mb-4">

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeAddModal()"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
    }
</script>