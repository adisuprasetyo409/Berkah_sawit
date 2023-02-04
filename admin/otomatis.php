<?php
$konek = mysqli_connect("localhost", "root", "", "iot");

$stat = $_GET['statt'];
if($stat == "ON")
{
    mysqli_query($konek, "UPDATE tb_kontrol SET relay=2");
    echo "ON";
}
else
{
    mysqli_query($konek, "UPDATE tb_kontrol SET relay=0");
    echo "OFF";
}