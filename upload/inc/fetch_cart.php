<?php


session_start();

$total_price = 0;
$total_item = 0;


$output = '
<div class="table-responsive" id="order_table">
	<table class="table table-bordered table-striped">
		<tr>  
		    <th width="40%">No.</th>  
            <th width="40%">Item</th>  
            <th width="10%">Qty</th>  
            <th width="20%">Price</th>  
            <th width="15%">Sub</th>  
            <th width="5%">Action</th>   	
        </tr>
';
if(!empty($_SESSION["shopping_cart"]))
{
	$order_prefer = 1;
	foreach($_SESSION["shopping_cart"] as $keys => $values)
	{
		$output .= '
		<tr>
		    <td>'.$order_prefer.'.</td>
			<td>'.$values["product_name"].'</td>
			<td>'.$values["product_quantity"].'</td>
			<td align="right" style="color:#09b300;">&euro;'.number_format($values["product_price"], 2).'</td>
			<td align="right" style="color:#09b300;">&euro;'.number_format($values["product_quantity"] * $values["product_price"], 2).'</td>
			<td><button name="delete" class="btn btn-danger btn-xs delete" id="'. $values["product_id"].'"><i class="fas fa-minus-circle"></i></button></td>
		</tr>
		';
		$total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
		$total_item = $total_item + 1;

		$order_prefer++;
	}
	$output .= '
	<tr>  
        <td colspan="5" align="right">Total</td>  
        <td align="right" style="color:#09b300;">&euro;'.number_format($total_price, 2).'</td>  
         
    </tr>
	';


}
else
{
	$output .= '
    <tr>
    	<td colspan="6" align="center">
    		Your Cart is Empty!
    	</td>
    </tr>
    ';
}
$output .= '</table></div>';
$data = array(
	'cart_details'		=>	$output,
	'total_price'		=>	number_format($total_price, 2),
	'total_item'		=>	$total_item
);	

echo json_encode($data);


?>


