<?php
    #untuk koneksi ke database
    include "../pert7/koneksi.php";
        #memanggil data id_user, nama, email dan password yang di inputkan dan akan di tampilkan
        $id_user = $_POST['id_user'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
    #perintah untuk menambahkan data ke dalam tabel 
    $sql = "INSERT INTO users(id_user, password, nama_lengkap, email) VALUES ('$id_user', '$password','$nama','$email')";
    #Untuk mengirimkan perintah query
    $query = mysqli_query($con, $sql);
    #Untuk memutus koneksi
    mysqli_close($con);
    #untuk mengalihkan file ke tampil_user.php
    header('location:tampil_user.php');
?>