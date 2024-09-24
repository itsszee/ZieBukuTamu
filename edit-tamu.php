<?php
include_once('templates/header.php');
require_once('function.php');
?>

<div class="container-fluid">

    <!-- page heading -->
    <h1 class="h3 mb-4 text-gray-800">Ubah Data Tamu</h1>

    <?php
    if (isset($_POST['simpan'])) {
        if (ubah_tamu($_POST) > 0){

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

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    
        $data = query("SELECT * FROM bukutamu WHERE id_tamu = '$id'")[0];
    }  
    ?>

    <!-- konten edit data tamu -->
    <div class="card shadow mb4">
        <div class="card-header py-3">
            <h6>Data Tamu</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <input type="hidden" id="id_tamu" name="id_tamu" value="<?= $id ?>">
                <div class="form-group row">
                    <label for="nama_tamu" class="col-sm-3 col-form-label">Nama Tamu</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama_tamu" name="nama_tamu" value="<?= $data['nama_tamu'] ?>"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $data['alamat'] ?>"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_hp" class="col-sm-3 col-form-label">No. Telepon</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $data['no_hp'] ?>"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="bertemu" class="col-sm-3 col-form-label">Bertemu dg. </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="bertemu" name="bertemu" value="<?= $data['bertemu'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kepentingan" class="col-sm-3 col-form-label">Kepentingan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="kepentingan" name="kepentingan" value="<?= $data['kepentingan'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-8 d-flex justify-content-end">
                        <div>
                            <a href="buku-tamu.php" type="button" class="btn btn-danger btn-icon-split">
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