<?php
include('config/config.php');
$oid= $_SESSION['order_id'];
$orQuery=mysqli_query($conn,"SELECT * FROM `orders` where order_id=$oid");
$orArray=mysqli_fetch_array($orQuery);
$cid=$orArray['cust_id'];
$custQuery=mysqli_query($conn,"SELECT * FROM `users` where u_id=$cid");
$custArray=mysqli_fetch_array($custQuery);
    include 'instamojo\Instamojo.php';
    $api = new Instamojo\Instamojo('test_5d6a514ab0ee2b4e53cb45b4e80', 'test_94f96d112de917e41855ade502b', 'https://test.instamojo.com/api/1.1/');
    try {
        $response = $api->paymentRequestCreate(array(
            "purpose" =>"Delicious Food from FoodPartner",
            "user_name" => $custArray['username'],
            "email" => $custArray['email'],
            "phone" => $custArray['phone'],
            "amount" => $orArray['total_price'],
            "send_email" => true,
            "allow_repeated_payments" => false,
            "redirect_url" => "http://localhost/foodpartner/inc/thankyou.php"
            ));
       //print_r($response);
        $url=$response['longurl'];
        header("location:$url");
        }
        catch (Exception $e) {
            print('Error: ' . $e->getMessage());
        }
        
        //$pid=$_SESSION['pid'];
        
?>