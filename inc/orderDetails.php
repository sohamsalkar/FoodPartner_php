<?php
include('config/config.php');
$order_id = $_POST['orderId'];
$output = '';
//var_dump($_POST);
?>
<div class="col-md-12">
  <h4 class="page-header"><i class="fas fa-utensils"></i>&nbsp; Your Order Details for order no:<?php echo $order_id ?></h4><br />

  <?php
  $stmt = mysqli_query($conn, "SELECT `list` FROM `orders` WHERE order_id=$order_id;");
  $list = mysqli_fetch_array($stmt);
  if ($list[0] != null) {
  ?>
    <!--<h5><a href="#" data-toggle="modal" data-target="#modal_cancel"><i class="fas fa-trash-alt text-danger"></i>Request for order cancellation?</a></h5>-->
    <div class="table-responsive" id="order_table">
      <table class="table table-bordered table-striped">
        <tbody>
          <tr>
            <th width="40%">Item</th>
            <th width="10%">Quantity</th>
            <th width="20%">Price</th>
            <th width="15%">Sub total</th>
          </tr>
          <?php
          $str_arr = preg_split("/[_,\- ]+/", $list[0]);
          //print_r($str_arr);
          $l=count($str_arr);
          $total_price = 0;
          $i = 0;
          while ($i<$l-1) {
            if ($i % 2 == 0) {
              $stmt2 = $conn->prepare("SELECT productname,price FROM product WHERE productid = $str_arr[$i]");
              $stmt2->execute();
              $stmt2->store_result();
              $stmt2->bind_result($productname, $price);
              $stmt2->fetch();
              $quantity = $str_arr[$i+1];
              $total = $price * $quantity;
              $total_price += $price * $quantity;
          ?>

            <tr>
              <td><?php echo $productname ?></td>
              <td><?php echo $quantity; ?></td>
              <td align="right" class="text-success"><?php echo $currency . ' ' . number_format($price, 2); ?></td>
              <td align="right" class="text-success"><?php echo $currency . ' ' . number_format($total, 2); ?></td>
            </tr>
        <?php
            }
            $i++;
          }
          echo ' <tr>  
                                                <td colspan="3" align="right"><strong>Total</strong></td>  
                                                    <td align="right" class="text-success"><strong>' . $currency . ' ' . number_format($total_price, 2) . '</strong></td>  
                                                    
                                                </tr>';
        } else {

          echo '<div class="alert alert-info" role="alert">
                       <i class="fas fa-info-circle" ></i>&nbsp;You have not placed any orders yet.</div>';
        }
        ?>
        </tbody>
      </table>
    </div>
</div>