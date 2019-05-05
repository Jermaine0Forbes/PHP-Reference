<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$_REQUEST = json_decode(file_get_contents("php://input"),true);
define("req",$_REQUEST);
$rows = "something went wrong";
$json = ["booty"];

if( isset(req["location"])){


  try {

    $db = new PDO("mysql:host=localhost;dbname=Testing","username","password");

  } catch (PDOException $e) {
    $message = $e->getMessage();

    _p($message);
  }

  $location = req["location"];
  $rows = "<table class='table' > <tbody>";
  // $query = "SELECT name  FROM locate_peoples  WHERE state LIKE  '%' || :loc ||'%' ";
  $query = "SELECT  id, name , state, city  FROM locate_peoples  WHERE state LIKE  concat('%', :loc, '%') LIMIT 10  ";
  // $query = "SELECT  id, name , state, city  FROM locate_peoples  WHERE state LIKE  concat('%', :loc, '%')   ";

  $state = $db->prepare($query);
  $state->bindValue(":loc", $location);
  $result = $state->execute();
  $state->bindColumn("id", $id);
  $state->bindColumn("name", $name);
  $state->bindColumn("state", $st);
  $state->bindColumn("city", $city);

  if($result){
    while($state->fetch(PDO::FETCH_BOUND)){

    $rows .="
    <tr id='$id'>
      <td>
        $name
      </td>
      <td>
        $st
      </td>
      <td>
        $city
      </td>
    </tr>
    ";
}
  $rows .= "</tbody></table>";

  $json = json_encode(["number" => $state->rowCount(), "table" => $rows]);
   // echo "data has been saved";
 }else{
   $err = $state->errorInfo();
   echo "something went wrong : $err[2]";
 }

 $state->closeCursor();



}else{

  $json = json_encode(["number" => "booty"]);

}


echo $json;
// echo $rows;
