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

if (mysqli_query($conn, "UPDATE `orders` SET  `seen`=1, `status`=0 WHERE `order_id`=$oid")) {
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
		sweetAlert({
			title: 'Thank you for Your Contribution ...!',
			text: "Lets order something more..!!",
			showConfirmButton: true,
			showCancelButton: true,
			confirmButtonText: `Yes`,
			cancelButtonText: `No`,
		},function(){
			window.location.href='../index.php';
		}
		);
	</script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>