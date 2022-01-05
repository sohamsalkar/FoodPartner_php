<?php include('header.php'); ?>
<?php include('mailing_parameters.php'); ?>

<body>

	<div class="container-fluid">

		<div class="row">
			<div class="col-md-12">
				<h3 class="page-header"><i class="fas fa-times-circle text-danger"></i> Error</h3>

				<a href="../index.php" class="btn"><i class="fas fa-arrow-circle-left"></i> Back to home</a>


				<?php

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
							foreach ($_SESSION["shopping_cart"] as $number => $val) {
								// prepare and bind
								$list = $list . $val['product_id'] . "-" . $val['product_quantity'] . ",";
							}
							echo $list;
							if ($stmt = mysqli_query($conn, "INSERT INTO `orders`(`cust_id`, `list`, `date`, `status`, `total_price`) VALUES ($g_code,'$list','',1,2323)")) {

								if ($shown == 0) //show msg only once
								{
									unset($_SESSION['shopping_cart']);
									header('location:../checkout.php?er=false');
									$shown = 1;
								}
								$st->close();
								$stmt->close();
							} else {

								if ($shown == 0) //show msg only once
								{
									echo 'ERROR: while placing your order. Please contact restaurant owner';
									header('location:../checkout.php?er=true?list='+$list);
									$shown = 1;
								}
								$st->close();
								$stmt->close();
							}

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