<div class="alert alert-info" role="alert">
	<i class="fas fa-info-circle"></i> info: This tab helps to see details of the customer just by entering CustomerID into the search bar below.
</div>

<!--start-->
<div class="table-responsive" style="margin-top:10px;border: none;">
	<table id="bill" class="table table-striped table-bordered" style="width:100%">
		<thead>
			<tr>
				<th>CustomerID</th>
				<th>Username</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<!-- <th>Address</th> -->
			</tr>
		</thead>
		<tbody>
			<p id="rep"></p>
			<?php
			$sql = "SELECT * FROM `users`";

			$query = $conn->query($sql);
			while ($row = $query->fetch_array()) {
			?>
				<tr>
					<td>#<?php echo $row['u_id']; ?></td>
					<td><?php echo $row['username']; ?></td>
					<td><?php echo $row['f_name'].' '.$row['l_name']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['phone']; ?></td>
					<!-- <td><?php //echo $row['address']; ?></td> -->
				</tr>
			<?php
			}
			?>


		</tbody>


		<tfoot>
			<tr>
				<th>CustomerID</th>
				<th>Username</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<!-- <th>Address</th> -->
			</tr>
		</tfoot>
	</table>
</div>


<!-- end -->