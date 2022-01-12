<?php
	include('../../../inc/config/config.php');

	$id = $_POST['del_bill'];
	

	if(isset($id))
	{
		$fetch="DELETE FROM `orders` WHERE order_id='$id'";
		$conn->query($fetch);

		header('location:../../dashboard.php?page=4');
		exit();
	}

	

	

	?>