<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-wvfXpqpZZVQl3u03N7mR6J04lO39jccz5l5fNs4Z9HAZJ7eZbOWF6wY1X6cZ56d5" crossorigin="anonymous">

<!-- Feather Icons -->
<link rel="stylesheet" href="https://unpkg.com/feather-icons/dist/feather.min.css">

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<style>
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
        margin-top: 80px;
        /* Sesuaikan dengan tinggi navbar Anda */
        padding: 20px;
        /* Sesuaikan sesuai kebutuhan Anda */
    }

    /* Gaya untuk tombol "Tambah Buku" */
    .btn-tambah-buku {
        background-color: #eeebe3;
        color: #333;
        width: 100px;
        margin-right: 10px;
        margin-left: 10px;
    }

    /* Gaya untuk tabel data buku */
    .table-data-buku_tamu {
        margin-top: 20px;
        /* Sesuaikan dengan kebutuhan Anda */
    }

    .modal-dialog-centered {
        margin-top: 5rem !important;
        /* Sesuaikan dengan kebutuhan Anda */
    }
</style>

<?php
include 'koneksi.php';
?>


<!-- MAIN CONTENT-->
<div class="p-4 active-main-content" id="main-content">
    <div class="row">
        <!-- Kolom Formulir -->
        <div class="col-sm-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="text-center">
                        <h4>BUKU TAMU</h4>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary button-custom btn-tambah-buku_tamu float-left" data-toggle="modal" data-target="#tambahBukuTamuModal">
                            Tambah Kunjungan
                        </button>
                        </a>
                        <table class="table table-data-buku_tamu" id="example">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Tanggal kunjungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Isi tabel -->
                                <?php
                                $nomor = 1;
                                $query = mysqli_query($db, "SELECT * FROM buku_tamu ORDER BY buku_tamu.id");

                                while ($row = mysqli_fetch_array($query)) : ?>
                                    <tr>
                                        <td><?= $nomor++ ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['tgl_kunjungan'] ?></td>
                                    </tr>
                                <?php endwhile; ?>
                                <!-- Awal Modal Tambah Buku tamu -->
                                <div class="modal fade" id="tambahBukuTamuModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Tambah Buku tamu</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <!-- Form tambah user -->
                                            <form action="http://localhost/kelompok1perpus/kunjungan/proses-bukutamu.php" method="post">
                                                <div class="modal-body">
                                                    <div class="mb-3 row">
                                                        <label for="nama" class="col-sm-2 col-form-label">Nama </label>
                                                        <div class="col-sm-5">
                                                            <input type="text" class="form-control" id="nama" name="nama" required>
                                                        </div>

                                                    </div>

                                                    <!-- <div class="mb-3 row">
                          <label for="tgl_kunjungan" class="col-sm-2 col-form-label">Tanggal Kunjungan</label>
                          <div class="col-sm-5">
                            <input type="date" class="form-control" id="tgl_kunjungan" name="tgl_kunjungan" required>
                          </div>
                        </div> -->

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary" name="simpanBukuTamu">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Modal Tambah Buku tamu -->

                        </table>

                        <!-- // searching  -->
                        <script>
                            $(document).ready(function() {
                                $('#example').DataTable({
                                    "lengthMenu": [
                                        [10, 25, 50, -1],
                                        [10, 25, 50, "All"]
                                    ],
                                    "pageLength": 10
                                });
                            });
                        </script>