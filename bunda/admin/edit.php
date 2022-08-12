<?php 
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Menu</h3>
<a class="btn" href="barang.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$id_brg=mysqli_real_escape_string($con,$_GET['id']);
$det=mysqli_query($con,"select * from barang where id='$id_brg'")or die(mysql_error());
while($d=mysqli_fetch_array($det)){
?>					
	<form action="update.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="id" value="<?php echo $d['id'] ?>"></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><input type="text" class="form-control" name="nama" value="<?php echo $d['nama'] ?>"></td>
			</tr>
			<tr>
				<td>Kategori</td>
				<td><input type="text" class="form-control" name="kategori" value="<?php echo $d['kategori'] ?>"></td>
			</tr>
			<tr>
				<td>Modal</td>
				<td><input type="text" class="form-control" name="modal" value="<?php echo $d['modal'] ?>"></td>
			</tr>
			<tr>
				<td>Harga</td>
				<td><input type="text" class="form-control" name="harga" value="<?php echo $d['harga'] ?>"></td>
			</tr>
			<tr>
				<td>Jumlah</td>
				<td><input type="text" class="form-control" name="jumlah" value="<?php echo $d['jumlah'] ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan"></td>
			</tr>
		</table>
	</form>
	<?php 
}
?>
<?php include 'footer.php'; ?>