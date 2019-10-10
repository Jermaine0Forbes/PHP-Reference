<?php

include_once("./config/bootstrap.php");

$validation = $validator->make($_REQUEST , [
    'customer_id'                 => 'required|email',
    'order_id'              => 'required|numeric',
]);



function getList($orderId){
	global $bigCommerce;
   $order = $bigCommerce->getOrder($orderId);
   $orderProducts = $bigCommerce->getOrderProducts($orderId);
   $index = 0;
   $skus = [];
   $names = [];
   $list = "";

 for( $index; $index < sizeof($orderProducts); $index++){
     $product = $orderProducts[$index];
     $skus[] = $product->sku;
     $names[] = $product->name;
     $list .= "<p><a href='#' class='btn btn-primary'>$product->name </a></p>";
   }

   return $list;

}


$order = new Order();
$orderValid = false;
$resource = Resource::getJson();

if (empty(req) == false && $resource){
  $validation->validate();

  if ($validation->fails()) {
      // handling errors
    $errors = $validation->errors();
    $result = $errors->all("<p class='text-center text-danger'><span class='fas fa-exclamation-circle'><span> :message</p>");
    json(["error" => $result]);

  } else {

    $orderId = req["order_id"];
	$custId = req["customer_id"]
    $orderValid = $order->get($orderId);
      // validation passes
    if($orderValid){
      $sku = $order->checkSku($resource);
	     $cust = $order->checkId($custId);

       Resource::checkIDs($sku, $cust,$orderId);
    }else{
       json(["error" => "<p class='text-center text-danger'><span class='fas fa-exclamation-circle'><span> Cannot find Order ID</p>"]);
    }
  }

}
