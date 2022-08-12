<?php include 'header.php';
require 'fungsi.php';
require 'config.php';
?>
<?php if($_SESSION['level'] =='admin'){?>
<h3><span  class="glyphicon glyphicon-briefcase" style="margin-left:10px; margin-top:10px;"></span>  Data Menu</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah Menu</button>
<?php } else{ ?>
	<h3><span  class="glyphicon glyphicon-briefcase" style="margin-left:10px; margin-top:10px;"></span>  Stok Menu</h3>
	<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah Stok</button>
<?php } ?>
<br/>
<br/>
<?php 
if($_SESSION['level'] == 'admin'){
$periksa=mysqli_query($con,"select * from barang where jumlah <=3");
}else{
	$periksa = mysqli_query($con,"SELECT * FROM  barang_toko where jumlah <=3");
}
while($q=mysqli_fetch_array($periksa)){	
	if($q['jumlah']<=3){	
		?>	
		<script>
			$(document).ready(function(){
				$('#pesan_sedia').css("color","red");
				$('#pesan_sedia').append("<span class='glyphicon glyphicon-asterisk'></span>");
			});
		</script>
		<?php
		echo "<div style='padding:5px;' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stok  <a style='color:red;'>". $q['nama']."</a> yang tersisa sudah kurang dari 3 . silahkan pesan lagi !!</div>";	
	}
}
?>
<?php 
$per_hal=10;
if($_SESSION['level']== 'admin'){
$jum= count(ambil()); 
}else{
	$jum = count(ambil1());
}
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
<div class="col-md-12">
	<table class="col-md-2">
		<tr>
			<td>Jumlah Menu</td>		
			<td><?php echo $jum; ?></td>
		</tr>
		<tr>
			<td>Jumlah Halaman</td>	
			<td><?php echo $halaman; ?></td>
		</tr>
	</table>
	<?php if($_SESSION['level'] == 'admin'){?>
	<a style="margin-bottom:10px" href="lap_barang.php" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a>
	<?php }else{?>
		<a style="margin-bottom:10px" href="lap_barang_toko.php" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a>
	<?php }?>
</div>
<form action="cari_act.php" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Cari menu di sini .." aria-describedby="basic-addon1" name="cari">	
	</div>
</form>
<br/>
<?php $level= $_SESSION['level']; if($level == 'admin') {?>
<table class="table table-hover">
	<tr>
		<th class="col-md-1">No</th>
		<th class="col-md-2">Nama Menu</th>
		<th class="col-md-2">Harga Jual</th>
		<th class="col-md-1">Sisa</th>
		<th class="col-md-2">Modal</th>
		<!-- <th class="col-md-2">Jumlah</th> -->
		<!-- <th class="col-md-1">Sisa</th>		 -->
		<th class="col-md-2">Opsi</th>
	</tr>
	<?php 
	if(isset($_GET['cari'])){
		$cari=mysqli_real_escape_string($con,$_GET['cari']);
		$brg=mysqli_query($con,"SELECT * from barang where nama like '$cari' or kategori like '$cari'");
	}else{
		$brg=mysqli_query($con,"SELECT * from barang limit $start, $per_hal");
	}
	$no=1;
	while($b=mysqli_fetch_array($brg)){

		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['nama'] ?></td>
			<td>Rp.<?php echo number_format($b['harga']) ?>,-</td>
			<td><?php echo $b['jumlah'] ?></td>
			<td><?php echo $b['modal'] ?></td>
			<!-- <td><?php echo $b['sisa'] ?></td> -->

			<td>
				<a href="det_barang.php?id=<?php echo $b['id']; ?>" class="btn btn-info">Detail</a>
				<a href="edit.php?id=<?php echo $b['id']; ?>" class="btn btn-warning">Edit</a>
				<a id="hps" href="hapus.php?id=<?php echo $b['id']; ?>" class="btn btn-danger hps">Hapus</a>
			</td>
		</tr>		
		<?php 
	}}else{?>
<table class="table table-hover">
	<tr>
		<th class="col-md-3">No</th>
		<th class="col-md-3">Nama Menu</th>
		<th class="col-md-3">Harga Jual</th>
		<th class="col-md-3">Sisa Stok</th>
		<!-- <th class="col-md-1">Sisa</th>		 -->
	</tr>
	<?php 
	if(isset($_GET['cari'])){
		$cari=mysqli_real_escape_string($con,$_GET['cari']);
		$brg=mysqli_query($con,"SELECT * from barang_toko where nama LIKE '%$cari%' OR jumlah LIKE '%$cari'");
	}else{
		$brg=mysqli_query($con,"SELECT * from barang_toko limit $start, $per_hal");
	}
	$no=1;
	while($b=mysqli_fetch_assoc($brg)){
		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['nama'] ?></td>
			<td>Rp.<?php echo number_format($b['harga']) ?>,-</td>
			<td><?php echo $b['jumlah'] ?></td>
		</tr>		
	<?php } }
	   ?>
</table>
<ul class="pagination">			
			<?php 
			for($x=1;$x<=$halaman;$x++){
				?>
				<li><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
				<?php
			}
			?>						
		</ul>
<!-- modal input -->
<?php if($_SESSION['level'] == 'admin'){?>
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Menu Baru</h4>
			</div>
			<div class="modal-body">
				<form action="tmb_brg_act.php" method="post">
					<div class="form-group">
						<label>Nama Menu</label>
						<input name="nama" type="text" class="form-control"  placeholder="Nama Menu .." required>
					</div>
					<div class="form-group">
						<label>Kategori</label>
						<input name="kategori" type="text" class="form-control" placeholder="Kategori Menu .." required>
					</div>
					<div class="form-group">
						<label>Harga Modal</label>
						<input name="modal" type="text" class="form-control" placeholder="Modal per unit" required>
					</div>	
					<div class="form-group">
						<label>Harga Jual</label>
						<input name="harga" type="text" class="form-control" placeholder="Harga Jual per unit" required>
					</div>	
					<div class="form-group">
						<label>Jumlah</label>
						<input name="jumlah" type="text" class="form-control" placeholder="Jumlah" required>
					</div>																	

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
			</form>
		</div>
	</div>
</div>
<!--- Modal Toko -->
<?php }else{ ?>
	<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Stok Menu</h4>
			</div>
			<div class="modal-body">
				<form action="tmb_brg_toko.php" method="post">
				<div class="form-group">
						<label>Tanggal</label>
						<input name="tgltko" type="text" id="tgltko" class="form-control" placeholder="Tanggal" required>
					</div>
					<div class="form-group">
						<label>Nama Menu</label>
						<select name="brtoko" class="form-control" style="margin-right:120px;">
			<option >Pilih Menu</option>
			<?php 
			$pil=mysqli_query($con,"SELECT nama from barang order by id desc");
			while($p=mysqli_fetch_array($pil)){
				?>
				<option><?php echo $p['nama'] ?></option>
				<?php
			}
			?>			
        </select>
						
					</div>		
					<div class="form-group">
						<label>Harga Jual</label>
						<input name="hargatko" type="text" class="form-control" placeholder="Harga Jual per unit" required>
					</div>	
					<div class="form-group">
						<label>Stok</label>
						<input name="jumlahtko" type="text" class="form-control" placeholder="Jumlah" required>
					</div>																	

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>
<script>
 $(document).ready(function(){
   const btn = document.querySelectorAll('.hps');
  btn.forEach(function(r){
r.addEventListener('click',function(por){
  por.preventDefault();
  const href = $(this).attr('href');
  Swal.fire({
  title: 'Apakah Kamu Yakin ?',
  text: "Kamu Akan Kehilangan Data Postingan !!!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ya, Hapus'
}).then((result) => {
  if (result.value) {
      document.location.href=href;
  }
})
})
})
 })
		$(document).ready(function(){
			$("#tgltko").datepicker({dateFormat : 'yy/mm/dd'});							
		});


	</script>


<?php 
include 'footer.php';

?>