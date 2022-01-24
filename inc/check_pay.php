<?php
include('config/config.php');
?>
<div class="row">
  <div class="col-md-12" style="padding: 20px;">
    <a href="index.php"  class="btn btn-info"><i class="fas fa-arrow-circle-left"></i> Back</a>
  </div>
</div>
<div class="col-md-12">
  <!-- <h4 class="page-header"><i class="fas fa-utensils"></i>&nbsp; Your Order Details for order no:<?php //echo $order_id ?></h4><br /> -->

  <?php
  $oid = $_SESSION['order_id'];
  $stmt = mysqli_query($conn, "SELECT `list` FROM `orders` where order_id=$oid and status=1 ");
  $list = mysqli_fetch_array($stmt);
//   print_r($list);
  if ($list[0] != null) {
  ?>

    <!--<h5><a href="#" data-toggle="modal" data-target="#modal_cancel"><i class="fas fa-trash-alt text-danger"></i>Request for order cancellation?</a></h5>-->
    <div class="table-responsive" id="order_table">
      <table class="table table-bordered table-striped">
        <tbody>
          <tr>
            <th width="40%">Item</th>
            <th width="10%">Quantity</th>
            <!-- <th width="20%">Price</th> -->
            <th width="15%">Sub total</th>
            <th width="20%">Price</th>
          </tr>
          <?php
          $str_arr = preg_split("/[_,\- ]+/", $list[0]); //copy from this
          // print_r($str_arr);
          $l = count($str_arr);
          $total_price = 0;
          $i = 0;
          $pd=array();
          $pr=array();
          while ($i < $l - 1) {
            if ($i % 2 == 0) {
              $stmt2 = $conn->prepare("SELECT productname,price FROM product WHERE productid = $str_arr[$i]");
              $stmt2->execute();
              $stmt2->store_result();
              $stmt2->bind_result($productname, $price);
              $stmt2->fetch();
              $quantity = $str_arr[$i + 1];
              $total = $price * $quantity;
              $total_price += $price * $quantity;
              if(array_key_exists($productname,$pd)){
                $q=$pd[$productname];
                $pd[$productname]=$q+$quantity;
              }
              else{
                $pd[$productname]=$quantity;
                $pr[$productname]=$price;
              }
            }
            $i++;
          }
          foreach($pd as $key=>$value){
          ?>

              <tr>
                <td><?php echo $key ?></td>
                <td><?php echo $value; ?></td>
                <td align="right" class="text-success"><?php echo $pr[$key]; ?></td>  
                <td align="right" class="text-success"><?php echo $pr[$key]*$value; ?></td>
                <!-- <td align="right" class="text-success"><?php //echo $currency . ' ' . number_format($price, 2); ?></td>
                <td align="right" class="text-success"><?php //echo $currency . ' ' . number_format($total, 2); ?></td> -->
              </tr>
        <?php
          }
            // }
            // $i++;
          // }
          $gst = ((int)($total_price)*6.5/100);
          echo ' <tr>  
          <td colspan="3" align="right"><strong>GST : 6.5 %</strong></td>  
              <td align="right" class="text-success"><strong>' . $currency . ' ' . $gst . '</strong></td>  
              
          </tr>';
          echo ' <tr>  
                                                <td colspan="3" align="right"><strong>Total</strong></td>  
                                                    <td align="right" class="text-success"><strong>' . $currency . ' ' . ((int)($total_price)+$gst) . '</strong></td>  
                                                    
                                                </tr>';
        } else {

          echo '<div class="alert alert-info" role="alert">
                       <i class="fas fa-info-circle" ></i>&nbsp;You have not placed any orders yet.</div>';
        }
        ?>
        </tbody>
      </table>
    </div>
    <div class="col-md-12">
      <h4 class="page-header">Payment :</h4>

      <!-- <a class="btn btn-success" id="cash" href="" style="margin-right: 10%;">
 			<span class="glyphicon glyphicon-user"></span>
 			Pay in Cash
    </a> -->
 		<a class="btn btn-success" id="online" href="inc/pay.php?oid=<?php echo $_SESSION['order_id'];?>">
 			<span class="glyphicon glyphicon-credit-card"></span>
 			Pay Online
    </a>

  
    </div>
</div>