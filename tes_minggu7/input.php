<?php

include "connection.php";



$input=$db->exec("insert into siswa(id_siswa,nama,sekolah,motivasi) values('".$_POST['id_siswa']."','".$_POST['nama']."','".$_POST['sekolah']."','".$_POST['motivasi']."')");

if($input)
{
    header("Location:index.php");
}

