<?php
if (!file_exists('inc/config/db.inc.config.php')) {
  header('location:install/start.php');
  die();
}
?>

<?php include('inc/header.php'); ?>

<body>
  <?php include('inc/navbar.php'); ?>


  <?php

  if (isset($_GET['er'])) {
    if ($_GET['er'] == 'false') {

  ?>
      <div class="jumbotron text-center">

        <div class="row">
          <div class="col-md-12" style="padding: 20px;">
            <a href="index.php" class="btn btn-info"><i class="fas fa-arrow-circle-left"></i> Back</a>
          </div>
        </div>


        <img src="img/foodhand.png" class="img-responsive" style="margin-left: auto;margin-right: auto;width: auto;max-height: 300px; " />
        <h1>Thank you for your order! <br /> <small>Your dish is being prepared.</small></h1>

        <small style="padding:10px;background:#ddd;color:#7f7f7f;border-radius:5px;">User ID <?php echo $_SESSION['CODE']; ?></small>
        <a href="index.php" class="btn btn-success"><i class="fas fa-arrow-circle-left"></i> Back to my orders</a>
      </div>



      <div class="container-fluid">
        <div class="row ">
          <div class="col-md-4"></div>
          <div class="col-md-12">





            <?php
            $order_id = $_SESSION['order_id'];
            $stmt = mysqli_query($conn, "SELECT `list` FROM `orders` WHERE order_id=$order_id;");
            $list = mysqli_fetch_array($stmt);
            if ($list[0] != null) {


            ?>
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
                    $str_arr = preg_split("/[_,\- ]+/", $list[0]); //copy from this
                    //print_r($str_arr);
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
                          <td align="right" class="text-success"><?php echo $pr[$key]*$value; ?></td>
                          <td align="right" class="text-success"><?php echo $pr[$key]; ?></td>  
                        </tr>


                  <?php
                    }

                    echo ' <tr>  
                                                <td colspan="3" align="right"><strong>Total</strong></td>  
                                                    <td align="right" class="text-success">' . $currency . ' ' . $total_price . '</td>  
                                                    
                                                </tr>';
                  } else {
                    echo '<tr>  
                                    <td colspan="4" class="text-danger" > Error -- ss: while fetching Data.</td>  

                                </tr>';
                  }
                  ?>



                  </tbody>
                </table>
              </div>




          </div>

        </div>
      </div>

    <?php
    } else {
    ?>


      <div class="jumbotron text-center">
        <i class="fas fa-times-circle text-danger" style="font-size: 78px;"></i>
        <h1>Transaction fail!</h1>
        <a href="index.php" class="btn btn-success"><i class="fas fa-arrow-circle-left"></i>Terug</a>
      </div>

  <?php
    }
  } ?>



  <?php include "inc/jquery.php"; ?>
  <?php include "inc/checkout_timer.php"; ?>
  <script type="text/javascript">
    // localStorage.removeItem('firstTime');
  </script>


</body>

</html>