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
    margin-top: 120px;
    /* Sesuaikan dengan tinggi navbar Anda */
    padding: 20px;
    /* Sesuaikan sesuai kebutuhan Anda */
  }
</style>

<?php
chdir(__DIR__);
include '../koneksi.php';
?>


<!-- MAIN CONTENT peminjaman-->
<div class="p-4 active-main-content" id="main-content">
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPeminjaman" data-bs-whatever="@getbootstrap" style="margin-bottom: 20px;">Tambah Peminjaman</button>


  <div class="row">
    <!-- Kolom Formulir -->
    <div class="col-sm-12 text-center">
      <div class="card custom-card">
        <div class="card-header">
          <h4>DATA PEMINJAMAN BUKU</h4>
        </div>
        <div class="card-body">
          <table class="table" id="example">
            <thead>
              <tr>
                <th scope="col">no</th>
                <th scope="col">id transaksi</th>
                <th scope="col">nama</th>
                <th scope="col">judul buku</th>
                <th scope="col">tanggal peminjaman</th>
                <th scope="col">tanggal pengembalian</th>
                <th scope="col">jumlah denda</th>
                <th scope="col">aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $nomor = 1;
              $query = mysqli_query($db, "SELECT * FROM peminjaman 
                            JOIN member ON member.id_member = peminjaman.member_id 
                            JOIN books ON books.kode_buku = peminjaman.tanda_buku");

              while ($row = mysqli_fetch_array($query)) : ?>
                <!-- Isi tabel -->
                <tr>
                  <td><?= $nomor++ ?></td>
                  <td><?= $row['id_transaksi'] ?></td>
                  <td><?= $row['nama'] ?></td>
                  <td><?= $row['judul'] ?></td>
                  <td><?= $row['tgl_pinjam'] ?></td>
                  <td><?= $row['tgl_kembali'] ?></td>
                  <td><?= $row['denda'] ?></td>
                  <td>

                    <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditPeminjaman<?= $nomor ?>">Edit</a>

                    <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapusPeminjaman<?= $nomor ?>">Hapus</a>
                  </td>
                </tr>

                <!-- Awal Modal Edit Peminjaman -->
                <div class="modal fade" id="modalEditPeminjaman<?= $nomor ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5>data peminjaman</h5>
                      </div>
                      <form action="http://localhost/kelompok1perpus/peminjaman/proses-peminjaman.php" method="post" class="row g-3">
                        <input type="hidden" name="id_transaksi" value="<?= $row['id_transaksi'] ?>">
                        <div class="modal-body">

                          <div class="col-md-6">
                            <label for="nama" class="form-label">Nama</label>
                            <select name="member_id" class="form-select" id="memberSelect">
                              <option value="">--Pilih Nama--</option>
                              <?php
                              $member = mysqli_query($db, "SELECT * FROM member");
                              while ($data_member = mysqli_fetch_array($member)) {
                                $selectedMember = $data_member['id_member'] == $row['member_id'] ? 'selected' : '';
                                echo "<option " . $selectedMember . " value=" . $data_member['id_member'] . ">" . $data_member['nama'] . "</option>";
                              }
                              ?>

                            </select>
                          </div>

                          <div class="col-md-6">
                            <label for="judul" class="form-label">Judul Buku</label>
                            <select name="tanda_buku" class="form-select" id="booksSelect">
                              <option value="">--Pilih Buku--</option>
                              <?php
                              $buku = mysqli_query($db, "SELECT * FROM books");
                              while ($data_buku = mysqli_fetch_array($buku)) {
                                $selectedBuku = $data_buku['kode_buku'] == $row['tanda_buku'] ? 'selected' : '';
                                echo "<option " . $selectedBuku . " value=" . $data_buku['kode_buku'] . ">" . $data_buku['judul'] . "</option>";
                              }
                              ?>

                            </select>
                          </div>


                          <!-- <div class="col-md-6">
                            <label for="tgl_pinjam" class="form-label">Tanggal Peminjaman</label>
                            <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" value="<?= $row['tgl_pinjam'] ?>">
                          </div>

                          <div class="col-md-6">
                            <label for="tgl_kembali" class="form-label">Tanggal Kembali</label>
                            <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" value="<?= $row['tgl_kembali'] ?>">
                          </div> -->



                          <div class="col-md-6">
                            <label for="denda" class="form-label">Denda</label>
                            <input type="text" class="form-control" id="judul" name="denda" value="<?= $row['denda'] ?>">
                          </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary" name="ubahPeminjaman">submit</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- Akhir Modal Edit Peminjaman -->

                <!--Awal Modal "Hapus Prodi" -->
                <div class="modal fade" id="modalHapusPeminjaman<?= $nomor ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Hapus Peminjaman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <!-- Form hapus prodi -->
                      <form action="http://localhost/kelompok1perpus/peminjaman/proses-peminjaman.php" method="post">
                        <input type="hidden" name="id_transaksi" value="<?= $row['id_transaksi'] ?>">

                        <div class="modal-body">
                          <h5 class="text-center">Apakah yakin menghapus data ini?</h5> <br>
                          <span class="text-danger text-center"><?= $row['id_transaksi'] ?> - <?= $row['nama'] ?> - <?= $row['judul'] ?></span>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary" name="hapusPeminjaman">Ya, Hapus Aja!</button>
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

  <!-- Awal modal tambah peminjaman -->
  <div class="modal fade" id="modalTambahPeminjaman" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5>data peminjaman</h5>
        </div>
        <form action="http://localhost/kelompok1perpus/peminjaman/proses-peminjaman.php" method="post" class="row g-3">
          <div class="modal-body">

            <div class="col-md-6">
              <label for="nama" class="form-label">Nama</label>
              <select name="member_id" class="form-select" id="memberSelect">
                <option value="">--Pilih Nama--</option>
                <?php
                $nama = mysqli_query($db, "SELECT * FROM member");
                while ($data_member = mysqli_fetch_array($nama)) {
                  echo "<option value=" . $data_member['id_member'] . ">" . $data_member['nama'] . "</option>";
                }
                ?>

              </select>
            </div>
            <!-- 
            <div class="col-md-6">
              <label for="id_member" class="form-label">ID Member</label>
              <input type="text" class="form-control" id="id_member" name="id_member" disabled>
            </div> -->

            <!-- Awal Script untuk id_member -->
            <!-- <script>
              // Mendapatkan elemen dropdown dan input
              var memberSelect = document.getElementById('memberSelect');
              var idMemberInput = document.getElementById('id_member');

              // Menambahkan event listener untuk perubahan pada dropdown
              memberSelect.addEventListener('change', function() {
                // Memperoleh nilai terpilih dari dropdown
                var selectedMemberId = memberSelect.value;

                // Mengupdate nilai input id_member
                idMemberInput.value = selectedMemberId;
              });
            </script> -->
            <!-- Akhir Script untuk id_member -->

            <div class="col-md-6">
              <label for="judul" class="form-label">Judul Buku</label>
              <select name="tanda_buku" class="form-select" id="booksSelect">
                <option value="">--Pilih Buku--</option>
                <?php
                $buku = mysqli_query($db, "SELECT * FROM books");
                while ($data_buku = mysqli_fetch_array($buku)) {
                  echo "<option value=" . $data_buku['kode_buku'] . ">" . $data_buku['judul'] . "</option>";
                }
                ?>

              </select>
            </div>
            <!-- 
            <div class="col-md-6">
              <label for="kode_buku" class="form-label">Kode Buku</label>
              <input type="text" class="form-control" id="kode_buku" name="kode_buku" disabled>
            </div> -->

            <!-- Awal Script untuk kode_buku -->
            <!-- <script>
              // Mendapatkan elemen dropdown dan input
              var booksSelect = document.getElementById('booksSelect');
              var kodeBukuInput = document.getElementById('kode_buku');

              // Menambahkan event listener untuk perubahan pada dropdown
              booksSelect.addEventListener('change', function() {
                // Memperoleh nilai terpilih dari dropdown
                var selectedKodeBuku = booksSelect.value;

                // Mengupdate nilai input id_member
                kodeBukuInput.value = selectedKodeBuku;
              });
            </script> -->
            <!-- Akhir Script untuk kode_buku -->

            <!-- script awal auto tgl_kembali -->
            <script>

            </script>
            <!-- script akhir auto tgl_kembali -->

            <!-- <div class="col-md-6">
              <label for="tgl_pinjam" class="form-label">Tanggal Peminjaman</label>
              <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam">
            </div>

            <div class="col-md-6">
              <label for="tgl_kembali" class="form-label">Tanggal Kembali</label>
              <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali">
            </div> -->



            <div class="col-md-6">
              <label for="denda" class="form-label">Denda</label>
              <input type="text" class="form-control" id="judul" name="denda">
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="simpanPeminjaman">submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- AKhir modal tambah peminjaman -->
</div>


<!-- Example jQuery code to trigger the modal -->
<script>
  var modalTambahPeminjaman = document.getElementById('modalTambahPeminjaman')
  modalTambahPeminjaman.addEventListener('show.bs.modal', function(event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalTitle = exampleModal.querySelector('.modal-title')
    var modalBodyInput = exampleModal.querySelector('.modal-body input')

    modalTitle.textContent = 'New message to ' + recipient
    modalBodyInput.value = recipient
  })
</script>
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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>