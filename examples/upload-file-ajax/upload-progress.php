<?php
define("files",$_FILES);
$fileName = files["file"]["name"];
$tmpName = files["file"]["tmp_name"];
$type = files["file"]["type"];
$size = files["file"]["size"];
$error = files["file"]["error"];
$root = $_SERVER["DOCUMENT_ROOT"];
$destination = $root."/files/$fileName";
// $destination = $root."/filesS/$fileName";
switch ($error) {
  case 1:
    $msg = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
    break;
  case 2:
    $msg = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
  break;
  case 3:
    $msg = "The uploaded file was only partially uploaded.";
    break;
  case 4:
    $msg = "No file was uploaded.";
    break;
  case 6:
  $msg = "Missing a temporary folder.";
    break;
  case 7:
    $msg = "Failed to write file to disk.";
    break;

  default:
      $msg = "A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help";
    break;
}

if(isset($fileName)){

 $result =  move_uploaded_file( $tmpName, $destination);

 if($result){
   echo $fileName." moved to ".$destination;
 }else{

   // var_dump($error);
   echo "file has not been moved, error message - $msg";
 }

}else{

  echo "no file has been chosen";
}
