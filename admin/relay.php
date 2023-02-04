<?php
$konek = mysqli_connect("localhost", "root", "", "iot");

$stat = $_GET['stat'];
if($stat == "ON")
{
    mysqli_query($konek, "UPDATE tb_kontrol SET relay=1");
    echo "ON";
}
else
{
    mysqli_query($konek, "UPDATE tb_kontrol SET relay=0");
    echo "OFF";
}

// $statt = $_GET['statt'];
// if ($statt == "ON")
// {
//     mysqli_query($konek, "UPDATE tb_kontrol SET relay=2");
//     echo "ON";

// }
// else {
//     mysqli_query($konek, "UPDATE tb_kontrol SET relay=0");
//     echo "OFF";
// }
?>

