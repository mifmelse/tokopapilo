<style>
  .gg{
    margin-top: 6px;
    width: 777px;
  }
</style>
<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
  $query = 'SELECT ID, t.TYPE
            FROM users u
            JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE ID = '.$_SESSION['MEMBER_ID'].'';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  
  while ($row = mysqli_fetch_assoc($result)) {
            $Aa = $row['TYPE'];
                   
  if ($Aa=='User'){
?>
  <script type="text/javascript">
    //then it will be redirected
    alert("Halaman dibatasi! Anda akan diarahkan ke menu kasir");
    window.location = "pos.php";
  </script>
<?php
  }           
}  
$sql = "SELECT DISTINCT TYPE, TYPE_ID FROM type order by TYPE_ID asc";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");
?>
<script>
window.onload = function() {  

  // ---------------
  // basic usage
  // ---------------
  var $ = new City();
  $.showProvinces("#province");
  $.showCities("#city");

  // ------------------
  // additional methods 
  // -------------------

  // will return all provinces 
  console.log($.getProvinces());
  
  // will return all cities 
  console.log($.getAllCities());
  
  // will return all cities under specific province (e.g Batangas)
  console.log($.getCities("Batangas")); 
  
}
</script>
          <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-danger">Tambah User</h4>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                        <form role="form" method="post" action="us_transac.php?action=add">
                            
                            <div class="form-group">
                              <input class="form-control" placeholder="First Name" name="firstname" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Last Name" name="lastname" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Username" name="username" required>
                            </div>
                            <div class="form-group">
                              <input type="password" class="form-control" placeholder="Password" name="password" required>
                            </div>
                            <!-- <div class="form-group">
                              <input class="form-control" placeholder="Nomor Hp" name="phonenumber" required>
                            </div> -->
                            <hr>
                            <button type="submit" class="btn btn-success "><i class="fa fa-check fa-fw"></i>Simpan</button>
                            <button type="reset" class="btn btn-primary "><i class="fa fa-times fa-fw"></i>Ulang</button>
                            <a href="user.php?action=add" type="button" class="btn btn-danger bg-gradient-white ">Kembali</a>
                        </form>  
                      </div>
            </div>
          </div></center>
        
<?php
include '../includes/footer.php';
?>
