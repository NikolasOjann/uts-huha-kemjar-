<div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Edit Produk</h2>
        <form id="editForm" method="POST" action="editProduct.php">
            <input type="hidden" name="id" id="edit-id">

            <label class="block mb-2">Nama Produk</label>
            <input type="text" name="name" id="edit-name" class="w-full border rounded px-3 py-2 mb-4">

            <label class="block mb-2">Harga</label>
            <input type="number" name="price" id="edit-price" class="w-full border rounded px-3 py-2 mb-4">

            <label class="block mb-2">URL Gambar</label>
            <input type="text" name="image" id="edit-image" class="w-full border rounded px-3 py-2 mb-4">

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeEditModal()"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>


<script>
    function EditData(product) {
        document.getElementById('edit-id').value = product.id;
        document.getElementById('edit-name').value = product.name;
        document.getElementById('edit-price').value = product.price;
        document.getElementById('edit-image').value = product.image;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>