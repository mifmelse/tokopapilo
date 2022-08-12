<?php
include 'config.php';
require 'header.php';
$jmlhsbl = $_POST['jmlsbl'];
$id = $_POST['id'];
$tanggal = $_POST["tgl"];
$nama = $_POST["nama"];
$jumlah = $_POST["jumlah"];
$harga = $_POST["harga"];
$dt=mysqli_query($con,"select * from barang where nama='$nama'");
$data=mysqli_fetch_assoc($dt);
$sisa=($data['jumlah']-$jumlah) + $jmlhsbl;
 mysqli_query($con,"UPDATE barang set jumlah='$sisa' where nama='$nama'");
$modal=$data['modal'];
$laba=$harga-$modal;
$labaaa=$laba*$jumlah;
$total_harga=$harga*$jumlah;
mysqli_query($con,"UPDATE barang_laku SET tanggal='$tanggal', nama='$nama',jumlah='$jumlah',harga ='$harga',total_harga='$total_harga',laba ='$labaaa' where id= '$id'");
$tes = mysqli_affected_rows($con);
if (mysqli_affected_rows($con)>0){
    echo "<script>Swal.fire({
        title: 'Berhasil',
        text: 'Data Berhasil DiUpdate',
        type: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke'
      }).then((result) => {
        if (result.value) {
            document.location.href='barang_laku.php';
        }
      })
    </script>";

}else{
    echo "<script>Swal.fire({
      title: 'Gagal',
      text: 'Anda Belum Merubah Apapun',
      type: 'error',
      footer: '<a href=edit_laku.php?id=$id>Silahkan Rubah Disini!!!</a>',
      showCancelButton: false,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Oke'
    }).then((result) => {
      if (result.value) {
          document.location.href='edit_laku.php?id=$id';
      }
    })
  </script>";
}



?>