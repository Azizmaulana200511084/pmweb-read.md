<?php
include('koneksi.php');
$db = new database();
$data_steam = $db->tampil_steam();
$koneksi = new database();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Aziz Maulana</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-md bg-red navbar-dark" style="background-color: red;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" style="background-color: yellow;" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" style="color: black;" href="steam.php">Steam</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: black;" href="kendaraan.php">Kendaraan</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="col-12 mt-3">
        <div class="card" style="background-color: yellow;">
            <div class="card-body">
                <?php
                if (isset($_GET['pesan'])) {
                    $munculpesan = $_GET['pesan'];
                    echo "<div class='alert alert-success'> $munculpesan </div>";
                }
                if (isset($_GET['pesen'])) {
                    $munculpesan = $_GET['pesen'];
                    echo "<div class='alert alert-alert'> $munculpesan </div>";
                }
                ?>

                <div>

                </div>
            </div>
            <div class="single-table">

                <div class="table-responsive">
                    <table>
                        <div>
                            <h1 style="text-align: center;">
                                STEAM
                            </h1>
                        </div>
                    </table>
                    <table>
                        <td style="width: 100%;"><input class="form-control" id="myInput" type="text" placeholder="Pencarian"></td>
                    </table>
                    <table class="table table-hover progress-table text-center" id="dtable">
                        <thead class="text-uppercase">
                            <tr style="background-color: red;">
                                <th style="color: white;">No</th>
                                <th style="color: white;">Nama steam</th>
                                <th style="color: white;">ID Kendaraan</th>
                                <th style="color: white;">Tekanan UAP</th>
                                <th style="color: white;">Kapasitas UAP</th>
                                <th style="color: white;">Tanggal Pemeriksaan</th>
                                <th style="color: white;">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                            Tambah Steam
                                        </button>
                                    </div>
                                </th>
                            </tr>
                        </thead>

                        <tbody id="myTable">
                            <?php
                            $no = 1;
                            foreach ($data_steam as $row) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['nama_steam']; ?></td>
                                    <td><?php echo $row['id_kendaraan']; ?></td>
                                    <td><?php echo $row['tekanan_uap']; ?></td>
                                    <td><?php echo $row['kapasitas_uap']; ?></td>
                                    <td><?php echo $row['tanggal_pemeriksaan']; ?></td>

                                    <td>
                                        <a href="" class="text-secondary" data-toggle="modal" data-target="#myModalEdit<?php echo $row['id']; ?>">
                                            <p class="fa fa-edit" style="font-size:25px"></p>
                                        </a>
                                        <a href="" class="text-danger" data-toggle="modal" data-target="#myModalHapus<?php echo $row['id']; ?>">
                                            <p class="fa fa-trash" style="font-size:24px"></p>
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal" id="myModalEdit<?php echo $row['id']; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Data steam</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <form method="POST" action="steam.php">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">

                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Steam</label>
                                                            <input type="text" class="form-control" name="nama_steam" value="<?php echo $row['nama_steam']; ?>" placeholder="Masukkan Nama steam">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">ID Kendaraan</label>
                                                            <select class="form-control" name="id_kendaraan">
                                                                <option value="">Tolong Pilih Kendaraan</option>
                                                                <?php
                                                                $selec = $row['id_kendaraan'];
                                                                $result_cat = $koneksi->tampil_kendaraan();
                                                                foreach ($result_cat as $result) :
                                                                    $selected = ($result['id_kendaraan'] == $selec) ? 'selected' : ''; ?>
                                                                    <option value="<?php echo $result['id_kendaraan']; ?>" <?php echo $selected; ?>>
                                                                        <?php echo $result['nama_kendaraan']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Tekanan UAP</label>
                                                            <input type="text" class="form-control" name="tekanan_uap" value="<?php echo $row['tekanan_uap']; ?>" placeholder="Masukkan Tahun Terbit">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Kapasitas UAP</label>
                                                            <input type="text" class="form-control" name="kapasitas_uap" value="<?php echo $row['kapasitas_uap']; ?>" placeholder="Masukkan Nama Penulis ">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Tanggal Pemeriksaan</label>
                                                            <input type="text" class="form-control" name="tanggal_pemeriksaan" value="<?php echo $row['tanggal_pemeriksaan']; ?>" placeholder="Masukkan Nama Penerbit ">
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-success" name="update">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade " id="myModalHapus<?php echo $row['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Menghapus Data</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="steam.php">
                                                <input type="hidden" name="id" value="<?= $row['id'] ?>">

                                                <div class="modal-body">

                                                    <h5 class="text-center">Apakah anda ingin menghapus data ini ?
                                                        <br><span class="text-danger"><?= $row['nama_steam'] ?></span>
                                                    </h5>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Input Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="steam.php" method="POST">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Nama steam</label>
                            <input type="text" class="form-control" name="nama_steam" placeholder="Masukkan Nama steam">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ID Kendaraan</label>
                            <select class="form-control" name="id_kendaraan">
                                <option value="">Tolong Pilih Kendaraan</option>
                                <?php
                                $selec = $row['id_kendaraan'];
                                $result_cat = $koneksi->tampil_kendaraan();
                                foreach ($result_cat as $result) :
                                    $selected = ($result['id_kendaraan'] == $selec) ? 'selected' : '';
                                ?>
                                    <option value="<?php echo $result['id_kendaraan']; ?>" <?php echo $selected; ?>>
                                        <?php echo $result['nama_kendaraan']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tekanan UAP</label>
                            <input type="text" class="form-control" name="tekanan_uap" placeholder="Masukkan tekanan uapk">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kapasitas UAP</label>
                            <input type="text" class="form-control" name="kapasitas_uap" placeholder="Masukkan Kapasitas uap ">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Pemeriksaan</label>
                            <input type="text" class="form-control" name="tanggal_pemeriksaan" placeholder="Input Tanggal Pemeriksaan">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <?php

    if (isset($_POST['simpan'])) {

        $hasil = $koneksi->tambah_steam($_POST['nama_steam'], $_POST['id_kendaraan'], $_POST['tekanan_uap'], $_POST['kapasitas_uap'], $_POST['tanggal_pemeriksaan']);
        if ($hasil) {
            echo "<script>window.location.href='steam.php';</script>";
        } else {
            echo "<script>window.location.href='steam.php';</script>";
        }
    }

    if (isset($_POST['update'])) {

        $hasil = $koneksi->update_steam($_POST['nama_steam'], $_POST['id_kendaraan'], $_POST['tekanan_uap'], $_POST['kapasitas_uap'], $_POST['tanggal_pemeriksaan'], $_POST['id']);
        if ($hasil) {
            echo "<script>window.location.href='steam.php';</script>";
        } else {
            echo "<script>window.location.href='steam.php';</script>";
        }
    }

    if (isset($_POST['hapus'])) {
        $hapus = $koneksi->delete_steam($_POST['id']);
        if ($hapus) {
            echo "<script>window.location.href='steam.php';</script>";
        } else {
            echo "<script>window.location.href='steam.php';</script>";
        }
    }
    ?>

    <footer class="fixed-bottom" style="position: fixed;height: 30px;bottom: 0;width: 100%; background-color: red;">

        <p style="color: white; text-align: center;">Aziz Maulana</p>
    </footer>

    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>

</html>