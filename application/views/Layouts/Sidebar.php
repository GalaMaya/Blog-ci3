<?php
  $role = $this->session->userdata('user')['role'];
?>


<div class="sidebar">
  <h2>Dashboard</h2>
  <ul>
    <li><a href="<?= base_url('dashboard'); ?>">Home</a></li>
    <li><a href="<?= base_url('dashboard/article'); ?>">Article</a></li>
    <?php
            if (in_array($role, ['1'])) {
               echo '<li><a href="' . base_url('dashboard/user') . '">User</a></li>';
            }
    ?>
   
    <li><a href="<?= base_url('logout'); ?>">Logout</a></li>
  </ul>
</div>
