<?php
include'../includes/connection.php';

	// menangkap data id yang di kirim dari url
	$query = 'DELETE FROM users WHERE ID = ' . $_GET['id'];
	
	// menghapus data dari database
	$result = mysqli_query($db, $query) or die(mysqli_error($db));				
	
	// mengalihkan halaman kembali ke index.php
	?>
		<script type="text/javascript">alert("Pengguna dihapus.");window.location = "user.php";</script>					
	<?php
?>