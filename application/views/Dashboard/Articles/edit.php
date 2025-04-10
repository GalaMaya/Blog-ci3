<?php $this->load->view('Layouts/sidebar'); ?>
<?php $data = (object) $article; // convert array to object ?>
<div class="main-content">
    <?php $this->load->view('Layouts/header'); ?>

    <div class="content">
        <h2>Edit Artikel</h2>

        <div class="form-card">
            <?php if($this->session->flashdata('error')): ?>
                <div class="error"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('dashboard/article/update/' . $data->id); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data->id ?>">
                
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" id="title" name="title" value="<?= set_value('title', $data->title); ?>" required>
                </div>

                <div class="form-group">
                    <label for="content">Konten</label>
                    <textarea id="content" name="content" rows="5" style="width: 100%; padding: 2px" required><?= set_value('content', $data->content); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="banner">Banner (Gambar, max 500KB)</label>
                    <input type="file" id="banner" name="banner" accept="image/*">
                    <?php if (!empty($data->banner)): ?>
                        <div style="margin-top: 5px;">
                            <small>File lama:</small><br>
                            <img src="<?= base_url('uploads/banner/' . $data->banner); ?>" alt="Banner" style="max-width: 200px;">
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="attachment">Lampiran (PDF, max 1MB)</label>
                    <input type="file" id="attachment" name="attachment" accept="application/pdf">
                    <?php if (!empty($data->attachment)): ?>
                        <div style="margin-top: 5px;">
                            <small>File lama:</small><br>
                            <a href="<?= base_url('uploads/attachment/' . $data->attachment); ?>" target="_blank"><?= $data->attachment ?></a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                    <a href="<?= base_url('dashboard/article'); ?>" class="btn-back">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
