<?php
$number = 1;
if (!defined('SECURE_ACCESS')) {
    die('Direct access not permitted');
}

include('templates/header.php') ?>

<div class="main-content bg-white">
    <section class="container my-5">
        <h3 class="panel-title text-center">Search Book LIBRARY</h3>
        <form class="d-flex justify-content-between align-items-center">
            <input
                type="text"
                class="form-control"
                placeholder="Cari Buku"
                name="search"
                required />
            <button class="btn btn-sm btn-primary mx-3">Search</button>
        </form>
        <div class="table table-responsive my-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Years</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $book) : ?>
                        <tr>
                            <td><?= $number++ ?></td>
                            <td><?= $book->tittle ?></td>
                            <td><?= $book->author ?></td>
                            <td><?= $book->year ?></td>
                            <td>
                                <a href="index.php?page=borrow-book&book_id=<?= $book->id ?>" 
                                   class="btn btn-primary">Pinjam Buku</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mb-0">
            <div class="my-4">
                <a href="/">Back to Home</a>
            </div>
        </div>
        <div class="footer mb-0">
            <p>Copyright© <script>
                    document.write(new Date().getFullYear())
                </script> All Rights Reserved By <span class="text-primary">LIBRARY</span></p>
        </div>
    </section>
</div>

<?php include('templates/footer.php') ?>