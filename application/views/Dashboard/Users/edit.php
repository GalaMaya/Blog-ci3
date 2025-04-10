<?php $this->load->view('Layouts/sidebar'); ?>
<div class="main-content">
    <?php $this->load->view('Layouts/header'); ?>

    <div class="content">
        <h2>Edit User</h2>

      

        <div class="form-card">
            <?php if($this->session->flashdata('error')): ?>
                <div class="error"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>
            <form action="<?= base_url('dashboard/user/update/'. $user['id']); ?>" method="POST">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" disabled>
                </div>


                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" required>
                    <option value="1" <?= $user['role_id'] == 1 ? 'selected' : '' ?>>Admin</option>
                    <option value="2" <?= $user['role_id'] == 2 ? 'selected' : '' ?>>Editor</option>
                    <option value="3" <?= $user['role_id'] == 3 ? 'selected' : '' ?>>User</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save">Update</button>
                    <a href="<?= base_url('dashboard/user'); ?>" class="btn-back">Kembali</a>
                </div>
            </form>
        </div>

    </div>
</div>

</body>

</html>