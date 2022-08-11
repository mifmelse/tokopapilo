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
           
             ?>    <script type="text/javascript">
              
                      alert("dialihkan ke menu kasir");
                      window.location = "pos.php";
                  </script>
             <?php   }
                         
           
}   
            ?>
            
            <div class="card shadow mb-4">
            <div class="card-header py-3 text-center">
              <h4 class="m-2 font-weight-bold text-danger">Daftar Meja&nbsp;
              <br/><a  href="#" data-toggle="modal" data-target="#customerModal" type="button" class="btn btn-danger rounded-circle" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
            </div>
            
            <div class="card-body">
              <div class="table">
                <table class="table" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr class="bg-danger text-white">
                        <th>Nama Meja</th>
                        <th>Lokasi</th>
                        <th>Kapasitas</th>
                        <th>Tindakan</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * FROM customer';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>'. $row['FIRST_NAME'].'</td>';
                      echo '<td>'. $row['LAST_NAME'].'</td>';
                      echo '<td>'. $row['PHONE_NUMBER'].'</td>';
                      echo '<td>
                            <a type="button" class="btn btn-danger" style="border-radius: 0px;" href="cust_edit.php?action=edit & id='.$row['CUST_ID']. '">
                                Edit
                            </a>
                            <a type="button" class="btn btn-danger" style="border-radius: 0px;" href="cust_del.php?action=delete & id='.$row['CUST_ID']. '">
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