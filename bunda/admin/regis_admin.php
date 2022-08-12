  <?php
require 'config.php';
require 'header.php';
?>
<!doctype html>
<html>
    <?php
function regis($id){
    global $con;
    $username = strtolower( $id["email"]);
    $password = $id["psw"];
    $password1= $id["psw-repeat"];
   mysqli_query($con,"SELECT uname FROM admin where uname='$username'");
    if(mysqli_affected_rows($con)> 0){
        return false;
    }else{
        if($password !== $password1){
            echo"<script>alert('password tidak sesuai');
            </script>"; 
            return false ;  
        }
    }
    $pwd = md5($password);
    mysqli_query($con,"INSERT INTO admin VALUES ('','$username','$pwd','gundar.jpg','admin')");
        return mysqli_affected_rows($con);
    }


//blok    
if(isset($_POST["qq"])){
$rop = regis($_POST);
}
?>
  <head>
    <style>
      * {box-sizing: border-box}

      
/* Add padding to containers */
.container {
  width: 400px;
	border: 1px solid black;
	/*meletakkan form ke tengah*/
	margin: 80px auto;
	padding: 40px 30px;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit/register button */
.registerbtn {
  background-color: #428bca;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity:0.9;
}

.registerbtn:hover {
  opacity:1;
}

/* Add a blue text color to links */
a {
  /* color: dodgerblue; */
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: white;
  text-align: center;
}
      
      </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="../assets/css/p1.css" type="text/css">
    <title>Dapur Bunda Bahagia</title>
  </head>
  <body>
  <?php
global $rop;
if (isset(($_POST["qq"]))){
if ($rop >0 ){
  echo " <script>Swal.fire({
    title: 'Berhasil',
    text: 'Akun Berhasil Dibuat',
    type: 'success',
    showCancelButton: false,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Oke'
  }).then((result) => {
    if (result.value) {
        document.location.href='regis_admin.php';
    }
  })
</script>";
}else{
  echo  "<script>Swal.fire({
    title: 'Gagal',
    text: 'Akun Gagal Dibuat',
    type: 'error',
    showCancelButton: false,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Oke'
  }).then((result) => {
    if (result.value) {
        document.location.href='regis_admin.php';
    }
  })
</script>";

}
}
?>
    <div class="container">
      <div class="row">
      <form action="" method="post">
            <div align="center">
            <h1 >Tambah Admin</h1>
          </div>
            <label for="email"><b>Username</b></label>
            <input type="text" placeholder="Masukan Username" name="email" required>
        
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Masukan Password" name="psw" required>
        
            <label for="psw-repeat"><b>Repeat Password</b></label>
            <input type="password" placeholder="Ulangi Password" name="psw-repeat" required>
            <button type="submit" class="registerbtn" name="qq" >Tambahkan</button>
        </form>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  </body>
</html>