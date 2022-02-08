<div>
    <?php include('../../inc/config/config.php');
    ?>


    <table id="chefdata" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Seen</th>
                <th>CustomerID</th>
                <th>OrderID</th>
                <th>Table No.</th>
                <th>Order</th>
                <th>Date(first ordered)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM orders";

            $query = $conn->query($sql);
            while ($row = $query->fetch_array()) {
            ?>

                <tr id="<?php echo $row['order_id']; ?>" class="<?php echo ($row['chef_seen'] == 1) ? "order_read" : "order_unread"; ?>">

                    <td class="">

                        <img id="img_unread<?php echo $row['order_id']; ?>" <?php echo ($row['chef_seen'] == 1) ? "src='../img/read.png'" : "src='../img/bell.png'"; ?> style="height: 35px;width: 35px;" />

                    </td>
                    <td>#<?php echo $row['cust_id']; ?></td>
                    <td>#<?php echo $row['order_id']; ?></td>
                    <td><?php echo $row['tbl_no']; ?></td>
                    <td>
                        <?php
                        $list1 = $row['list'];
                        $str_arr1 = preg_split("/[_,\- ]+/", $list1);
                        $p = count($str_arr1);
                        $tp = 0;
                        $ii = 0;
                        while ($ii < $p - 1) {
                            if ($ii % 2 == 0) {
                                $stmt2 = $conn->prepare("SELECT productname,price FROM product WHERE productid = $str_arr1[$ii]");
                                $stmt2->execute();
                                $stmt2->store_result();
                                $stmt2->bind_result($productname, $price);
                                $stmt2->fetch();
                                $pid = $str_arr1[$ii];
                                $quantity = $str_arr1[$ii + 1];
                                $subtotal = $price * $quantity;
                                $tp += $price * $quantity;
                        ?>
                                <ul>
                                    <li><?php echo $productname . ' x ' . $quantity; ?></li>
                                    <ul>
                                <?php
                            }
                            $ii++;
                        }
                                ?>
                    </td>
                    <td> <?php echo $row['date']; ?></td>
                    </td>
                    <td>
                        <div class="row" style="max-width: 170px;">
                            <div class="col-md-6">
                                <a id="<?php echo $row['order_id']; ?>" class="btn btn-success btn-sm">
                                    <span class="fas fa-eye"></span> Accept
                                </a>
                            </div>
                            <div class="col-md-2">
                                <a id="<?php echo $row['order_id']; ?>">
                                    <button class="btn btn-danger btn-sm" type='submit' name='sAcc' value=0>Reject</button></a>
                            </div>
                        </div>
                </tr>
            <?php
            }
            ?>

        </tbody>

        <tfoot>
            <tr>
                <th>Seen</th>
                <th>CustomerID</th>
                <th>OrderID</th>
                <th>Table No.</th>
                <th>Order </th>
                <th>Date(first ordered)</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
</div>
