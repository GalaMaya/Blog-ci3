<?php
$user = $this->session->userdata('user');
$role = $this->session->userdata('user')['role'];
?>

<?php $this->load->view('Layouts/sidebar'); ?>
<div class="main-content">
    <?php $this->load->view('Layouts/header'); ?>

    <div class="content">
        <h2>List Article</h2>

        <?php
           

            if (in_array($role, ['1'])) {
               echo '<a href="' . base_url('dashboard/article/add') . '" class="btn-add">Add Article</a>';
            } elseif (in_array($role, ['2'])) {
                echo '<a href="' . base_url('dashboard/article/add') . '" class="btn-add">Add Article</a>';
            }
        ?>
        

        <div class="card user-table">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <?php
                                    if (in_array($role, ['1'])) {
                                       echo '<th>Action</th>';
                                    } elseif (in_array($role, ['2'])) {
                                        echo '<th>Action</th>';
                                    } 
                        ?>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <td><?= $article['title']; ?></td>
                            <td><?= $article['author']; ?></td>

                            <td>
                                <?php
                                    if (in_array($role, ['1'])) {
                                       echo '<a href="' . base_url('dashboard/article/edit/' . $article['id']) . '" class="btn-edit">Edit</a>';
                                    } elseif (in_array($role, ['2'])) {
                                        echo '<a href="' . base_url('dashboard/article/edit/' . $article['id']) . '" class="btn-edit">Edit</a>';
                                    } 
                                ?>
                                

                                <?php
                                    if (in_array($role, ['1'])) {
                                       echo '<a href="' . base_url('dashboard/article/delete/' . $article['id']) . '" class="btn-delete">Delete</a>';
                                    } 
                                ?>
                                
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