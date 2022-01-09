<?php
include('../../../inc/config/config.php');

	echo $o_id= $_POST['purchase_id'];

	$sql="UPDATE orders SET seen = 1 WHERE order_id= '$0_id'";
	$conn->query($sql);

	//header('location:../../dashboard.php?page=3');

?>