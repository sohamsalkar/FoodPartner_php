<?php
include('config/config.php');
?>
<div class="container" id="orders">
  <table>
    <thead>
      <th>Order No. </th>
      <th>Date</th>
      <th>Price</th>
      <th>Action</th>
    </thead>
    <tbody>
      <?php
      $user = $_SESSION['CODE'];
      $orderlistquery = mysqli_query($conn, "SELECT * FROM `orders` WHERE cust_id=$user;");
      //echo print_r($orderlistquery) ;
      while ($orderrow = mysqli_fetch_array($orderlistquery)) {
      ?>
        <td><?php echo $orderrow['order_id']; ?></td>
        <td><?php echo $orderrow['date']; ?></td>
        <td><?php echo $orderrow['total_price']; ?></td>
        <td><a id="my_orderDetail"><button>VIEW</button></a></td>

      <?php
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

<!--google tanslater-->
<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'nl'
    }, 'google_translate_element');
  }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script>
  $(document).ready(function() {
    $('#my_orderDetail').on('click', function(e) {

      //alert(query);
      $.ajax({
        url: "inc/orderDetails.php",
        method: "POST",
        data: jQuery.param({
          orderId: 1
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