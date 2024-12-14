<?php require 'views/partials/header.php'; ?>

<div class="container mt-4">
    <h2>Dashboard Member</h2>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Peminjaman buku berhasil!</div>
    <?php endif; ?>

    <?php if (isset($_GET['fine'])): ?>
        <div class="alert alert-info">
            Buku berhasil dikembalikan. 
            <?php if ($_GET['fine'] > 0): ?>
                Denda keterlambatan: Rp <?= number_format($_GET['fine'], 0, ',', '.') ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <h3 class="mt-4">Buku yang Sedang Dipinjam</h3>
    <?php if (empty($activeLoans)): ?>
        <p>Tidak ada buku yang sedang dipinjam.</p>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Jatuh Tempo</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($activeLoans as $loan): ?>
                        <?php $book = Book::findById($loan->book_id); ?>
                        <tr>
                            <td><?= $book->getTittle() ?></td>
                            <td><?= date('d/m/Y', strtotime($loan->borrowed_at)) ?></td>
                            <td><?= date('d/m/Y', strtotime($loan->due_date)) ?></td>
                            <td>
                                <form method="POST" action="index.php?page=return-book">
                                    <input type="hidden" name="loan_id" value="<?= $loan->getId() ?>">
                                    <button type="submit" class="btn btn-sm btn-primary">Kembalikan</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require 'views/partials/footer.php'; ?> 