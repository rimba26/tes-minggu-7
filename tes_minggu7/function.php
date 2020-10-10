<?php
    
    function inputData($input=[])
    {
        include 'connection.php';
        $sql='INSERT INTO siswa(nama,sekolah,motivasi) VALUES(?,?,?)';

        $result=$db->prepare($sql);
        $result->bindValue(1, $input['nama'],PDO::PARAM_STR);
        $result->bindValue(1, $input['sekolah'],PDO::PARAM_STR);
        $result->bindValue(1, $input['motivasi'],PDO::PARAM_STR);
        $result->execute();
    }

    function deleteSiswa($delete) {
        include 'connection.php';

        $sql = 'DELETE FROM siswa WHERE id_siswa = ?';

        try {
            $result = $db->prepare($sql);
            $result->bindValue(1, $delete['id_siswa'], PDO::PARAM_INT);
            $result->execute();
        } catch (Exception $e) {
            echo "Error!:" . $e->getMessage() . "<br />";
            return false;
        }
        return true;
    }

    function edit($edit=[]) {
        include 'connection.php';

        $sql = 'UPDATE siswa SET nama = ?, sekolah = ?, motivasi = ? WHERE id_siswa = ?';

        $result=$db->prepare($sql);
        $result->bindValue(1, $edit['id_siswa'.'sekolah'.'motivasi'], PDO::PARAM_STR);
    }

    


?>