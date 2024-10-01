<?php
include_once('templates/header.php');
?>

<?php
require_once('function.php');
include_once('templates/header.php');
?>

<!-- Custom styles for this page -->
<link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Users</h1>

    <?php

    if (isset($_POST['simpan'])) {
        if (tambah_user($_POST) > 0) {
    ?>
            <div class="alert alert-success" role="alert">
                Data Berhasil disimpan!
            </div>
        <?php
        } else {
        ?>
            <div class="alert alert-danger" role="alert">
                Data gagal disimpan!
            </div>
    <?php
        }
    } else if (isset($_POST['ganti_password'])) {
        if (ganti_password($_POST) > 0 ) {
        ?>
            <div class="alert alert-success" role="alert">
                Password berhasil diubah!
            </div>
        <?php
        } else {
        ?>
            <div class="alert alert-danger">
                Password gagal diubah!
            </div>
    <?php    
        }
    }
    ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary btn-icon-split"
                data-toggle="modal" data-target="#tambahModal">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Data User</span>
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>User Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        //penomoran auto-increment
                        $no = 1;
                        // query untuk memanggil semua data daru tabel buku_user
                        $users = query("SELECT * FROM users");
                        foreach ($users as $user) : ?>

                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $user['username'] ?></td>
                                <td><?= $user['user_role'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-info btn-icon-split" data-toggle="modal" 
                                    data-target="#gantiPassword" data-id="<?= $user['id_user'] ?>">
                                        <span class="text">Change Password</span>

                                    </button>
                                    <a class="btn btn-success" href="edit-user.php?id=<?= $user['id_user'] ?>">Change</a>
                                    <a onclick="confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger" 
                                    href="hapus-user.php?id=<?= $user['id_user'] ?>">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php
$query = mysqli_query($koneksi, "SELECT max(id_user) as kodeTerbesar From users");
$data = mysqli_fetch_array($query);
$kodeuser = $data['kodeTerbesar'];

$urutan = (int) substr($kodeuser, 3, 2);
$urutan++;

$huruf = "usr";
$kodeuser = $huruf . sprintf("%02s", $urutan)
?>



<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Add Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <input type="hidden" name="id_user" id="id_user" value="<?= $kodeuser ?>">
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="username" id="username">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="password" id="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="user_role" class="col-sm-3 col-form-label">User Role</label>
                        <div class="col-sm-8">
                            <select name="user_role" id="user_role" class="form-control">
                                <option value="admin">Administrator</option>
                                <option value="operator">Operator</option>
                            </select>
                        </div>
                    </div>
                    
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="simpan">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="gantiPassword" tabindex="-1" aria-labelledby="gantiPasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gantiPasswordLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <input type="hidden" name="id_user" id="id_user"">
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">New Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="ganti_password">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php
include_once('templates/footer.php');
?>