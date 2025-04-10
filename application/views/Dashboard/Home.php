<?php
$user = $this->session->userdata('user');
?>

<?php $this->load->view('Layouts/sidebar'); ?>
<div class="main-content">
  <?php $this->load->view('Layouts/header'); ?>
  <div class="card user-details">
    <h3>Detail Akun</h3>


    <div class="detail-item">
      <span class="label">Nama:</span>
      <span class="value"><?= $user['name']; ?></span>
    </div>

    <div class="detail-item">
      <span class="label">Email:</span>
      <span class="value"><?= $user['email']; ?></span>
    </div>

    <div class="detail-item">
      <span class="label">Role:</span>
      <span class="value">
        <?php
          if ($user['role'] == '1') {
            echo '<span class="badge badge-admin">Admin</span>';
          } elseif ($user['role'] == '2') {
            echo '<span class="badge badge-editor">Editor</span>';
          } else {
            echo '<span class="badge badge-user">User</span>';
          }
        ?>
      </span>
    </div>
  </div>
</div>
</body>

</html>