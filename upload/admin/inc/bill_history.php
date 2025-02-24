 <div class="alert alert-info" role="alert">
 	<i class="fas fa-info-circle"></i> info: Bill history tab helps to see bill of the customer just by entering CustomerID into the search bar below.</br>
 	Keep that in mind each row represent a unique table, deleting row might be loosing the data(orders) associated with it.
 </div>



 <div class="table-responsive" style="margin-top:10px;border: none;">
 	<table id="bill" class="table table-striped table-bordered" style="width:100%">
 		<thead>
 			<tr>
 				<th>CustomerID</th>
 				<th>Table No.</th>
 				<th>Total Guests</th>
 				<th>Total Orders</th>
 				<th>Date(first ordered)</th>
 				<th>Action</th>
 			</tr>
 		</thead>
 		<tbody>
 			<p id="rep"></p>
 			<?php
				$sql = "SELECT * FROM orders";

				$query = $conn->query($sql);
				while ($row = $query->fetch_array()) {
				?>
 				<tr>
 					<td>#<?php echo $row['cust_id']; ?></td>
 					<td><?php echo $row['tbl_no']; ?></td>
 					<td>#<?php echo $row['reserve_for']; ?></td>
 					<?php
						$list1 = $row['list'];
						$str_arr1 = preg_split("/[_,\- ]+/", $list1);
						$l1 = count($str_arr1);
						$iii = 0;
						$total = array();
						$c=0;
						while ($iii < $l1 - 1) {
							if ($iii % 2 == 0) {
								if (!(array_search($str_arr1[$iii], $total))){
									$total[$c]=$str_arr1[$iii];
									$c++;
								}
							}
							$iii++;
						}
						$c=count($total);
						?>
 					<td><?php echo $c; ?></td>
 					<td> <?php echo $row['date']; ?></td>
 					<td>


 						<div class="row" style="max-width: 170px;">
 							<div class="col-md-6">
 								<a href="#details<?php echo $row['order_id']; ?>" data-toggle="modal" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-search"></span> view Bill</a>
 								<?php include('inc/bill_modal.php'); ?>
 							</div>
 							<div class="col-md-2">
 								<form action="inc/curd/delete_bill.php" method="post">
 									<input name="del_bill" type="hidden" value="<?php echo $row['order_id']; ?>">
 									<button class="btn btn-danger btn-sm" onclick="return confirm('Are u sure you want to delete this table and all the data associated with it?')">
 										<i class="fas fa-trash-alt"></i>
 									</button>
 								</form>
 							</div>

 						</div>


 					</td>
 				</tr>
 			<?php
				}
				?>
 		</tbody>
 		<tfoot>
 			<tr>
 				<th>CustomerID</th>
 				<th>Table No.</th>
 				<th>Total Guests</th>
 				<th>Total Orders</th>
 				<th>Date(first ordered)</th>
 				<th>Action</th>
 			</tr>
 		</tfoot>
 	</table>
 </div>