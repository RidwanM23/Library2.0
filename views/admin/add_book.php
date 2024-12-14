<?php require 'views/partials/header.php'; ?>

<div class="container mt-4">
    <h2>Tambah Buku Baru</h2>

    <?php if (isset($this->error)): ?>
        <div class="alert alert-danger"><?= $this->error ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?page=add-book">
        <div class="mb-3">
            <label for="tittle" class="form-label">Judul Buku</label>
            <input type="text" class="form-control" id="tittle" name="tittle" required>
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Penulis</label>
            <input type="text" class="form-control" id="author" name="author" required>
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Tahun Terbit</label>
            <input type="number" class="form-control" id="year" name="year" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stok Awal</label>
            <input type="number" class="form-control" id="stock" name="stock" value="0" required>
        </div>

        <div class="mb-3">
            <a href="index.php?page=manage-books" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

<?php require 'views/partials/footer.php'; ?> 