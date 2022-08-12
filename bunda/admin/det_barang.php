<?php 
include 'header.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Detail Menu</h3>
<a class="btn" href="barang.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
$id_brg=mysqli_real_escape_string($con,$_GET['id']);


$det=mysqli_query($con,"select * from barang where id='$id_brg'")or die(mysqli_error("data Eror"));
while($d=mysqli_fetch_array($det)){
	?>					
	<table class="table">
		<tr>
			<td>Nama</td>
			<td><?php echo $d['nama'] ?></td>
		</tr>
		<tr>
			<td>Kategori</td>
			<td><?php echo $d['kategori'] ?></td>
		</tr>
		<tr>
			<td>Modal-PCS</td>
			<td>Rp.<?php echo number_format($d['modal']); ?>,-</td>
		</tr>
		<tr>
			<td>Modal Total</td>
			<td>Rp.<?php echo number_format($d['totalmodal']); ?>,-</td>
		</tr>
		<tr>
			<td>Harga</td>
			<td>Rp.<?php echo number_format($d['harga']) ?>,-</td>
		</tr>
		<tr>
			<td>Sisa</td>
			<td><?php echo $d['jumlah'] ?></td>
		</tr>
		<!-- <tr>
			<td>Jumlah</td>
			<td><?php echo $d['sisa'] ?></td>
		</tr> -->
	</table>
	<?php 
}
?>
<?php include 'footer.php'; ?>