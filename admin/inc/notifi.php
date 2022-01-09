<?php
include('../../inc/config/config.php');

$sql = "SELECT * FROM `orders` ";
$qry = mysqli_query($conn, $sql);
$ai=0;
while ($ordAr = mysqli_fetch_array($qry)) {
    $list = $ordAr['list'];
    $str_arr = preg_split("/[_,\- ]+/", $list);
    $l = count($str_arr);
    $i = 0;
    while ($i < $l - 1) {
        if ($i % 2 == 0) {
            $ai++;
        }
        $i++;
    }
}
echo $ai;
