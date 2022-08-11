<?php
 $db = mysqli_connect('localhost', 'root', '') or
        die ('Tidak dapat terhubung. Periksa parameter koneksi Anda.');
        mysqli_select_db($db, 'restobunda' ) or die(mysqli_error($db));
?>