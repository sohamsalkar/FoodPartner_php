<!-- Sales Details -->
<div class="modal fade" id="details<?php echo $row['order_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center>
                    <b>
                        <h2 class="modal-title" id="myModalLabel">Order History for Order No. <?php echo $row['order_id']; ?></h2>
                    </b>
                    <?php
                    if (isset($trArray['p_id']) != "") {
                        //echo '<b style ="text-align:center;display:block;color:green;"><i class="fa fa-check" aria-hidden="true">' . $trArray['p_id'] . '</i> </b>';
                    ?>
                        <img src="../img/paid-5025785_1280.png" height="150px" width="100px">
                    <?php
                        echo '<b style ="text-align:center;display:block;color:green;"><i class="fa fa-check" aria-hidden="true">' . $trArray['p_id'] . '</i> </b>';
                    } else {
                        echo '<b style ="text-align:center;display:block;color:red;"><i class="fas fa-hourglass"> Pending</i></b>';
                    }
                    ?>
                </center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <b>CustomerID:</b> #<?php echo $row['cust_id']; ?>
                        </div>

                        <div class="col-md-6">
                            <span class="pull-right">
                                <?php echo $row['date']; ?>
                            </span>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">

                            <b>Table No :</b> #<?php echo $row['tbl_no']; ?>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">

                            <b>Order No :</b> #<?php echo $row['order_id']; ?>
                        </div>

                    </div>
                    <span><b>Number of Orders:</b> <?php echo ($c >= 40 ? $c . ' ' . "<i class='fas fa-exclamation-triangle text-danger'></i> 
                    <span class='text-danger'>More than 40 orders needs to confirm manually/verbally.</span> " :  $c); ?></span>

                    <div class="table-responsive" style="margin-top:10px;">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>Order Serial</th>
                                <th>Product ID</th>
                                <th>Item</th>
                                <th>Pice</th>
                                <th>Qty</th>
                                <th>Date & Time</th>
                                <th>Sub</th>
                            </thead>
                            <tbody>
                                <?php
                                $total_price = 0;
                                $order_prefer = 1;
                                $oid = $row['order_id'];
                                $sql = "SELECT * from orders where order_id=$oid ";
                                $dquery = $conn->query($sql);
                                $drow = $dquery->fetch_array();
                                $listArray = preg_split("/[_,\- ]+/", $drow['list']);
                                $p = count($listArray);
                                $tp = 0;
                                $ii = 0;
                                while ($ii < $p - 1) {
                                    if ($ii % 2 == 0) {
                                        $stmt2 = $conn->prepare("SELECT productname,price FROM product WHERE productid = $listArray[$ii]");
                                        $stmt2->execute();
                                        $stmt2->store_result();
                                        $stmt2->bind_result($productname, $price);
                                        $stmt2->fetch();
                                        $pid = $listArray[$ii];
                                        $quantity = $listArray[$ii + 1];
                                        $subtotal = $price * $quantity;
                                        $tp += $price * $quantity;
                                ?>
                                        <tr>
                                            <td>
                                                <center><span class="badge badge-secondary text-center" style="background: #65cc0b;"><?php echo $order_prefer; ?></span></center>
                                            </td>
                                            <td>#<?php echo $pid; ?></td>
                                            <td><?php echo $productname; ?></td>
                                            <td class="text-right">&#8377; <?php echo $price; ?></td>
                                            <td><?php echo $quantity; ?></td>
                                            <td> <?php echo $drow['date']; ?></td>
                                            <td class="text-right text-success">&#8377;
                                                <?php echo number_format($subtotal, 2);
                                                ?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                    $ii++;
                                    $order_prefer++;
                                }
                                ?>
                                <tr>
                                    <td colspan="6" class="text-right"><b>Total</b></td>
                                    <td class="text-right  text-success">&#8377; <?php echo number_format($tp, 2); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>