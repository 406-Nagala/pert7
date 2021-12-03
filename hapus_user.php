<?php
    #digunakan untuk koneksi ke databses
    include "../pert7/koneksi.php";
    #memanggil perintah delete dengan id_user 
    $sql = "delete from users where id_user= '$_GET[id]'";
    #Untuk mengirimkan perintah query
    mysqli_query($con, $sql);
    #untuk memutus koneksi 
    mysqli_close($con);
    #mengalihkan ke file tampil_user.php
    header('location:tampil_user.php');
?>