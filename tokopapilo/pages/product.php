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
    alert("masuk ke tampilan menu POS");
    window.location = "pos.php";
  </script>
<?php
  }           
}
$sql = "SELECT DISTINCT CNAME, CATEGORY_ID FROM category order by CNAME asc";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$aaa = "<select class='form-control' name='category' required>
        <option disabled selected hidden>Pilih Kategori</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $aaa .= "<option value='".$row['CATEGORY_ID']."'>".$row['CNAME']."</option>";
  }

$aaa .= "</select>";


?>
            
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-danger text-center">Menu Dapur Bunda&nbsp;<br><br/>
              <a  href="#" data-toggle="modal" data-target="#aModal" type="button" class="btn btn-danger rounded-circle" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
                   <tr class="bg-danger text-white">
                     <th>Id</th>
                     <th>Menu</th>
                     <th>Harga</th>
                     <th>Kategori</th>
                     <th></th>
                   </tr>
               </thead>
          <tbody>

<?php                  
    $query = 'SELECT PRODUCT_ID, PRODUCT_CODE, NAME, PRICE, CNAME FROM product p join category c on p.CATEGORY_ID=c.CATEGORY_ID GROUP BY PRODUCT_CODE';
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
            while ($row = mysqli_fetch_assoc($result)) {
                                 
                echo '<tr>';
                echo '<td>'. $row['PRODUCT_CODE'].'</td>';
                echo '<td>'. $row['NAME'].'</td>';
                echo '<td>$.'. $row['PRICE'].'</td>';
                echo '<td>'. $row['CNAME'].'</td>';
                echo '<td align="right"> <div class="btn-group">
                        <a type="button" class="btn btn-danger btn-block" style="border-radius: 0px; margin: 0px 0px;" href="pro_edit.php?action=edit & id='.$row['PRODUCT_ID']. '">
                          Edit
                        </a>
                        <a type="button" class="btn btn-danger btn-block" style="border-radius: 0px; margin: 0px 10px;" href="pro_del.php?action=delete & id='.$row['PRODUCT_ID']. '">
                          Hapus
                        </a>
                      </td>';
                echo '</tr> ';
                        }
?> 
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>

<?php
include'../includes/footer.php';
?>


  <div class="modal fade" id="aModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Menu Baru</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="pro_transac.php?action=add">
           <div class="form-group">
             <input class="form-control" placeholder="Id Produk" name="prodcode" required>
           </div>
           <div class="form-group">
             <input class="form-control" placeholder="Nama Menu" name="name" required>
           </div>
           <div class="form-group">
             <textarea rows="5" cols="50" texarea" class="form-control" placeholder="Deskripsi" name="description" required></textarea>
           </div>
  
           <div class="form-group">
             <input type="number"  min="1" max="9999999999" class="form-control" placeholder="Harga" name="price" required>
           </div>
           <div class="form-group">
             <?php
               echo $aaa;
             ?>
           </div>

            <hr>
            <button type="submit" class="btn btn-danger"><i class="fa fa-check fa-fw"></i>Simpan</button>
            <!--<button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>-->
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>      
          </form>  
        </div>
      </div>
    </div>
  </div>