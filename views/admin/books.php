<?php require 'views/partials/header.php'; ?>

<div class="container mt-4">
    <h2>Manajemen Buku</h2>

    <?php if (isset($_GET['success'])): ?>
        <?php if ($_GET['success'] == 1): ?>
            <div class="alert alert-success">Buku baru berhasil ditambahkan!</div>
        <?php elseif ($_GET['success'] == 2): ?>
            <div class="alert alert-success">Stok buku berhasil diperbarui!</div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="mb-3">
        <a href="index.php?page=add-book" class="btn btn-primary">Tambah Buku Baru</a>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?= htmlspecialchars($book->getTittle()) ?></td>
                        <td><?= htmlspecialchars($book->getAuthor()) ?></td>
                        <td><?= $book->getYear() ?></td>
                        <td><?= $book->getStock() ?></td>
                        <td>
                            <button type="button" 
                                    class="btn btn-sm btn-primary" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#stockModal<?= $book->getId() ?>">
                                Update Stok
                            </button>
                        </td>
                    </tr>

                    <!-- Modal untuk update stok -->
                    <div class="modal fade" id="stockModal<?= $book->getId() ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update Stok: <?= htmlspecialchars($book->getTittle()) ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form method="POST" action="index.php?page=update-stock">
                                    <div class="modal-body">
                                        <input type="hidden" name="book_id" value="<?= $book->getId() ?>">
                                        <div class="mb-3">
                                            <label class="form-label">Tambah/Kurangi Stok</label>
                                            <input type="number" class="form-control" name="amount" required>
                                            <small class="form-text text-muted">
                                                Gunakan angka positif untuk menambah stok, negatif untuk mengurangi
                                            </small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require 'views/partials/footer.php'; ?> 