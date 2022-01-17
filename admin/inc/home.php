<?php
$stmt = $conn->prepare("SELECT u_id FROM users");
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
	//No reset apply
} else {
	//reset apply

	$stmt = $conn->prepare("SELECT order_id FROM orders");
	$stmt->execute();
	$stmt->store_result();

	if ($stmt->num_rows > 0) {



?> <div class="alert alert-warning" role="alert">

			<form action="inc/curd/delete_sales.php" method="post">
				<i class="fas fa-exclamation-triangle"></i> Warning! Reset has been applied. Please delete the old data in sales tab.
				<input name="truncate_sales" type="hidden" value="1">
				<button class="btn btn-danger btn-sm" onclick="return confirm('Are u sure you want to empty the whole table?')">
					<i class="fas fa-trash-alt"></i> Truncate
				</button>
			</form>
		</div>




<?php
	}
}
$stmt->close();
?>



<div class="notice notice-sm">
	<strong>Date:</strong>
	<?php


	$date = ucwords(strftime("%a %d %B %Y", strtotime(date("d-M-Y"))));
	$time = ucwords(strftime("%X", strtotime(date("h:i:s"))));
	echo $date . ' ' . $time;

	?>
</div>


<div class="notice notice-sm notice-warning">
	<strong>Recent Reset applied on:</strong>
	<?php


	$stmt = $conn->prepare("SELECT ctime FROM reset_counter");
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($ctime);

	if ($stmt->fetch()) {
		$arr = array('ctime' => $ctime);

		if ($arr['ctime'] !== '0') {
			echo  strftime("%a %d %B %Y %X", date(strtotime($arr['ctime'])));
		} else {

			echo "<code>No previous reset found!</code>";
		}
	}


	$stmt->close();



	?>
	</br>
	<small>Note: After apply reset, customer will no longer create temperory account for 5 mins.</small>
</div>

<div class="row">

	<a href="dashboard.php?page=2">
		<div class="col-md-3">
			<div class="notice notice-success">
				<strong><i class="fas fa-cart-plus"></i>
					<?php $stmt = $conn->prepare("SELECT productid FROM product");
					$stmt->execute();
					$stmt->store_result();
					echo  $stmt->num_rows;
					$stmt->close();

					?>

				</strong>Total Products
			</div>
		</div>
	</a>

	<a href="dashboard.php?page=3">
		<div class="col-md-3">
			<div class="notice notice-danger">
				<strong><i class="fas fa-align-justify"></i>
					<?php $stmt = $conn->prepare("SELECT categoryid FROM category");

					$stmt->execute();
					$stmt->store_result();
					echo  $stmt->num_rows;
					$stmt->close();

					?>
				</strong>Total Categories
			</div>
		</div>
	</a>

	<a href="dashboard.php?page=5">
		<div class="col-md-3">
			<div class="notice notice-info">
				<strong><i class="fas fa-chart-line"></i>
					<?php $stmt = $conn->prepare("SELECT purchaseid FROM purchase");

					$stmt->execute();
					$stmt->store_result();
					echo  $stmt->num_rows;
					$stmt->close();

					?>

				</strong>Total Sales
			</div>
		</div>
	</a>


	<div class="col-md-3">
		<div class="notice notice-warning">
			<strong><i class="fas fa-users"></i>
				<?php $stmt = $conn->prepare("SELECT u_id FROM users");

				$stmt->execute();
				$stmt->store_result();
				echo  $stmt->num_rows;
				$stmt->close();

				?>
			</strong>Total Guests
			<small style="float: right;line-height: 1px;color: red;">
				<a href="inc/curd/reset_guest.php?cmd=true" onclick="return confirm('Warning! This will let you delete all data of customers. Use this option only when there is no guest in the Restaurant. ');">RESET</a></small>
		</div>
	</div>


	<div class="col-md-6">
		<div class="notice notice-success">
			<strong><i class="fas fa-rupee-sign"></i>
				<?php
				$stmt = $conn->prepare("SELECT SUM(total_price) from `orders` where `status`=0;");

				$stmt->execute();
				$result = $stmt->get_result();
				$data = $result->fetch_assoc();
				//print_r($data);
				if ($data['SUM(total_price)'] > 0) {
					echo $data['SUM(total_price)'];
				} else {
					echo '0.00';
				}

				$stmt->close();

				?>
			</strong>Total Sales Revenue
		</div>
	</div>
	<hr />
	<div class="col-md-6">
		<div class="notice notice-success">
			<strong><i class="fas fa-rupee-sign"></i>
				<?php
				$timestamp = $current_date . ' 00:00:00';
				$timestamp1 = $current_date . ' 23:59:59';
				//echo $timestamp , $timestamp1;
				$stmt = $conn->prepare("SELECT SUM(total_price) FROM `orders` 
										Where `status`=0
										AND `date` BETWEEN '" . $timestamp . "' AND '" . $timestamp1 . "'");

				$stmt->execute();
				$result = $stmt->get_result();
				$data = $result->fetch_assoc();
				//print_r($data);
				if ($data['SUM(total_price)'] > 0) {
					echo $data['SUM(total_price)'];
				} else {
					echo '0.00';
				}
				$stmt->close();

				?>
			</strong>Today Sales Revenue
		</div>
	</div>
</div>

<!--start-->

<div>
	<?php include('./basic-colm-ajax.php'); ?>
	<!-- //include('./basic-line.php'); ?> -->
	<table>
		<tr>
			<th></th>
			<th></th>
		</tr>
		<tr>
			<td><?php include('./pie-semi-circle.php') ?></td>
			<td style="width: 100%;"><?php include('./pie-chart_1.php') ?></td>
		</tr>
	</table>
	<?php include('./bubblechart.php'); ?>

</div>


<!--end-->