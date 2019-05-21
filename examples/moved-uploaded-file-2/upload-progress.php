<?php
define("files",$_FILES);
$fileName = files["file"]["name"];
$tmpName = files["file"]["tmp_name"];
$type = files["file"]["type"];
$size = files["file"]["size"];
$root = $_SERVER["DOCUMENT_ROOT"];
$destination = $root."/files/$fileName";

if(isset($fileName)){

 $result =  move_uploaded_file( $tmpName, $destination);

 if($result){
   echo $fileName." moved to ".$destination;
 }else{
   echo "file has not been moved";
 }

}else{

  echo "no file has been chosen";
}

// echo var_dump($_POST);
