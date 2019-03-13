<?php

$input = json_decode(file_get_contents("php://input"),true);
$json = "nothing happened";

if(isset($input)){
  include("../components/testing-db.php");
  $id = $input["id"];
  $query = "delete from passwords where id=?";

  $state = $sql->prepare($query);
  $state->bind_param("i",$id);
  $success = $state->execute();

  if($success){
      $json = json_encode(["status" => "id: $id - has been deleted"]);
  }else{
    $json = json_encode(["status" => false]);
  }
}else{

  $json = json_encode(["status" => false]);
}


echo $json;
