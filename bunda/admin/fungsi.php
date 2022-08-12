<?php 
require 'config.php';
function ambil(){
    global $con;
    $qry =mysqli_query($con,"SELECT * FROM barang");
    $por = [];
    while($list = mysqli_fetch_assoc($qry)){
        $por[] = $list;
    }
    return $por;
}
function ambil1(){
    global $con;
    $qry =mysqli_query($con,"SELECT * FROM barang_toko");
    $por = [];
    while($list = mysqli_fetch_assoc($qry)){
        $por[] = $list;
    }
    return $por;
}
function ambil2(){
    global $con;
    $qry =mysqli_query($con,"SELECT * FROM trx_toko");
    $por = [];
    while($list = mysqli_fetch_assoc($qry)){
        $por[] = $list;
    }
    return $por;
}
?>