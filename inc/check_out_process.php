<?php include('header.php'); ?>
<?php include('mailing_parameters.php'); ?>

<body>

	<div class="container-fluid">

		<div class="row">
			<div class="col-md-12">
				<h3 class="page-header"><i class="fas fa-times-circle text-danger"></i> Error</h3>

				<a href="../index.php" class="btn"><i class="fas fa-arrow-circle-left"></i> Back to home</a>


				<?php
				$table = $_SESSION['tblno'];
				if (isset($_SESSION['order_id'])) {
					$temp_order = $_SESSION['order_id'];
				}
				$reset = $conn->prepare("SELECT guest_code FROM guest WHERE guest_code= ?");
				$reset->bind_param("s", $_COOKIE['CODE']);
				$reset->bind_result($g_code);
				$reset->store_result();
				$reset->execute() or die("Cannot add the date to the database, please try again.");
				if ($reset->fetch()) {

					$res = array('g_code' => $g_code);
					$reset->close(); // closing statement for not to interfair with other statements

					if ($_SESSION['CODE'] == $res['g_code']) {


						if (!empty($_SESSION["shopping_cart"]) && $_SESSION["shopping_cart"] !== '') {
							$shown = 0;
							$order_prefer = 1;

							//include email template parts
							include "src/order_send/part_1.php";
							include "src/order_send/part_2.php";

							$list = "";
							$totalprice = 0;
							foreach ($_SESSION["shopping_cart"] as $number => $val) {
								// prepare and bind
								$list = $list . $val['product_id'] . "-" . $val['product_quantity'] . ",";
								$totalprice += ($val['product_price'] * $val['product_quantity']);
							}
							// echo $list;

							if (($_SESSION['current_order'] == 0)) {
								$mates = $_SESSION['MATES'];
								$stmt = mysqli_query($conn, "INSERT INTO `orders` ( `cust_id`, `list`,`tbl_no`,`reserve_for`, `status`, `total_price`) VALUES ($g_code, '$list', $table,$mates ,1, $totalprice)");
								$oid =  mysqli_query($conn, "SELECT `order_id` from `orders` where `cust_id`=$g_code and `status`= 1");
								$result = mysqli_fetch_array($oid);
								$_SESSION['order_id'] = $result['order_id'];
								echo $_SESSION['order_id'];
								$_SESSION['current_order'] = 1;
								$oid->close();
							} else {
								//echo "inside update";
								$statusCheckQuery = mysqli_query($conn, "SELECT * from `orders` where `order_id`=$_SESSION[order_id]");
								$statusArray = mysqli_fetch_array($statusCheckQuery);
								$status = $statusArray['status'];
								$oid =  mysqli_query($conn, "SELECT `list`,`total_price` from `orders` where `order_id`='" . $_SESSION['order_id'] . "';");
								$result = mysqli_fetch_array($oid);
								$l = $result['list'] . $list;
								$p = $result['total_price'] + $totalprice;
								$stmt = mysqli_query($conn, "UPDATE `orders` SET  `seen`=0, `list`='$l',  `total_price`=$p WHERE `order_id`=$_SESSION[order_id]");
								$oid->close();
							}
							if ($stmt) {

								if ($shown == 0) //show msg only once
								{
									unset($_SESSION['shopping_cart']);
									$custQuery = mysqli_query($conn, "SELECT * FROM `users` where u_id=$g_code");
									$custArray = mysqli_fetch_array($custQuery);
									$data = [
										'phone' => '+91'.$custArray['phone'], // Receivers phone
										'body' => 'Hello, '.$custArray['f_name'].' '.$custArray['l_name']. ' your order no is : ' . $_SESSION['order_id'], // Message
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
									//print_r($result);
									header('location:../checkout.php?er=false');
									$shown = 1;
								}
								// $st->close();
								// $stmt->close();
							} else {
								echo $_SESSION['current_order'];
								echo $_SESSION['order_id'];
								if ($shown == 0) //show msg only once
								{
									echo 'ERROR: while placing your order. Please contact restaurant owner';
									header('location:../checkout.php?er=true?list=' + $list);
									$shown = 1;
								}
								// $st->close();
								// $stmt->close();
							}
							$st->close();
							$stmt->close();

							//include email template parts
							include "src/order_send/part_3.php";


							$status_query = "SELECT * from mailing";
							$sq = $conn->query($status_query);
							$main_result = $sq->fetch_array();

							if ($main_result && $main_result['status'] == 'ON') {
								if (isset($main_result['status']) && $main_result['status'] == 'ON') {

									$mails->msgHTML($body);
									$mails->Subject = 'Incomming order';
									$mails->send(); //echo 'error: ' . $mail->ErrorInfo;

								}
							} else {


								echo '<div class="alert alert-danger" role="alert">
										    No SMPT details found on sever. Double check the SMTP details make sure you added correct details.
										 </div>';

								exit();
							}
						} else {
							echo '<div class="alert alert-danger" role="alert">
								  No orders have been placed - We can only process your order with at least 1 order.
								 </div>';

							exit();
						}
					} else {
						echo '<div class="alert alert-danger" role="alert">
			  Reset has been applied by owner...please book a new table by <a href="distroy_session.php">Clicking here</a>.
			 </div>';

						exit();
					}
				} else {
					$reset->close();

					echo '<div class="alert alert-danger" role="alert">
			  CID not found! Reset has been applied by owner...please book a new table by <a href="distroy_session.php">Clicking here</a>.
			 </div>';

					exit();
				}


				?>

			</div>
		</div>
	</div>

	<?php include "inc/jquery.php"; ?>
	<?php include "inc/checkout_timer.php"; ?>