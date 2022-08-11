<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
?><?php 

$query = 'SELECT ID, t.TYPE
            FROM users u
            JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE ID = '.$_SESSION['MEMBER_ID'].'';
$result = mysqli_query($db, $query) or die (mysqli_error($db));

while ($row = mysqli_fetch_assoc($result)) {
    $Aa = $row['TYPE'];    
    if ($Aa=='User'){
    
        ?>    
        <script type="text/javascript">
            alert("Halaman dibatasi! Anda akan diarahkan ke menu kasir");
            window.location = "pos.php";
        </script>
        <?php   
    }                           
}

// menangkap data id yang di kirim dari url
$query = 'DELETE FROM customer WHERE CUST_ID = ' . $_GET['id'];
	
// menghapus data dari database
$result = mysqli_query($db, $query) or die(mysqli_error($db));				

// mengalihkan halaman kembali ke index.php
?>
    <script type="text/javascript">alert("Meja Berhasil Dihapus.");window.location = "customer.php";</script>					
<?php
?>