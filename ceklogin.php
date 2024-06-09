<?php
session_start();
include ("connect.php");
global $con;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai username dan password dari form
	
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Periksa apakah username atau password kosong
    if (empty($username) || empty($password)) {
        // Jika kosong, tampilkan pesan peringatan
        echo '<div style="color: red;">Username dan password harus diisi.</div>';
        // Hentikan eksekusi skrip
        exit;
    }

    // Query ke database untuk memeriksa kredensial
    $sql = mysqli_query($con, "SELECT username, password FROM user WHERE username='$username'");

    // Periksa apakah ada baris data yang cocok dengan username yang diinputkan
    if (mysqli_num_rows($sql) == 1) {
        $row = mysqli_fetch_assoc($sql);
        // Memeriksa apakah password cocok
        if (md5($password) == $row['password']) {
            // Jika cocok, set session user dan redirect ke halaman index.php
            $_SESSION['user'] = $username;
            header("Location: index.php");
            exit;
        } else {
            // Jika password tidak cocok, tampilkan pesan peringatan
            echo '<div style="color: red;">Password salah.</div>';
            // Hentikan eksekusi skrip
            exit;
        }
    } else {
        // Jika tidak ada username yang cocok, tampilkan pesan peringatan
        echo '<div style="color: red;">Username tidak ditemukan.</div>';
        // Hentikan eksekusi skrip
        exit;
    }
} else {
    // Jika tidak melalui metode POST, redirect kembali ke halaman login
    header("Location: login.php");
    exit;
}
?>
