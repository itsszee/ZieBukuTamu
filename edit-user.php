<?php
include_once('templates/header.php');
require_once('function.php');
?>

<?php

if (isset($_GET['id'])) {
    $id_user = $_GET['id'];

    // ambil data tamu yang sesuai dengan id
    $data = query("SELECT * FROM users WHERE id_user = '$id_user'")[0];
}
?>

<div class="container-fluid">
    <!-- page heading -->
    <h1 class="h3 mb-4 text-gray-800">Ubah Data user</h1>

    <?php
    if (isset($_POST['simpan'])) {
        if (ubah_user($_POST) > 0) {

    ?>
            <div class="alert alert-success" role="alert">
                Data Berhasil diubah!
            </div>
        <?php
        } else {
        ?>
            <div class="alert alert-danger" role="alert">
                Data gagal diubah!
            </div>
    <?php
        }
    }

 
    ?>

    <!-- konten edit data user -->
    <div class="card shadow mb4">
        <div class="card-header py-3">
            <h6>Data user</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <input type="hidden" id="id_user" name="id_user" value="<?= $id_user ?>">
                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="username" name="username" value="<?= $data['username'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="user_role" class="col-sm-3 col-form-label">User Role</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="user_role" id="user_role">
                            <option value="Admin"<?= $data['user_role'] == 'Admin' ? 'selected' : ''; ?>>Administrator</option>
                            <option value="Operator"<?= $data['user_role'] == 'Operator' ? 'selected' : ''; ?>>Operator</option>
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-8 d-flex justify-content-end">
                        <div>
                            <a href="users.php" type="button" class="btn btn-danger btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                                <span class="text">Back</span>
                            </a>
                            <button class="btn btn-primary" name="simpan" type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->



<?php
include_once('templates/footer.php');
?>