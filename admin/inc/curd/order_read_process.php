<?php
include('../../../inc/config/config.php');

	$p_id= $_POST['purchase_id'];
	$o=array();
	$o=explode("-",$p_id);
	$o_id = $o[0];
	$sql="UPDATE orders SET seen = 1 WHERE order_id=$o_id";
	$conn->query($sql);

	//header('location:../../dashboard.php?page=3');

?>