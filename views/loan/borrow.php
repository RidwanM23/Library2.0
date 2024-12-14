<?php require 'views/partials/header.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Konfirmasi Peminjaman Buku</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($this->error)): ?>
                        <div class="alert alert-danger"><?= $this->error ?></div>
                    <?php endif; ?>

                    <?php if ($book): ?>
                        <div class="mb-4">
                            <h5>Detail Buku:</h5>
                            <table class="table">
                                <tr>
                                    <th width="150">Judul</th>
                                    <td><?= $book->tittle ?></td>
                                </tr>
                                <tr>
                                    <th>Penulis</th>
                                    <td><?= $book->author ?></td>
                                </tr>
                                <tr>
                                    <th>Tahun</th>
                                    <td><?= $book->year ?></td>
                                </tr>
                            </table>
                        </div>

                        <div class="mb-4">
                            <h5>Informasi Peminjaman:</h5>
                            <p>Durasi Peminjaman: 7 hari</p>
                            <p>Tanggal Kembali: <?= date('d/m/Y', strtotime('+7 days')) ?></p>
                            <p class="text-danger">* Keterlambatan pengembalian akan dikenakan denda Rp 1.000/hari</p>
                        </div>

                        <form method="POST" action="index.php?page=borrow-book">
                            <input type="hidden" name="book_id" value="<?= $book->id ?>">
                            <div class="d-flex justify-content-between">
                                <a href="/book" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Konfirmasi Peminjaman</button>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-danger">
                            Buku tidak ditemukan.
                            <a href="/book" class="alert-link">Kembali ke daftar buku</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/partials/footer.php'; ?> 