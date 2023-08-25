<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="css/mycss.css">

    <title>Formulir Pendaftaran Beasiswa</title>
</head>

<body>
    <?php

    //connection untuk hasil
    include_once("connection.php");

    $result = mysqli_query($conn, "SELECT * FROM pendaftar");

    // Digunakan untuk mendeteksi apakah ada parameter link page yang dikirimkan, 
    // jika ada link page maka akan diisi oleh parameter tersebut, 
    //jika tidak ada maka nilai variabel akan di inisialisasikan dengan 1
    if (isset($_GET['link_page'])) {
        $link_page = $_GET['link_page'];
    } else {
        $link_page = "1";
    }

    //Digunakan untuk mendeteksi pilihan beasiswa yang dipilih dari halaman sebelumnya
    if (isset($_GET['jenis_beasiswa'])) {
        $jenis_beasiswa = $_GET['jenis_beasiswa'];
    } else {
        $jenis_beasiswa = "Beasiswa Akademik";
    }

    //Function yang digunakan untuk menentukan link yang aktif
    function SetLinkPage($actual_link, $reference_link)
    {
        $result = "";
        if ($actual_link == $reference_link) {
            $result = "active";
        }

        return $result;
    }

    //Function yang digunakan untuk menentukan content yang aktif
    function SetContentPage($actual_content, $reference_content)
    {
        $result = "";
        if ($actual_content == $reference_content) {
            $result = "show active";
        }

        return $result;
    }

    //Function yang digunakan untuk menentukan pilihan beasiswa
    function SetBeasiswa($actual_beasiswa, $reference_beasiswa)
    {
        $result = "";
        if ($actual_beasiswa == $reference_beasiswa) {
            $result = "selected";
        }

        return $result;
    }

    //function untuk menggenerate bilangan random untuk ipk
    function generateRandomFloat(float $minValue, float $maxValue): float
    {
        return $minValue + mt_rand() / mt_getrandmax() * ($maxValue - $minValue);
    }

    //function untuk disable jika ipk kurang dari 3
    function SetDisable($ipk)
    {
        $result = "";
        if ($ipk < 3) {
            $result = "disabled";
        }
        return $result;
    }

    $pendaftar = mysqli_query($conn, "SELECT * FROM pendaftar");
    $hasil = array(); // Initialize the $hasil array
    while ($row = mysqli_fetch_array($pendaftar)) {
        $hasil[] = $row;
    }
    ?>

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
            <a class="navbar-brand" href="#">Pendaftaran Beasiswa</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div><!-- end of container -->

    <div class="container">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <!-- Nav Pilihan beasiswa -->
                <a class="nav-item nav-link <?php echo SetLinkPage("1", $link_page) ?>" id="nav-home-tab" data-toggle="tab" href="#beasiswa" role="tab" aria-controls="nav-home" aria-selected="true">Pilihan Beasiswa </a>

                <!-- Nav Daftar -->
                <a class="nav-item nav-link <?php echo SetLinkPage("2", $link_page) ?>" id="nav-profile-tab" data-toggle="tab" href="#daftar" role="tab" aria-controls="nav-profile" aria-selected="false">Daftar</a>

                <!-- Nav Hasil -->
                <a class="nav-item nav-link <?php echo SetLinkPage("3", $link_page) ?>" id="nav-contact-tab" data-toggle="tab" href="#hasil" role="tab" aria-controls="nav-contact" aria-selected="false">Hasil</a>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade <?php echo SetContentPage("1", $link_page) ?>" id="beasiswa" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="section-menu">
                    <h4>Jenis Beasiswa</h4>
                    <p>Beasiswa adalah bantuan yang diberikan kepada mahasiswa sebagai bentuk apresiasi prestasi
                        mahasiswa ataupun berupa bantuan Biaya Pendidikan bagi mahasiswa yang mempunyai keterbatasan finansial.
                        Beasiswa Unggulan yang diberikan bagi masyarakat yang memiliki kemampuan intelektual, emosional,
                        dan spiritual untuk melanjutkan pendidikan pada jenjang sarjana, magister, dan doktor.
                        Disini ada macam-macam beasiswa kuliah yang dapat kalian pilih sesuai dengan ketentuan..</p>
                    <ol>
                        <li>
                            <h5>Beasiswa Akademik</h5>
                            <p>Beasiswa dan bantuan biaya pendidikan bagi mahasiswa meliputi beasiswa Peningkatan Prestasi
                                Akademik (PPA) yang diberikan kepada mahasiswa yang berprestasi secara akademik.</p>
                            <p>Syarat Beasiswa Akademik :</p>
                            <ul>
                                <li>
                                    <p>Rangking 1 sampai 10 di kelas, mulai kelas X-XII atau
                                        rangking 1 sampai 3 di kelas XII selama studi di SMA/SMK/MA sederajat</p>
                                <li>
                                    <p>Lulusan SMA/SMK/MA sederajat dari tahun berjalan (lulusan baru)</p>
                                <li>
                                    <p>Menyertakan foto copy rapot kelas X-XII yang dilegalisir oleh pihak sekolah</p>
                                <li>
                                    <p>Jika dalam raport tidak ada keterangan rangking kelas, pihak sekolah menerbitkan
                                        surat keterangan/lampiran tentang rangking siswa yang bersangkutan</p>
                            </ul>
                            <p>Untuk mendaftar Beasiswa Non Akademik bisa klik tombol daftar dibawah ini</p>
                            <a class="btn btn-primary btn-lg" href="index.php? link_page=2&jenis_beasiswa=akademik">
                                Daftar Sekarang</a>
                        </li>

                        <br>
                        <li>
                            <h5>Beasiswa Non Akademik</h5>
                            <p>Beasiswa Non Akademik atau Jalur Prestasi, adalah evaluasi berdasarkan prestasi
                                non-akademik (olah raga, seni dan social budaya) yang memenuhi standarisasi
                                nilai masuk President University TANPA MELALUI TES, dengan memenuhi syarat dan
                                ketentuan administrasi.</p>
                            <p>Syarat Beasiswa Non Akademik :</p>
                            <ul>
                                <li>
                                    <p>Harus melampirkan bukti prestasi juara tingkat kota / provinsi</p>
                                <li>
                                    <p>Siswa SMA/SMK/MA sederajat usia maksimal 20 tahun</p>
                                <li>
                                    <p>Mengikuti proses seleksi pada gelombang yang sedang dibuka</p>
                                <li>
                                    <p>Melengkapi berkas wajib (KTP/Kartu Pelajar, KK, dan Raport)</p>
                            </ul>
                            <p>Untuk mendaftar Beasiswa Non Akademik bisa klik tombol daftar dibawah ini</p>
                            <a class="btn btn-primary btn-lg" href="index.php? link_page=2&jenis_beasiswa=non_akademik">
                                Daftar Sekarang</a>
                        </li>
                    </ol>

                </div>
            </div> <!-- Konten Punya Pilihan beasiswa -->


            <div class="tab-pane fade <?php echo SetContentPage("2", $link_page) ?>" id="daftar" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="section-menu">
                    <h4>Form Pendaftaran</h4>
                    <br>
                    <form action="add_pendaftar.php" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="nim" placeholder="NIM" name="nim" onkeyup="changeValue(this.value)" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap" name="nama" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hp" class="col-sm-2 col-form-label">Nomor Handphone</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="hp" placeholder="No.Handphone" name="hp" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="semester" class="col-sm-2 col-form-label">Semester</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="semester" id="semester" required>
                                    <?php
                                    for ($i = 1; $i <= 8; $i++) {
                                    ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ipk" class="col-sm-2 col-form-label">IPK</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ipk" name="ipk" value="" required readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="beasiswa" class="col-sm-2 col-form-label">Jenis Beasiswa</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="beasiswa" id="jenisBeasiswa" required>
                                    <option value="akademik" <?php echo SetBeasiswa("akademik", $jenis_beasiswa) ?>>
                                        Beasiswa Akademik</option>
                                    <option value="non_akademik" <?php echo SetBeasiswa("non_akademik", $jenis_beasiswa) ?>>
                                        Beasiswa Non Akademik</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="upload_file">Chose file</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="customFile" name="berkas" required>
                            </div>
                        </div>

                        <input id="submitButton" class="btn btn-primary btn-lg" type="submit" value="Daftar">

                        <a class="btn btn-warning btn-lg" href="index.php?link_page=2">Batal</a>
                    </form>
                </div>

            </div><!-- Konten Punya Daftar -->

            <div class="tab-pane fade <?php echo SetContentPage("3", $link_page) ?>" id="hasil" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="section-menu">
                    <h4>List Pendaftar</h4>

                    <?php
                    while ($user_data = mysqli_fetch_array($result)) {
                        // yang tampil hanya yang ipk nya lebih dari 3
                        if ($user_data['ipk'] < 3) {
                            continue;
                        }
                    ?>

                        <div class="row grid-item">
                            <div class="col-md-3 col-lg-4">
                                <img class="img-fluid" src="uploads/<?php echo $user_data['berkas']; ?>" alt="">
                            </div><br>
                            <div class="col-md-9 col-lg-8">

                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                        <h5>NIM:</h5>
                                        <h6><?php echo $user_data['nim']; ?></h6><br>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                        <h5>Nama:</h5>
                                        <h6><?php echo $user_data['nama']; ?></h6><br>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                        <h5>Email:</h5>
                                        <h6><?php echo $user_data['email']; ?></h6><br>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                        <h5>Handphone:</h5>
                                        <h6><?php echo $user_data['hp']; ?></h6><br>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                        <h5>Semester:</h5>
                                        <h6><?php echo $user_data['semester']; ?></h6><br>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                        <h5>IPK Terakhir:</h5>
                                        <h6><?php echo $user_data['ipk']; ?></h6><br>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                        <h5>Beasiswa:</h5>
                                        <h6><?php echo $user_data['beasiswa']; ?></h6><br>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                        <h5>Berkas:</h5>
                                        <h6><?php echo $user_data['berkas']; ?></h6><br>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                        <h5>Status:</h5>
                                        <h6><?php echo $user_data['status']; ?></h6><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div><!-- Konten Punya Hasil -->
            </div>
        </div><!-- penutup container -->


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script type="text/javascript">
            var prdName = <?php echo json_encode($hasil); ?>; // Convert PHP array to JavaScript object
            const beasiswaInput = document.getElementById('jenisBeasiswa');
            const customFileInput = document.getElementById('customFile');
            const submitButton = document.getElementById('submitButton');

            function changeValue(x) {
                // Find the row with the matching ID
                var matchingRow = prdName.find(row => row.nim == x);

                if (matchingRow) {
                    document.getElementById('ipk').value = matchingRow.ipk;
                    if (matchingRow.ipk < 3) {
                        disableInputs();
                    } else {
                        enableInputs();
                    }
                } else {
                    // Clear the fields if no matching ID is found
                    document.getElementById('ipk').value = '';
                    disableInputs();
                }
            }

            function disableInputs() {
                beasiswaInput.disabled = true;
                customFileInput.disabled = true;
                submitButton.disabled = true;
            }

            function enableInputs() {
                beasiswaInput.disabled = false;
                customFileInput.disabled = false;
                submitButton.disabled = false;
            }
        </script>

</body>

</html>