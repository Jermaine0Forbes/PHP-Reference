<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$_REQUEST = json_decode(file_get_contents("php://input"),true);
// $req = $_REQUEST;
define("req",$_REQUEST);

// $json = json_encode(req);

if(isset(req["username"])){

  $sql = new mysqli("localhost","jermaine","yurizan8","Testing");

  if($sql->connect_error){
    die($sql->connect_error);
  }


    $pass = req["password"];
    $user = req['username'];
    $db_pass ="";



  $query = "select password from passwords where username = ? ";
  $state = $sql->prepare($query);
  $state->bind_param("s",$user);
  $success = $state->execute();
  $state->bind_result($p);



  if($success){

      while($state->fetch()){
        $db_pass = $p;
      }

     $match = password_verify($pass, $db_pass);

     if($match){
       $json = json_encode([ "status" => "<span style='color:green; font-weight:bold;'>Your user is in the database : $match </span>"]);
     }else{
       $json = json_encode([ "status" => "<span style='color:red; font-weight:bold;'>Your password does not match</span>"]);
     }



  }else{

    $json = json_encode([ "status" => "<span style='color:red; font-weight:bold;'>Your username does not match</span>"]);
  }


}else{
  $json = json_encode([ "status" => "<span style='color:red; font-weight:bold;'>Please enter a  username</span>"]);
}


echo $json;
