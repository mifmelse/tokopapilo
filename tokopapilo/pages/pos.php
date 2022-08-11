<?php
include'../includes/connection.php';
include'../includes/topp.php';
$product_ids = array();
if(filter_input(INPUT_POST, 'addpos')){
    if(isset($_SESSION['pointofsale'])){
        $count = count($_SESSION['pointofsale']);
        $product_ids = array_column($_SESSION['pointofsale'], 'id');
        if (!in_array(filter_input(INPUT_GET, 'id'), $product_ids)){
        $_SESSION['pointofsale'][$count] = array
            (
                'id' => filter_input(INPUT_GET, 'id'),
                'name' => filter_input(INPUT_POST, 'name'),
                'price' => filter_input(INPUT_POST, 'price'),
                'quantity' => filter_input(INPUT_POST, 'quantity')
            );   
        }
        else { 
           
            for ($i = 0; $i < count($product_ids); $i++){
                if ($product_ids[$i] == filter_input(INPUT_GET, 'id')){
               $_SESSION['pointofsale'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                }
            }
        }
        
    }
    else { 
        $_SESSION['pointofsale'][0] = array
        (
            'id' => filter_input(INPUT_GET, 'id'),
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'quantity')
        );
    }
}

if(filter_input(INPUT_GET, 'action') == 'delete'){
   foreach($_SESSION['pointofsale'] as $key => $product){
        if ($product['id'] == filter_input(INPUT_GET, 'id')){
          unset($_SESSION['pointofsale'][$key]);
        }
    }
    $_SESSION['pointofsale'] = array_values($_SESSION['pointofsale']);
}
function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
?>
<div class="row">
<p class="text-light"><?php $total = $_POST['total']; ?></p>
<div class="col-lg-12">
  <div class="card shadow mb-0">
    <div class="card-body">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link text-danger font-weight-bold" href="#" data-target="#food" data-toggle="tab">Makanan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger font-weight-bold" href="#" data-target="#ice" data-toggle="tab">Minuman digin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger font-weight-bold" href="#hot" data-toggle="tab">Minuman Panas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger font-weight-bold" href="#snack" data-toggle="tab">Cemilan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger font-weight-bold" href="#appetizer" data-toggle="tab">Appetizer</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger font-weight-bold" href="#combo" data-toggle="tab">Paket Combo</a>
        </li>
      </ul>
    <?php include 'postabpane.php'; ?>
    <div style="clear:both"></div>  
    <br />  
    <div class="card shadow mb-4 col-md-12">
        
    <div class="row">    
    <div class="card-body col-md-7 p-3 p-md-3" id="print">
    <h4 class="m-2 font-weight-bold text-primary">
    <span class ="text-white">Dapur Bunda Bahagia</span></h4>
            <p>
    <div class="row">
      <div class="col-6 col-md-6">
        <a class="text-secondary" href="https://www.google.com">https://www.google.com</a><br/>
        <a class="text-secondary" href="https://www.facebook.com">https://www.facebook.com</a><br/>
        <?php echo "Tanggal : "; 
                  $today = date("Y-m-d H:i a"); 
                  echo $today; 
        ?> 
      </div>
    <div class="col-6 col-md-6">
    WA : +6284433445566 <br/>
    Hubungi : +6284455660322<br/>
  </div>
</div>

          <input type="hidden" name="date" value="<?php echo $today; ?>">
        
          </p>
        <div class="table">
<form role="form" method="post" action="pos_transac.php?action=add">
  <input type="hidden" name="employee" value="<?php echo $_SESSION['FIRST_NAME']; ?>">
  <input type="hidden" name="role" value="<?php echo $_SESSION['JOB_TITLE']; ?>">
  <hr/>
  <h3 class="text-center">Menu Pesanan</h3>
  <hr/>
        <table class="table">    
        <tr class="bg-dark text-white">  
             <th width="45%">Nama Menu</th>  
             <th width="10%">Banyak</th>  
             <th width="20%">Harga</th>  
             <th width="22%">Total</th>  
             <th width="3%"></th>  
        </tr>  
        <?php  

        if(!empty($_SESSION['pointofsale'])):  
            
             $total = 0;  
        
             foreach($_SESSION['pointofsale'] as $key => $product): 
        ?>  
        <tr>  
        
            <td>
            <input type="hidden" name="name[]" value="<?php echo $product['name']; ?>">
            <?php echo $product['name']; ?>
          </td>  

           <td>
            <input type="hidden" name="quantity[]" value="<?php echo $product['quantity']; ?>">
            <?php echo $product['quantity']; ?>
          </td>  

           <td>
            <input type="hidden" name="price[]" value="<?php echo $product['price']; ?>">
            $. <?php echo $product['price']; ?>
          </td>  

           <td>
            <input type="hidden" name="total" value="<?php echo $product['quantity'] * $product['price']; ?>">
            $. <?php echo $product['quantity'] * $product['price']; ?></td>  
           <td>
               <a href="pos.php?action=delete&id=<?php echo $product['id']; ?>">
                    <div class="btn bg-danger btn-danger"><i class="fas fa-fw fa-trash"></i></div>
               </a>
           </td>  
           
        <?php  
                  $total = $total + ($product['quantity'] * $product['price']);
             endforeach;  
        ?>
        <?php  
        endif;
        ?>  
        </table>
        <hr/>
        <h3 class="text-right text-white bg-danger p-3 p-md-3"><strong>
        TOTAL $.
        <?php echo $total; ?>
        </strong></h3>
        <!--
          <input type="button" class="btn btn-primary btn-lg btn-block" value="Receipt Print" onclick="printPage('print');"/>
      -->
         </div>
       </div> 

<?php
include 'posside.php';
include'../includes/footer.php';
?>