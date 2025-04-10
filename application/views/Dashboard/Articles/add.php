<?php $this->load->view('Layouts/sidebar'); ?>
<div class="main-content">
    <?php $this->load->view('Layouts/header'); ?>

    <div class="content">
        <h2>Tambah Artikel</h2>

        <div class="form-card">
            <?php if($this->session->flashdata('error')): ?>
                <div class="error"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>
            <form action="<?= base_url('dashboard/article/save'); ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="content">Konten</label>
                    <textarea id="content" name="content" rows="5" style="width: 100%; padding: 2px" required></textarea>
                </div>

                <div class="form-group">
                    <label for="banner">Banner (Gambar, max 500KB)</label>
                    <input type="file" id="banner" name="banner" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="attachment">Lampiran (PDF, max 1MB)</label>
                    <input type="file" id="attachment" name="attachment" accept="application/pdf">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save">Tambah</button>
                    <a href="<?= base_url('dashboard/article'); ?>" class="btn-back">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
