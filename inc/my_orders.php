<?php
include('config/config.php');
?>
<div class="table-responsive" id="orders">
  <table class="table table-bordered table-striped">
    <thead>
      <th width="10%" class="text-center">Sr No. </th>
      <th width="20%" class="text-center">Date</th>
      <th width="10%" class="text-center">Bill Amount</th>
      <th width="20%" class="text-center">Detailed Order</th>
    </thead>
    <tbody>
      <?php
      $user = $_SESSION['CODE'];
      $orderlistquery = mysqli_query($conn, "SELECT * FROM `orders` WHERE cust_id=$user and `status`=0 ORDER BY `date` DESC;");
      //echo print_r($orderlistquery) ;
      $srno=1;
      while ($orderrow = mysqli_fetch_array($orderlistquery)) {
      ?>
      <tr>
        <td class="text-center"><?php echo $srno ?></td>
        <td class="text-center"><?php echo $orderrow['date']; ?></td>
        <td class="text-center"><?php echo $orderrow['total_price']; ?></td>
        <td class="text-center"><a class="my_orderDetail text-decoration-none" data-id=<?php echo $orderrow['order_id'] ?> ><button class="btn btn-success">VIEW</button></a></td>
      </tr>
      <?php
         $srno++;
      }
      ?>

    </tbody>
  </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript" src="ajax/cart.js"></script>
<script type="text/javascript" src="ajax/modal.js"></script>
<!--<script type="text/javascript" src="ajax/cancel_orders.js"></script>-->

<script>
  $(document).ready(function() {
    $('.my_orderDetail').on('click', function(e) {

      var id = $(this).data('id');

      //alert(query);
      $.ajax({
        url: "inc/orderDetails.php",
        method: "POST",
        data: jQuery.param({
          orderId: id
        }),
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        success: function(data) {
          $('#my_orders_result').html(data);
          $('#orders').fadeOut();
        }
      });
      e.preventDefault();
    });

  });
</script>