<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .main-panel {
            margin-top: 20px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table td,
        .table th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .image img {
            border: 3px solid #333333;
            border-radius: 5px;
            max-width: 100%; /* Maksimum lebar gambar adalah 100% dari container */
            height: auto;
        }
    </style>
</head>

<body>

    <?php
    include 'koneksi.php';

    if (isset($_GET['kode_buku'])) {
        $kode_buku = $_GET['kode_buku'];
        $query = $db->query("SELECT * FROM books 
            INNER JOIN categories ON books.category_id=categories.id_kategori 
            INNER JOIN pengarang ON books.pengarang_id=pengarang.id_pengarang 
            INNER JOIN penerbit ON books.penerbit_id=penerbit.id_penerbit 
            WHERE books.kode_buku = '$kode_buku'");
    
        if ($query) {
            if ($query->num_rows == 1) {
                $data = $query->fetch_assoc();
            } else {
                echo "Data dengan Kode Buku '$kode_buku' tidak ditemukan.";
            }
        } else {
            echo "Error dalam menjalankan query: " . $db->error;
        }
    } else {
        echo "Parameter Kode Buku tidak ditemukan dalam URL.";
    }
    ?>

    <div class="main-panel">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Detail Buku</div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td width="250">Kode Buku</td>
                            <td width="550"><?php echo isset($data['kode_buku']) ? $data['kode_buku'] : ''; ?></td>
                            <td rowspan="9" class="image">
                                <img src="berkas/resized_<?php echo $data['sampul']; ?>" alt="Sampul Buku" style="width: 100%; max-width: 200px;" />
                            </td>
                        </tr>
                        <tr>
                            <td width="250">Judul</td>
                            <td width="550"><?php echo $data['judul']; ?></td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td><?php echo $data['nama_kategori']; ?></td>
                        </tr>
                        <tr>
                            <td>Pengarang</td>
                            <td><?php echo $data['nama_pengarang']; ?></td>
                        </tr>
                        <tr>
                            <td>Penerbit</td>
                            <td><?php echo $data['nama_penerbit']; ?></td>
                        </tr>
                        <tr>
                            <td>Buku yang Tersedia</td>
                            <td><?php echo $data['available_books']; ?></td>
                        </tr>
                        <tr>
                            <td>Total Buku</td>
                            <td><?php echo $data['total_books']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
