<?php
include_once("connection.php");

if ($_POST) {
    $file_upload = $_FILES['berkas'];

    if ($file_upload['name'] != "") {
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $hp = $_POST['hp'];
        $semester = $_POST['semester'];
        $ipk = $_POST['ipk'];
        $beasiswa = $_POST['beasiswa'];
        $status = "belum di verifikasi";
        $berkas = $file_upload['name'];

        //perintah sql untuk menambah data 

        $result = "UPDATE pendaftar SET nama='$nama', email='$email', hp='$hp', semester='$semester', ipk='$ipk', beasiswa='$beasiswa', berkas='$berkas', status='$status' WHERE nim='$nim'";
        mysqli_query($conn, $result);

        //function php untuk upload

        move_uploaded_file($file_upload['tmp_name'], __DIR__ . "/uploads/" . $berkas);

        header("Location: index.php?link_page=3");
    }
}
