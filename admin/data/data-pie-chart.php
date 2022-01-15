<?php
#Pie Chart
include('../../inc/config/config.php');

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
//print_r($pd);


//$rows = array();
$rows['type'] = 'pie';
$rows['name'] = 'Revenue';
//$rows['innerSize'] = '50%';
foreach($pd as $key=>$value) {
  $rows['data'][] = array($key, $pd[$key]);
}
$reslt = array();
array_push($reslt, $rows);
print json_encode($reslt, JSON_NUMERIC_CHECK);

mysqli_close($conn);
