<?php
include('koneksi.php');
$db = new database();
$data_kendaraan = $db->tampil_kendaraan();
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
                                DATA KENDARAAN
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
                                <th style="color: white;">Nama Kendaraan</th>
                                <th style="color: white;">Jenis Kendaraan</th>
                                <th style="color: white;">Tahun Pembuatan</th>
                                <th style="color: white;">Nomor Plat</th>
                                <th style="color: white;">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                            Tambah Kendaraan
                                        </button>
                                    </div>
                                </th>
                            </tr>
                        </thead>

                        <tbody id="myTable">
                            <?php
                            $no = 1;
                            foreach ($data_kendaraan as $row) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row["nama_kendaraan"]; ?></td>
                                    <td><?php echo $row["jenis_kendaraan"]; ?></td>
                                    <td><?php echo $row["tahun_pembuatan"]; ?></td>
                                    <td><?php echo $row["nomor_plat"]; ?></td>
                                    <td>
                                        <a href="" class="text-secondary" data-toggle="modal" data-target="#myModalEdit<?php echo $row['id_kendaraan']; ?>">
                                            <p class="fa fa-edit" style="font-size:25px"></p>
                                        </a>
                                        <a href="" class="text-danger" data-toggle="modal" data-target="#myModalHapus<?php echo $row['id_kendaraan']; ?>">
                                            <p class="fa fa-trash" style="font-size:24px"></p>
                                        </a>
                                    </td>
                                </tr>

                                <div class="modal" id="myModalEdit<?php echo $row['id_kendaraan']; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Data Kendaraan</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <form method="POST" action="kendaraan.php">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_kendaraan" value="<?php echo $row['id_kendaraan']; ?>">

                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Kendaraan</label>
                                                        <input type="text" class="form-control" name="nama_kendaraan" value="<?= $row['nama_kendaraan'] ?>" placeholder="Input Nama Kendaraan" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Jenis Kendaraan</label>
                                                        <input type="text" class="form-control" name="jenis_kendaraan" value="<?= $row['jenis_kendaraan'] ?>" placeholder="Input Jenis Kendaraan" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Tahun Pembuatan</label>
                                                        <input type="text" class="form-control" name="tahun_pembuatan" value="<?= $row['tahun_pembuatan'] ?>" placeholder="Input Tahun Pembuatan" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Nomor Plat</label>
                                                        <input type="text" class="form-control" name="nomor_plat" value="<?= $row['nomor_plat'] ?>" placeholder="Input Nomor Plat" required>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
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
                            <?php } ?>
                        </tbody>
                    </table>
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
                <form action="kendaraan.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Kendaraan</label>
                            <input type="text" class="form-control" name="nama_kendaraan" placeholder="Input Nama Kendaraan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kendaraan</label>
                            <input type="text" class="form-control" name="jenis_kendaraan" value="<?= $row['jenis_kendaraan'] ?>" placeholder="Input Jenis Kendaraan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tahun Pembuatan</label>
                            <input type="text" class="form-control" name="tahun_pembuatan" value="<?= $row['tahun_pembuatan'] ?>" placeholder="Input Tahun Pembuatan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor Plat</label>
                            <input type="text" class="form-control" name="nomor_plat" value="<?= $row['nomor_plat'] ?>" placeholder="Input Nomor Plat" required>
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

    <div class="modal fade " id="myModalHapus<?php echo $row['id_kendaraan']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Menghapus Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="kendaraan.php">
                    <input type="hidden" name="id_kendaraan" value="<?= $row['id_kendaraan'] ?>">

                    <div class="modal-body">

                        <h5 class="text-center">Apakah anda ingin menghapus data ini ?
                            <br><span class="text-danger"><?= $row['nama_kendaraan'] ?></span>
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
    <?php

    if (isset($_POST['simpan'])) {
        $hasil = $koneksi->tambah_kendaraan($_POST['nama_kendaraan'], $_POST['jenis_kendaraan'], $_POST['tahun_pembuatan'], $_POST['nomor_plat']);
        if ($hasil) {
            echo "<script>window.location.href='kendaraan.php';</script>";
        } else {
            echo "<script>window.location.href='kendaraan.php';</script>";
        }
    }

    if (isset($_POST['update'])) {
        $koneksi->update_kendaraan($_POST['nama_kendaraan'], $_POST['jenis_kendaraan'], $_POST['tahun_pembuatan'], $_POST['nomor_plat'], $_POST['id_kendaraan']);
        if ($hasil) {
            echo "<script>window.location.href='kendaraan.php';</script>";
        } else {
            echo "<script>window.location.href='kendaraan.php';</script>";
        }
    }

    if (isset($_POST['hapus'])) {
        $hapus = $koneksi->delete_kendaraan($_POST['id_kendaraan']);
        if ($hapus) {
            echo "<script>window.location.href='kendaraan.php';</script>";
        } else {
            echo "<script>window.location.href='kendaraan.php';</script>";
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