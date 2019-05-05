<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$_REQUEST = json_decode(file_get_contents("php://input"),true);
define("req",$_REQUEST);
$rows = "something went wrong";

if(isset(req["id"])){
  try {

    $db = new PDO("mysql:host=localhost;dbname=Testing","username","password");

  } catch (PDOException $e) {
    $message = $e->getMessage();

    _p($message);
  }


  $id = req["id"];

  $query = "SELECT name , state, city, address FROM locate_peoples WHERE id = :id";

  $stmt = $db->prepare($query);
  $stmt->bindValue(":id", $id);
  $result = $stmt->execute();
  $stmt->bindColumn("name", $name);
  $stmt->bindColumn("state", $state);
  $stmt->bindColumn("city", $city);
  $stmt->bindColumn("address", $address);

  if($result){
    while($stmt->fetch(PDO::FETCH_BOUND)){
      $rows ="
      <h1>$name</h1>
      <hr>
      <p>State: $state </p>
      <p>City: $city </p>
      <p>Address: $address </p>
      ";
    }
  }

}

echo $rows;
