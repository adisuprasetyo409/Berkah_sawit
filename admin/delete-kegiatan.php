<?php 
include "../config/app.php";

$id= (int)$_GET['id'];

if (delete_barang($id) > 0){
    echo "<script>
            alert ('DATA BERASIL DI HAPUS')
            document.location.href = 'tables-general.php';
            </script>";
} else {
    echo "<script>
            alert ('DATA BERASIL DI HAPUS')
            document.location.href = 'tables-general.php';
            </script>";
}
?>