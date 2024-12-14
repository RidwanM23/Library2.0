<?php require 'views/partials/header.php'; ?>

<div class="container mt-4">
    <h2>Registrasi Member Perpustakaan</h2>
    
    <?php if (isset($this->error)): ?>
        <div class="alert alert-danger"><?= $this->error ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?page=member-register">
        <div class="mb-3">
            <label for="nik" class="form-label">NIK</label>
            <input type="text" class="form-control" id="nik" name="nik" required>
        </div>

        <div class="mb-3">
            <label for="full_name" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="full_name" name="full_name" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea class="form-control" id="address" name="address" required></textarea>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">No. Telepon</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>

        <button type="submit" class="btn btn-primary">Daftar</button>
    </form>
</div>

<?php require 'views/partials/footer.php'; ?> 