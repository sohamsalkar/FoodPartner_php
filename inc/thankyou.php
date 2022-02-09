<!DOCTYPE html>
<?php
include('config/config.php');
//include('config/db.inc.config.php');
$pid = $_GET['payment_id'];
$oid = $_SESSION['order_id'];
$orQuery = mysqli_query($conn, "SELECT * FROM `orders` where order_id=$oid");
$orArray = mysqli_fetch_array($orQuery);
$cid = $orArray['cust_id'];
$custQuery = mysqli_query($conn, "SELECT * FROM `users` where u_id=$cid");
$custArray = mysqli_fetch_array($custQuery);
$query = "INSERT INTO `transactions`(`p_id`, `cust_id`, `order_id`, `amount`, `payment_mode`) Values ('$pid',$cid,$oid," . $orArray['total_price'] . ",'creditcard')";
$run = mysqli_query($conn, $query);
$data = [
	'phone' => '+91' . $custArray['phone'], // Receivers phone
	'body' => '```Hello,``` *' . $custArray['f_name'] . ' ' . $custArray['l_name'] . '* ```your payment of``` *Rs. '.$orArray['total_price'].'* ```for order no: ``` *' . $_SESSION['order_id'].'* ```has been received..!!```', // Message
];
$json = json_encode($data); // Encode data to JSON
// URL for request POST /message
$url = 'https://api.chat-api.com/instance399014/message?token=oxljtmb1kd1ukla8';
// Make a POST request
$options = stream_context_create([
	'http' => [
		'method'  => 'POST',
		'header'  => 'Content-type: application/json',
		'content' => $json
	]
]);
// Send a request
$result = file_get_contents($url, false, $options);
if (mysqli_query($conn, "UPDATE `orders` SET  `status`=0 WHERE `order_id`=$oid")) {
	
	unset($_SESSION['order_id']);
	unset($_SESSION['current_order']);
}
?>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>FoodPartner</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="https://img.icons8.com/color/2x/cocktail.png" />
	<script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/0.4.2/sweet-alert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/0.4.2/sweet-alert.css">
</head>

<body class="bg-dark">
	<script>
		swal({
			title: 'Thank you for Your Contribution ...!',
			text: "Lets order something more.?",
			type: "success",
			showCancelButton: true,
			confirmButtonColor: "green",
			confirmButtonText: "Yes.!",
			cancelButtonText: "No.!",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function(isConfirm) {
			if (isConfirm) {
				window.location.href = '../index.php';
			} else {
				window.location.href = '../feedback.php';
			}
		});
	</script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>