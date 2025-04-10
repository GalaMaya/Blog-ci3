<?php $this->load->view('Layouts/sidebar'); ?>
<div class="main-content">
    <?php $this->load->view('Layouts/header'); ?>

    <div class="content">
        <h2>Tambah User</h2>

      

        <div class="form-card">
            <?php if($this->session->flashdata('error')): ?>
                <div class="error"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>
            <form action="<?= base_url('dashboard/user/save'); ?>" method="POST">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" minlength="8" required>
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" required>
                        <option value="1">Admin</option>
                        <option value="2">Editor</option>
                        <option value="3">User</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save">Tambah</button>
                    <a href="<?= base_url('dashboard/user'); ?>" class="btn-back">Kembali</a>
                </div>
            </form>
        </div>

    </div>
</div>

</body>

</html>