<?php
//$id = $_GET['id'];
include('../../inc/config/config.php');

$id = $_GET['id'];
//echo '<script>console.log('.$id.');</script>';
$couu = array();
$dayincome = array();
$bln = array();
$bln['name'] = 'Date';
$rows['name'] = 'count';
$rows2['name'] = 'income';
$i = 1;
while ($i <= 31) {
    $couu[$i] = 0;
    $dayincome[$i] = 0;
    $i++;
}
$result123 = mysqli_query($conn, "SELECT * FROM `orders` ");
while ($chrr = mysqli_fetch_array($result123)) {
    $datertime1 = explode(" ", $chrr['date']);
    $date12 = $datertime1[0];
    $darr = explode("-", $date12);
    //$num = intval("10");
    $mon = $darr[1];
    $datee = (int) $darr[2];
    if ($id == $mon) {
        //echo $couu[$datee].'<br>'.'after adding<br>'; 
        $couu[$datee] = $couu[$datee] + 1;
        $dayincome[$datee] = $dayincome[$datee] + $chrr['total_price'];
        //echo $couu[$datee].'<br>'; 
    }
}

$i = 1;
while ($i <= 31) {
    $bln['data'][] = $i;
    $rows['data'][] = $couu[$i];
    $rows2['data'][] = $dayincome[$i];
    $i++;
}



$rslt1 = array();
array_push($rslt1, $bln);
array_push($rslt1, $rows);
array_push($rslt1, $rows2);
print json_encode($rslt1, JSON_NUMERIC_CHECK);

mysqli_close($conn);
