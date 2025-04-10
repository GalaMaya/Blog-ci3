<?php
$user = $this->session->userdata('user');
?>

<?php $this->load->view('Layouts/sidebar'); ?>
<div class="main-content">
    <?php $this->load->view('Layouts/header'); ?>

    <div class="content">
        <h2>List Users</h2>
        <a href="<?= base_url('dashboard/user/add'); ?>" class="btn-add" >+ Tambah User</a>

        <div class="card user-table">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['name']; ?></td>
                            <td><?= $user['email']; ?></td>
                            <td>
                                <?php
                                if ($user['role_id'] == '1') {
                                    echo '<span class="badge badge-admin">Admin</span>';
                                } elseif ($user['role_id'] == '2') {
                                    echo '<span class="badge badge-editor">Editor</span>';
                                } else {
                                    echo '<span class="badge badge-user">User</span>';
                                }
                                ?>
                            </td>

                            <td>
                                <a href="<?= base_url('dashboard/user/edit/' . $user['id']); ?>" class="btn-edit">Edit</a>
                                <a href="<?= base_url('dashboard/user/delete/' . $user['id']); ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>

</html>