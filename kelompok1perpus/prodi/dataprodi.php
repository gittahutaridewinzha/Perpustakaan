<style>
    .custom-card {
        max-width: 1700px;
        margin: 10px;
        /* Menambahkan margin di bagian atas dan bawah */
        border-radius: 10px;
        /* Menambahkan efek lengkungan pada ujung-ujung kartu */
        overflow: hidden;
        /* Memastikan konten di dalam kartu tidak keluar dari efek lengkungan */
    }

    .table-responsive {
        overflow-x: auto;
        max-width: 100%;
    }

    #example {
        font-size: 14px;
        /* Sesuaikan dengan ukuran font yang diinginkan */
    }

    .list-card {
        background-color: #ffffff;
    }

    .card.custom-card {
        background-color: #ffffff;
    }

    .form-column {
        background-color: #eeebe3;
    }

    #main-content {
        margin-top: 120px;
        /* Sesuaikan dengan tinggi navbar Anda */
        padding: 20px;
        /* Sesuaikan sesuai kebutuhan Anda */
    }

    /* Ganti warna background dan warna teks sesuai kebutuhan Anda */
    .dataTables_wrapper .dataTables_length {
        float: left;
        margin-bottom: 10px;
    }

    /* Ganti warna background dan warna teks sesuai kebutuhan Anda */
    .dataTables_wrapper .dataTables_filter {
        float: right;
        margin-bottom: 10px;
    }

    /* Ganti warna background dan warna teks untuk tabel */
    #example {
        background-color: #fff;
        color: #333;
    }

    /* Ganti warna background untuk baris ganjil */
    #example tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    /* Ganti warna background untuk baris genap */
    #example tbody tr:nth-of-type(even) {
        background-color: #e5e5e5;
    }

    /* Ganti warna teks dan rata kanan kolom dengan angka */
    #example th,
    #example td {
        text-align: center;
    }

    /* Ganti warna tombol paging */
    #example_paginate .paginate_button {
        background-color: #007bff;
        color: #fff;
    }

    /* Ganti warna tombol paging saat dihover */
    #example_paginate .paginate_button:hover {
        background-color: #0056b3;
    }

    /* Ganti warna halaman yang aktif */
    #example_paginate .paginate_button.current {
        background-color: #0056b3;
    }

    /* Ganti warna border pada hover */
    #example tbody tr:hover {
        background-color: #d0e9c6;
    }

    /* Ganti warna header kolom saat dihover */
    #example thead tr:hover th {
        background-color: #007bff;
        color: #fff;
    }
</style>

<?php

include 'koneksi.php';
?>

<!-- MAIN CONTENT prodi-->

<div class="p-4 active-main-content" id="main-content">
    <!-- ! Form dan card list prodi -->
    <div class="row">
        <div class="col-sm-12 text-center">
            <div class="card custom-card">
                <div class="card-header">
                    <h4>DATA PRODI</h4>
                </div>
                <!-- Tombol "Tambah Prodi" -->
                <button type="button" class="btn btn-primary button-custom float-left" style="width: 150px; margin-right: 10px; margin-bottom: 5px; margin-top: 15px; margin-left:10px;" data-bs-toggle="modal" data-bs-target="#modalTambahProdi">
                    Tambah Prodi
                </button>
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">no</th>
                                <th scope="col">nama prodi</th>
                                <th scope="col">keterangan</th>
                                <th scope="col">aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // $query = "SELECT * FROM prodi";
                            // $result = $db->query($query);
                            // $nomor = 1;
                            // foreach ($result as $row) :
                            $nomor = 1;
                            $query = mysqli_query($db, "SELECT * FROM prodi");
                            while ($row = mysqli_fetch_array($query)) : ?>
                                <tr>
                                    <td><?= $nomor++ ?></td>
                                    <td><?= $row['nama_prodi'] ?></td>
                                    <td><?= $row['keterangan'] ?></td>
                                    <td>
                                        <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditProdi<?= $nomor ?>">Edit</a>
                                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapusProdi<?= $nomor ?>">Hapus</a>
                                    </td>

                                </tr>

                                <!--Awal Modal "Edit Prodi" -->
                                <div class="modal fade" id="modalEditProdi<?= $nomor ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Prodi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <!-- Form tambah user -->
                                            <form action="http://localhost/kelompok1perpus/prodi/proses-prodi.php" method="post">
                                                <input type="hidden" name="id_prodi" value="<?= $row['id_prodi'] ?>">

                                                <div class="modal-body">
                                                    <div class="mb-3 row">
                                                        <label for="nama_prodi" class="col-sm-3 col-form-label" style="margin-right: 5px;">Nama Prodi</label>
                                                        <div class="col-sm-5">
                                                            <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" value="<?= $row['nama_prodi'] ?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <label for="keterangan" class="col-sm-3 col-form-label" style="margin-right:5px;">Keterangan</label>
                                                        <div class="col-sm-5">
                                                            <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $row['keterangan'] ?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary" name="ubahProdi">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Modal Edit Prodi -->

                                <!--Awal Modal "Hapus Prodi" -->
                                <div class="modal fade" id="modalHapusProdi<?= $nomor ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Hapus Prodi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <!-- Form hapus prodi -->
                                            <form action="http://localhost/kelompok1perpus/prodi/proses-prodi.php" method="post">
                                                <input type="hidden" name="id_prodi" value="<?= $row['id_prodi'] ?>">

                                                <div class="modal-body">
                                                    <h5 class="text-center">Apakah yakin menghapus data ini?</h5> <br>
                                                    <span class="text-danger text-center"><?= $row['id_prodi'] ?> - <?= $row['nama_prodi'] ?></span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" name="hapusProdi">Ya</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Modal Hapus Prodi -->
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--AWal Modal "Tambah Prodi" -->
<div class="modal fade" id="modalTambahProdi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Prodi</h5>

            </div>
            <!-- Form tambah user -->
            <form action="http://localhost/kelompok1perpus/prodi/proses-prodi.php" method="post">
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="nama_prodi" class="col-sm-3 col-form-label" style="margin-right:5px;">Nama Prodi</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="keterangan" class="col-sm-3 col-form-label" style="margin-right: 5px;">Keterangan</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="simpanProdi">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir Modal Tambah Prodi -->














<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-rvBdIUPlu9I3GGGXYldFKlc/Z9fNfEXnV+fmRkSr47eADnJmGJX5CIO9M0DA9S3X" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>