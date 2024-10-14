<style>
    .post-item-wrapper {
        display: flex;
        overflow-x: auto; /* Mengaktifkan scroll horizontal */
        overflow-y: hidden; /* Menonaktifkan scroll vertical */
        margin: 20px 0; /* Menambahkan margin atas dan bawah */
        white-space: nowrap; /* Mencegah wrap ke baris berikutnya */
    }

    .post-item {
        margin-right: 20px; /* Jarak antar buku */
        margin-bottom: 20px; /* Menambahkan margin bawah card */
    }

    .card {
        width: 250px; /* Lebar kartu */
        height: 400px; /* Tinggi kartu (disesuaikan sesuai kebutuhan) */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Efek bayangan kartu */
        transition: transform 0.3s ease-in-out; /* Efek transisi ketika hover */
        margin-right: 15px; /* Menambahkan margin antara card */
        margin-bottom: 15px;
        display: inline-block; /* Membuat kartu tampil dalam satu baris */
        white-space: normal; /* Mengembalikan wrap ke kondisi normal */
    }

    .card:hover {
        transform: scale(1.05); /* Perbesar kartu saat hover */
    }

    .card-img-top {
        width: 100%;
        height: 85%; /* Ubah tinggi gambar kartu menjadi 70% */
        object-fit: cover; /* Menggunakan 'cover' agar gambar memenuhi area kartu */
    }

    .card-body {
        padding: 15px; /* Menambahkan padding pada bagian body kartu */
        flex: 1; /* Memastikan card-body memenuhi sisa tinggi kartu */
        box-sizing: border-box; /* Mencegah padding mempengaruhi tinggi total kartu */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin-bottom: 15px; /* Menambahkan margin bawah card-body */
        text-align: center; /* Tengahkan teks */
    }
</style>

<!--====== HEADER PART ENDS ======-->
<section id="home" class="hero-area bg_cover">
	<div class="container">
		<div class="row">
			<div class="mx-auto col-lg-9 col-xl-9 col-md-10">
				<div class="text-center hero-content">
					<h1 class="mb-30 wow fadeInUp" data-wow-delay=".2s">WELCOME TO LIBRARY</h1>
					<p class="wow fadeInUp" data-wow-delay=".4s">Nothing is pleasanter than exploring in a library.</p></br>

					<a href="" rel="nofollow" class="main-btn btn-hover">more info</a>

				</div>
			</div>
		</div>
	</div>
</section>

<!--====== SEARCH PART START ======-->
<div class="search-area">
		<div class="container">
			<div class="search-wrapper">
				<form action="#">
					<div class="row justify-content-center">
						<div class="col-lg-3 col-sm-5 col-10">
							<div class="search-input">
								<label for="keyword"><i class="lni lni-search-alt theme-color"></i></label>
								<input type="text" name="keyword" id="keyword" placeholder="Product">
							</div>
						</div>
						<div class="col-lg-3 col-sm-5 col-10">
							<div class="search-input">
								<label for="category"><i class="lni lni-grid-alt theme-color"></i></label>
								<select name="category" id="category">
									<option value="none" selected disabled>Categories</option>
									<option value="none">sejarah</option>
									<option value="none">agama</option>
									<option value="none">teknologi</option>
									<option value="none">manajemen</option>
									<option value="none">akutansi</option>
									<option value="none">bahasa</option>
									<option value="none">agama</option>
									<option value="none">fiksi</option>
									<option value="none">education</option>
									<option value="none">sosial</option>
								</select>
								
							</div>
						</div>
						<div class="col-lg-3 col-sm-5 col-10">
							<div class="search-input">
								<label for="location"><i class="lni lni-map-marker theme-color"></i></label>
								<select name="location" id="location">
									<option value="none" selected disabled>Politeknik Negeri Padang</option>
								</select>
							</div>
						</div>
						<div class="col-lg-2 col-sm-5 col-10">
							<div class="search-btn">
								<button class="main-btn btn-hover">Search <i class="lni lni-search-alt"></i></button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--====== SEARCH PART END ======-->

<!--====== CATEGORY LIST PART START ======-->
<section class="category-list-area pt-130">
    <div class="container">
        <div class="text-center section-title mb-60">
            <h1>BOOK CATEGORY</h1>
            <?php
            include 'koneksi.php';

            // Gunakan prepared statement untuk menghindari SQL injection
            $stmt = $db->prepare("SELECT * FROM categories");

            // Eksekusi query
            $stmt->execute();

            // Periksa hasil query
            if ($stmt) {
                // Dapatkan hasil query sebagai array asosiatif
                $result = $stmt->get_result();

                // Tutup statement
                $stmt->close();
            } else {
                die("Query error: " . $db->error);
            }
            ?>
            <div class="category-list-wrapper row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($result as $row) : ?>
                    <div class="col">
                        <div class="card h-100" style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                            <div class="card-body">
                                <div class="icon text-center">
                                    <i class="fas fa-book" style="font-size: 3rem; color: #ff8c00;"></i>
                                </div>
                                <h5 class="card-title text-center" style="color: #333; font-family: 'Arial', sans-serif; font-weight: bold; padding-top: 10px;"><?= $row['nama_kategori'] ?></h5>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<!--====== CATEGORY LIST PART END ======-->



	<!--====== VIDEO PART START ======-->
<section class="video-area" style="margin-top: 30px;">
    <div class="video-wrapper img-bg">
        <div class="container">
            <div class="text-center video-content">
                <h1 class="text-white mb-60">Learn More About Us</h1>
            </div>
        </div>
    </div>

    <div class="container text-center">
        <div class="count-up-wrapper row justify-content-center">

            <div class="col-lg-3 col-sm-6">
                <div class="single-counter">
                    <div class="icon">
                        <i class="lni lni-layers"></i>
                    </div>
                    <span class="count">14</span>
                    <span>Peminjaman</span>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-counter">
                    <div class="icon">
                        <i class="lni lni-users"></i>
                    </div>
                    <span class="count">143</span>
                    <span>Members</span>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-counter">
                    <div class="icon">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <span class="count">53</span>
                    <span>buku</span>
                </div>
            </div>

        </div>
    </div>
</section>
<!--====== VIDEO PART ENDS ======-->



<!--====== BAGIAN PRODUK UNGGULAN DIMULAI ======-->

<section class="feature-product-area bg_cover">
    <div class="container">
        <div class="row">
            <div class="mx-auto col-lg-12">
                <div class="text-center section-title mb-60">
                    <h1>BUKU TERBARU</h1>
                    <div class="post-item-wrapper" id="book-slider">
                        <?php
                        include 'koneksi.php';

                        // Gunakan prepared statement untuk menghindari SQL injection
                        $stmt = $db->prepare("SELECT * FROM books 
                            INNER JOIN categories ON books.category_id = categories.id_kategori 
                            INNER JOIN pengarang ON books.pengarang_id = pengarang.id_pengarang 
                            INNER JOIN penerbit ON books.penerbit_id = penerbit.id_penerbit 
                            ORDER BY books.kode_buku"); 

                        // Eksekusi query
                        $stmt->execute();

                        // Dapatkan hasil query sebagai array asosiatif
                        $result = $stmt->get_result();

                        // Periksa apakah ada hasil
                        if ($result->num_rows > 0) {
                            // Loop untuk menampilkan setiap buku
                            $counter = 0;
                            while ($row = $result->fetch_assoc()) {
								echo '<div class="post-item">';
                                // Tambahkan tautan ke halaman detail-buku.php dengan mengatur href
                                echo '<a href="detail-buku.php?kode_buku=' . $row['kode_buku'] . '" class="card">';
                                echo '<div class="card">';
                                echo '<img class="card-img-top" src="berkas/' . $row['sampul'] . '" alt="Sampul Buku">';
                                echo '<div class="card-body">';
                                echo '<h5 class="card-title" data-toggle="modal" data-target="#DetailModal" data-id="' . $row['kode_buku'] . '" style="margin-bottom: 1px;">' . $row['judul'] . '</h5>';
                                echo '<p class="author" style="margin-top: 0; margin-bottom: 10px; font-size: 15px;">' . $row['nama_pengarang'] . '</p>';
                                echo '</div>';
                                echo '</div>';
                                echo '</a>';
                                echo '</div>';
                                $counter++;
                            }
                        } else {
                            echo 'Tidak ada data ditemukan.';
                        }

                        // Tutup statement
                        $stmt->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

