<?php 
include 'config.php';
require 'header.php';
$nama=$_POST['nama'];
$kategori=$_POST['kategori'];
$modal=$_POST['modal'];
$harga=$_POST['harga'];
$jumlah=$_POST['jumlah'];
$sisa=$_POST['jumlah'];
$totalmodal = $modal * $jumlah;
mysqli_query($con,"insert into barang values('','$nama','$kategori','$modal','$harga','$jumlah','$sisa',$totalmodal)");
if (mysqli_affected_rows($con) > 0){
        echo "<script>Swal.fire({
        title: 'Berhasil',
        text: 'Data Berhasil Ditambahkan',
        type: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke'
      }).then((result) => {
        if (result.value) {
            document.location.href='barang.php';
        }
      })
    </script>";



}
header("location:barang.php");

 ?>