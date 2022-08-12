<?php 
include 'config.php';
include 'header.php';
//barang toko
$nama_br=$_POST['brtoko'];
$hrg_tko = $_POST['hargatko'];
$stok_tko = $_POST['jumlahtko'] ;
$tanggal = $_POST['tgltko'];
//toko
$hh=mysqli_query($con,"SELECT * FROM barang WHERE nama ='$nama_br'");
$til=mysqli_fetch_assoc($hh);
$pop = $til['jumlah'];
if($til['jumlah']< $stok_tko){
    $pop = true;
if(isset($pop)){
echo "<script>
Swal.fire({
    title: 'Opss!!!!',
    text: 'Stok barang Tidak Cukup',
    type: 'info',
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
return false;
}
}
$sisa = $til['jumlah']- $stok_tko;
mysqli_query($con,"UPDATE barang SET jumlah='$sisa' WHERE nama ='$nama_br'");
$qr = mysqli_query($con,"SELECT * FROM barang_toko WHERE nama='$nama_br'");
if(mysqli_affected_rows($con)>0){
$pip= mysqli_fetch_assoc($qr);
$stoklama = $pip['jumlah'];
$stockbaru = $stoklama + $stok_tko;
mysqli_query($con,"UPDATE barang_toko set jumlah='$stockbaru' WHERE nama='$nama_br'");
}else{
  mysqli_query($con,"INSERT INTO barang_toko VALUES ('','$nama_br','$hrg_tko','$stok_tko')");
}
mysqli_query($con,"INSERT INTO brg_manajemen VALUES('','$nama_br','$tanggal','$stok_tko','trx_msk')");
$lol = mysqli_affected_rows($con);
if($lol >0){
echo "<script> Swal.fire({
  title: 'Berhasil',
  text: 'Berhasil Menambahkan Stok Menu',
  type: 'success',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'ok'
}).then((result) => {
  if (result.value) {
    document.location.href='barang.php';
  }
})</script>";
}
?>