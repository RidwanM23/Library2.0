<?php require 'views/partials/header.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Registrasi Member Perpustakaan</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($this->error)): ?>
                        <div class="alert alert-danger"><?= $this->error ?></div>
                    <?php endif; ?>

                    <form method="POST" action="index.php?page=member-register">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" 
                                   value="<?= $_POST['username'] ?? '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Minimal 6 karakter" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Daftar Member</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/partials/footer.php'; ?> 