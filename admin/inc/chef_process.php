<?php
include('../../inc/config/config.php');


$p_id = $_POST['purchase_id1'];
$st = $_POST['stats'];

$sql = "UPDATE orders SET chef_seen = 1, chef_update=$st WHERE order_id=$p_id";
$conn->query($sql);


//header('location:../../dashboard.php?page=3');

?>
<script>
	console.log("inside chef process<?php echo $p_id; ?>");
</script>