<?php 
include 'config.php';
include 'header.php';
$id=$_POST['id'];
$nama=$_POST['nama'];
$kategori=$_POST['kategori'];
$modal=$_POST['modal'];
$harga=$_POST['harga'];
$jumlah=$_POST['jumlah'];

mysqli_query($con,"update barang set nama='$nama', kategori='$kategori', modal='$modal', harga='$harga', jumlah='$jumlah' where id='$id'");
if(mysqli_affected_rows($con)>0){
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
            document.location.href='barang.php';
        }
      })
    </script>";
}

?>