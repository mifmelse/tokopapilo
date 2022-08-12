<?php 
session_start();
require 'admin/config.php';
$uname=$_POST['uname'];
$pass=$_POST['pass'];
$pas=md5($pass);
$query=mysqli_query($con,"SELECT * FROM admin WHERE uname='$uname' and pass='$pas'");
if(mysqli_num_rows($query)==1) {
	$pol=mysqli_fetch_assoc($query);
	if($pol['level'] == 'admin'){
		$_SESSION['uname']=$uname;
		$_SESSION['level']= $pol['level'];
		header("location:admin/index.php");
	}elseif($pol['level'] == 'kasir'){
		$_SESSION['uname'] =$uname;
		$_SESSION['level'] = $pol['level'];
		header("Location:admin/index.php");
	}
}
else{
	header("location:index.php?pesan=gagal")or die("Opps Something Wrong!!!!");
}

?>