<?php
include('config/config.php');

$sql = "select * from category order by categoryid asc limit 1";
$fquery = $conn->query($sql);
$ftrow = $fquery->fetch_array();
?>

<div id="<?php echo $ftrow['categoryid']; ?>" class="tab-pane fade in active" style="margin-top:20px;">
	<?php
	// echo 'hey';
	$sql = "select catname from category where categoryid ='".$ftrow['categoryid']."';";
	$fquery = $conn->query($sql);
	$ftrow = $fquery->fetch_array();
	if ($ftrow='Todays Special'){
		$mydate=getdate(date("U"));
		// echo 'hey';
		$sql = "select * from product where special='" . $mydate['weekday'] . "'";
		$pfquery = $conn->query($sql);
		// print_r($pfquery);
	}
	elseif ($ftrow='Recommended'){
		$result = mysqli_query($conn, "SELECT * FROM orders");
		$pd = array();
		while ($orAr = mysqli_fetch_array($result)) {
		  $list = $orAr['list'];
		  $str_arr = preg_split("/[_,\- ]+/", $list);
		  $l = count($str_arr);
		  $i = 0;
		  
		  while ($i < $l - 1) {
			if ($i % 2 == 0) {
			  $stmt2 = $conn->prepare("SELECT productname,price FROM product WHERE productid = $str_arr[$i]");
			  $stmt2->execute();
			  $stmt2->store_result();
			  $stmt2->bind_result($productname, $price);
			  $stmt2->fetch();
			  $quantity = $str_arr[$i + 1];
			  if (array_key_exists($productname, $pd)) {
				$q = $pd[$productname];
				$pd[$productname] = $q + $quantity;
			  } else {
				$pd[$productname] = $quantity;
			  }
			}
			$i++;
		  }
		}	
		print_r($pd);

	}
	else{
	$sql = "select * from product where categoryid='" . $ftrow['categoryid'] . "'";
	$pfquery = $conn->query($sql);
	}
	$inc = 4;
	while ($pfrow = $pfquery->fetch_array()) {
		// print_r($pfrow);
		$inc = ($inc == 4) ? 1 : $inc + 1;
		if ($inc == 1) echo "<div class='row'>";
	?>
		<div class="col-md-3">
			<div class="panel panel-default">

				<div class="panel-body">
					<a href="view.php?p_id=<?php echo $pfrow['productid']; ?>"><img src="<?php if (empty($pfrow['photo'])) {
																								echo "upload/noimage.jpg";
																							} else {
																								echo 'upload/' . $pfrow['photo'];
																							} ?>" height="auto;" width="100%"></a>
				</div>
				<div class="panel-footer text-center">

					<div class="price-wrap h4">
						<span class="price-new">&#8377; <?php echo number_format($pfrow['price'], 2); ?></span>
						<!--<del class="price-old"> &#8377; <?php //echo number_format($pfrow['old_price'], 2); 
															?></del>price-wrap.// -->
					</div>

					<figcaption class="info-wrap">
						<h4 class="title"><?php echo $pfrow['productname']; ?></h4>
						<p class="desc"><?php

										$string = strip_tags($pfrow['description']);
										if (strlen($string) > 50) {

											// truncate string
											$stringCut = substr($string, 0, 50);
											$endPoint = strrpos($stringCut, ' ');

											//if the string doesn't contain any space then it will cut without word basis.
											$string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
											$string .= '... <a href="view.php?p_id=' . $pfrow['productid'] . '">Read More</a>';
										}
										echo $string;



										?></p>


						<div class="bottom-wrap">
							<a href="view.php?p_id=<?php echo $pfrow['productid']; ?>" class="btn btn-sm btn-primary float-right"><i class="fas fa-eye"> </i></a>

							<!--hidden values -->
							<input type="hidden" name="hidden_name" id="name<?php echo $pfrow["productid"]; ?>" value="<?php echo $pfrow["productname"]; ?>" />
							<input type="hidden" name="hidden_price" id="price<?php echo $pfrow["productid"]; ?>" value="<?php echo $pfrow["price"]; ?>" />
							<input type="hidden" value="1" class="form-control" name="quantity" id="quantity<?php echo $pfrow["productid"]; ?>">

							<a type="button" href="#popover_content_wrapper" class="btn btn-success add_to_cart btn-sm" name="add_to_cart" id="<?php echo $pfrow['productid']; ?>">
								<i class="fas fa-plus"></i></a>




						</div> <!-- bottom-wrap.// -->



				</div>


			</div>
		</div>
	<?php
		if ($inc == 4) echo "</div>";
	}
	if ($inc == 1) echo "<div class='col-md-3'></div><div class='col-md-3'></div><div class='col-md-3'></div></div>";
	if ($inc == 2) echo "<div class='col-md-3'></div><div class='col-md-3'></div></div>";
	if ($inc == 3) echo "<div class='col-md-3'></div></div>";
	?>
</div>
<?php

$sql = "select * from category order by categoryid asc";
$tquery = $conn->query($sql);
$tnum = $tquery->num_rows - 1;

$sql = "select * from category order by categoryid asc limit 1, $tnum";
$cquery = $conn->query($sql);
while ($trow = $cquery->fetch_array()) {
?>
	<div id="<?php echo $trow['categoryid']; ?>" class="tab-pane fade" style="margin-top:20px;">
		<?php
		// echo 'hello';
		// print_r ($trow);
		if ($trow['catname']=='Recommended'){
			$result = mysqli_query($conn, "SELECT * FROM orders");
			$pd = array();
			while ($orAr = mysqli_fetch_array($result)) {
			$list = $orAr['list'];
			$str_arr = preg_split("/[_,\- ]+/", $list);
			$l = count($str_arr);
			$i = 0;
			
			while ($i < $l - 1) {
				if ($i % 2 == 0) {
				$stmt2 = $conn->prepare("SELECT productid,price FROM product WHERE productid = $str_arr[$i]");
				$stmt2->execute();
				$stmt2->store_result();
				$stmt2->bind_result($productid, $price);
				$stmt2->fetch();
				$quantity = $str_arr[$i + 1];
				if (array_key_exists($productid, $pd)) {
					$q = $pd[$productid];
					$pd[$productid] = $q + $quantity;
				} else {
					$pd[$productid] = $quantity;
				}
				}
				$i++;
			}
			}	
			arsort($pd);
			$newArray = array_keys($pd);
			// print_r($pd);
			$j=0;
		$inc = 4;
		while ($j<4) {
			// echo $pd[0];
			$sql = "select * from product where productid='" . $newArray[$j] . "'";
			$pquery = $conn->query($sql);
			while ($prow = $pquery->fetch_array()) {
			$inc = ($inc == 4) ? 1 : $inc + 1;
			if ($inc == 1) echo "<div class='row'>";
		?>
			<div class="col-md-3">
				<div class="panel panel-default">

					<div class="panel-body">
						<a href="view.php?p_id=<?php echo $prow['productid']; ?>"><img src="<?php if ($prow['photo'] == '') {
																								echo "upload/noimage.jpg";
																							} else {
																								echo 'upload/' . $prow['photo'];
																							} ?>" height="auto;" width="100%"></a>
					</div>
					<div class="panel-footer text-center">

						<div class="price-wrap h4">
							<span class="price-new">&#8377; <?php echo number_format($prow['price'], 2); ?></span>
							<!--<del class="price-old"> &#8377; <?php //echo number_format($prow['old_price'], 2); 
																?></del>price-wrap.// -->
						</div>

						<figcaption class="info-wrap">
							<h4 class="title"><?php echo $prow['productname']; ?></h4>
							<p class="desc"><?php

											$string = strip_tags($prow['description']);
											if (strlen($string) > 50) {

												// truncate string
												$stringCut = substr($string, 0, 50);
												$endPoint = strrpos($stringCut, ' ');

												//if the string doesn't contain any space then it will cut without word basis.
												$string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
												$string .= '... <a href="view.php?p_id=' . $prow['productid'] . '">Read More</a>';
											}
											echo $string;



											?></p>

						</figcaption>
						<div class="bottom-wrap">
							<a href="view.php?p_id=<?php echo $prow['productid']; ?>" class="btn btn-sm btn-primary float-right"><i class="fas fa-eye"> </i></a>
							<!--hidden values -->
							<input type="hidden" name="hidden_name" id="name<?php echo $prow["productid"]; ?>" value="<?php echo $prow["productname"]; ?>" />
							<input type="hidden" name="hidden_price" id="price<?php echo $prow["productid"]; ?>" value="<?php echo $prow["price"]; ?>" />
							<input type="hidden" value="1" class="form-control" name="quantity" id="quantity<?php echo $prow["productid"]; ?>">

							<a type="button" href="#popover_content_wrapper" class="btn btn-success add_to_cart btn-sm" name="add_to_cart" id="<?php echo $prow['productid']; ?>">
								<i class="fas fa-plus"></i></a>



						</div> <!-- bottom-wrap.// -->
						</figure>
					</div>
				</div>
			</div>
		<?php
			if ($inc == 4) echo "</div>";
			}
				$j+=1;
		}
		if ($inc == 1) echo "<div class='col-md-3'></div><div class='col-md-3'></div><div class='col-md-3'></div></div>";
		if ($inc == 2) echo "<div class='col-md-3'></div><div class='col-md-3'></div></div>";
		if ($inc == 3) echo "<div class='col-md-3'></div></div>";
		?>
	</div>
<?php

		}
		else{
		$sql = "select * from product where categoryid='" . $trow['categoryid'] . "'";
		$pquery = $conn->query($sql);
		// }
		$inc = 4;
		while ($prow = $pquery->fetch_array()) {
			$inc = ($inc == 4) ? 1 : $inc + 1;
			if ($inc == 1) echo "<div class='row'>";
		?>
			<div class="col-md-3">
				<div class="panel panel-default">

					<div class="panel-body">
						<a href="view.php?p_id=<?php echo $prow['productid']; ?>"><img src="<?php if ($prow['photo'] == '') {
																								echo "upload/noimage.jpg";
																							} else {
																								echo 'upload/' . $prow['photo'];
																							} ?>" height="auto;" width="100%"></a>
					</div>
					<div class="panel-footer text-center">

						<div class="price-wrap h4">
							<span class="price-new">&#8377; <?php echo number_format($prow['price'], 2); ?></span>
							<!--<del class="price-old"> &#8377; <?php //echo number_format($prow['old_price'], 2); 
																?></del>price-wrap.// -->
						</div>

						<figcaption class="info-wrap">
							<h4 class="title"><?php echo $prow['productname']; ?></h4>
							<p class="desc"><?php

											$string = strip_tags($prow['description']);
											if (strlen($string) > 50) {

												// truncate string
												$stringCut = substr($string, 0, 50);
												$endPoint = strrpos($stringCut, ' ');

												//if the string doesn't contain any space then it will cut without word basis.
												$string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
												$string .= '... <a href="view.php?p_id=' . $prow['productid'] . '">Read More</a>';
											}
											echo $string;



											?></p>

						</figcaption>
						<div class="bottom-wrap">
							<a href="view.php?p_id=<?php echo $prow['productid']; ?>" class="btn btn-sm btn-primary float-right"><i class="fas fa-eye"> </i></a>
							<!--hidden values -->
							<input type="hidden" name="hidden_name" id="name<?php echo $prow["productid"]; ?>" value="<?php echo $prow["productname"]; ?>" />
							<input type="hidden" name="hidden_price" id="price<?php echo $prow["productid"]; ?>" value="<?php echo $prow["price"]; ?>" />
							<input type="hidden" value="1" class="form-control" name="quantity" id="quantity<?php echo $prow["productid"]; ?>">

							<a type="button" href="#popover_content_wrapper" class="btn btn-success add_to_cart btn-sm" name="add_to_cart" id="<?php echo $prow['productid']; ?>">
								<i class="fas fa-plus"></i></a>



						</div> <!-- bottom-wrap.// -->
						</figure>
					</div>
				</div>
			</div>
		<?php
			if ($inc == 4) echo "</div>";
		}
		if ($inc == 1) echo "<div class='col-md-3'></div><div class='col-md-3'></div><div class='col-md-3'></div></div>";
		if ($inc == 2) echo "<div class='col-md-3'></div><div class='col-md-3'></div></div>";
		if ($inc == 3) echo "<div class='col-md-3'></div></div>";
	}	?>
	</div>
<?php
}
?>
</div>