<?php

include 'connection.php';
include 'function.php';


$siswa=$db->query("select * from siswa");
$data_siswa=$siswa->fetchAll();
// echo $data_siswa;

if(isset($_GET['delete'])){
  deleteSiswa($_GET);
  header('location:index.php');
}

if(isset($_POST['simpan'])){
  inputData($_POST);
  header('location: index.php');
}


if(isset($_POST['search']))
{


    $filter=$db->quote($_POST['search']);
    

    $name=$_POST['search'];

    $search=$db->prepare("select * from siswa where nama=? or sekolah=? or motivasi=?");

    $search->bindValue(1,$name,PDO::PARAM_STR);
    $search->bindValue(2,$name,pdo::PARAM_STR);
    $search->bindValue(3,$name,pdo::PARAM_STR);

    $search->execute();

    $tampil_data=$search->fetchAll(); 

    $row = $search->rowCount();
    

}else{
    $data = $db->query("select * from siswa");
    

    $tampil_data = $data->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Table Siswa</title>
</head>
<body>
<h2>Data Siswa</h2>
<?php if(isset($row)):?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <p class="lead "><?php echo $row;?> Telah Terdeteksi !</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif; ?>
<form class="form-inline" action="index.php" method="POST">
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control" name="search" placeholder="nama atau sekolah">
        <input type="submit" value="Cari">
    </div>
</form>
<!-- Allert Massage -->

<table class="table table-bordered table-primary">
  <thead>
    <tr>
      <th scope="col">Id_siswa</th>
      <th scope="col">Nama</th>
      <th scope="col">Sekolah</th>
      <th scope="col">Motivasi</th>
      <th scope="col">Fitur</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach ($data_daftar as $key): ?>
    <tr>
      <td><?php echo $key['id_siswa'];?></td>
      <td><?php echo $key['nama'];?></td>
      <td><?php echo $key['sekolah'];?></td>
      <td><?php echo $key['motivasi'];?></td>
      <td> <a class="btn btn-danger" data-toggle="modal" data-target="#siswa">Delete</a> | <a class="btn btn-success" href="edit.php?id_siswa=<?php echo $key['id_siswa']; ?>">Edit</a></td>
    </tr>
      <?php endforeach; ?>
  </tbody>
</table>

<div class="modal" id="siswa" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus data ini?.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger"><a href="delete.php?id_siswa=<?php echo $key['id_siswa']; ?> ">Hapus Data</a></button>
      </div>
    </div>
  </div>
</div>

<!-- Create -->
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3 style="text-align: center;">Tambah Data</h3>
        <form action="input.php" method="POST">
            <div class="form-group ">
            <label for="exampleFormControlTextarea1">Nama</label>
            <input type="text" name="nama" class="form-control">
        </div>
        <div class="form-group ">
            <label for="exampleFormControlTextarea1">Sekolah</label>
            <input type="text" name="sekolah" class="form-control">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Motivasi</label>
            <input type="text" name="motivasi" class="form-control">
        </div>

        <button type="submit" class="btn btn-dark">Simpan</button>
        </form>
        </div>
    </div>
</div>






<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>