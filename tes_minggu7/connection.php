<?php


try {
    $db = new PDO("mysql:host=localhost;dbname=tes","root","",[PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION]);

} catch (Exception $e) {
    echo $e->getMessage();
}

$daftar=$db->query("select * from siswa"); 

$data_daftar=$daftar->fetchAll();  




