<?php
session_start();
include "../pert7/koneksi.php";
#lokasi file koneksi.php yang digunakan untuk menghubungkan ke database
$id_user = $_POST['id_user'];
#memanggil data id_user yang telah diinputkan agar bisa ditampilkan di file action.
$pass = md5($_POST['paswd']);
$sql = "SELECT * FROM users WHERE id_user='$id_user' AND password='$pass'";

if ($_POST["captcha_code"] == $_SESSION["captcha_code"]) { //Berguna untuk pengondisian apakah kode captcha yang dimasukkan sesuai atau tidak

    $login = mysqli_query($con, $sql);
    #Untuk mengirimkan perintah query. Terdiri dari dua parameter yaitu: koneksi, dan SQL
    $ketemu = mysqli_num_rows($login);
    #Mengambil jumlah baris di dalam tabel.
    $r = mysqli_fetch_array($login);
    #Mengambil hasil baris sebagai asosiatif , array numerik , atau keduanya. Singkatnya untuk menampung baris tabel menjadi array
    if ($ketemu > 0) {

        $riwayat = "UPDATE users SET riwayat = NOW() WHERE id_user='$r[id_user]'";
        $update  = mysqli_query($con, $riwayat);

        if (!empty($update)) {
            #PHP akan menjalankan perintah pada server maupun pada client/user
            $_SESSION['iduser'] = $r['id_user'];
            #Varibel ini adalah sebuah inisialisasi dari session id_user.
            $_SESSION['passuser'] = $r['password'];
            #Varibel ini adalah sebuah inisialisasi dari session password.
            echo "USER BERHASIL LOGIN<br>";
            echo "id user =", $_SESSION['iduser'], "<br>";
            #Parameter id user berfungsi untuk menyimpan iduser
            echo "password=", $_SESSION['passuser'], "<br>";
            #Parameter password berfungsi untuk menyimpan password
            echo "<a href=logout.php><b>LOGOUT</b></a></center>";
        } else {
            echo "<center>Login gagal! username & password tidak benar<br>";
            echo "<a href=form_login.php><b>ULANGILAGI</b></a></center>";
        }
    }
    mysqli_close($con);
    #Untuk memutus atau menutup koneksi ke server
} else {
    echo "<center>Login gagal! Captcha tidak sesuai<br>"; //Jika tidak berhasil mengautentikasikan, maka akan muncul login gagal.
    echo "<a href=form_login.php><b>ULANGILAGI</b></a></center>";
}
?>