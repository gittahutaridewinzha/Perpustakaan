<?php 

    include '../koneksi.php';
    include '../method/fungsi.php';

    //awal proses pembuatan id transaksi
        // Ambil ID Transaksi terakhir dari database
        $query = "SELECT * FROM peminjaman ORDER BY id_transaksi DESC LIMIT 1";
        $result = $db->query($query);

        if ($result->num_rows > 0) {
            $last_transaksi = $result->fetch_assoc();
            $last_id_transaksi = $last_transaksi['id_transaksi'] ?? '';

            // Tingkatkan ID transaksi
            $next_id_transaksi = incrementId($last_id_transaksi);
        } else {
            // Jika tidak ada transaksi, maka ID baru dimulai dari 1
            $next_id_transaksi = 1;
        }

        // Format ID sesuai kebutuhan (contoh: T-000002)
        $formatted_next_id_transaksi = 'T-' . str_pad($next_id_transaksi, 6, '0', STR_PAD_LEFT);
    //akhir proses pembuatan id transaksi

    //query insert
    if (isset($_POST['simpanPeminjaman'])) {

        //mengambil nilai yang dikirimkan dari input form
        $nama = $_POST['member_id'];
        $judul_buku = $_POST['tanda_buku'];

        $tgl_pinjam = new DateTime();
        // Durasi peminjaman (7 hari)
        $durasiPeminjaman = new DateInterval('P7D');

        
        // Menghitung tanggal pengembalian
        $tglPengembalian = clone $tgl_pinjam;
        $tglPengembalian->add($durasiPeminjaman);

        //hasil format
        $tanggalFormattedPinjam =$tgl_pinjam->format('d F Y');
        $tanggalFormattedKembali =$tglPengembalian->format('d F Y');

        $denda = $_POST['denda'];

        $simpanPeminjaman = "INSERT INTO peminjaman(id_transaksi, member_id, tanda_buku, tgl_pinjam, tgl_kembali, denda) VALUES ('$formatted_next_id_transaksi', '$nama', '$judul_buku', '$tanggalFormattedPinjam', '$tanggalFormattedKembali', '$denda')";

        //jika simpan sukses
        if ($db->query($simpanPeminjaman)) {
            echo "<script>
                    alert('Simpan Data Peminjaman Sukses');
                    document.location='../index.php?page=peminjaman';
                </script>";
            
        } else {
            echo "<script>
                    alert('Simpan Data Peminjaman Gagal');
                    document.location='../index.php?page=peminjaman';
                </script>";
            
        }

        //$db->close();
    
}

    //query update
    if (isset($_POST['ubahPeminjaman'])) {

        //mengambil nilai yang dikirimkan dari input form
        $nama = $_POST['member_id'];
        $judul_buku = $_POST['tanda_buku'];
        //$tgl_pinjam = new DateTime();
        //$tanggalFormattedPinjam =$tgl_pinjam->format('d F Y');
        //$tgl_kembali = $_POST['tgl_kembali'];
        //$tanggalFormattedKembali =date_create($tgl_kembali)->format('d F Y');
        $denda = $_POST['denda'];
        $id_transaksi = $_POST['id_transaksi'];

        $ubahPeminjaman = "UPDATE peminjaman 
                            SET 
                            member_id = '$nama',
                            tanda_buku = '$judul_buku',
                            denda = '$denda'
                            WHERE id_transaksi = '$id_transaksi'";

        //jika simpan sukses
        if ($db->query($ubahPeminjaman)) {
            echo "<script>
                    alert('Ubah Data Peminjaman Sukses');
                    document.location='../index.php?page=peminjaman';
                </script>";
            
        } else {
            echo "<script>
                    alert('Ubah Data Peminjaman Gagal');
                    document.location='../index.php?page=peminjaman';
                </script>";
            
        }

        //$db->close();
    
}

    //query delete
    if (isset($_POST['hapusPeminjaman'])) {

        //persiapan hapus data 
        $hapusPeminjaman = mysqli_query($db, "DELETE FROM peminjaman 
        WHERE id_transaksi = '$_POST[id_transaksi]'");

        //jika hapus sukses
        if ($hapusPeminjaman) {
            echo "<script>
                    alert('Hapus Peminjaman Sukses');
                    document.location='../index.php?page=peminjaman';
                </script>";
            
        } else {
            echo "<script>
                    alert('Hapus Peminjaman Gagal');
                    document.location='../index.php?page=peminjaman';
                </script>";
        }
    
}  