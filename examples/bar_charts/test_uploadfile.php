<?php



$files = $_FILES["upload"]["name"] ?? false;
$data = [];


function p_tag($val,$class = "default"){

  return "<p class="$class">$val</p>";
}

if ($files) {


    // Loop through each file
    for($i=0; $i< count($files); $i++) {
      //Get the temp file path
      $tmpName = $_FILES['upload']['tmp_name'][$i];
      $name = $_FILES['upload']['name'][$i];
      $type = $_FILES['upload']['type'][$i];
      $size = $_FILES['upload']['size'][$i];
      $error = $_FILES['upload']['error'][$i];
      //Check File type
      	if ($error)
          {
        		$data[] = [
              "number" => "File number: ".$i+1,
            "error" =>  "Return Error Code: $error "
          ];
            break;
          }
      	else
          {

            $data[] = [
              "number" => "File number: ".$i+1,
              "name" => "Name: ".$name,
              "tmpName" => "Tmp Name: ".$tmpName,
              "type" => "Type: ".$type,
              "size" => "Size: ".$size." bytes",

            ];

          }// else no error



  }//else validation succeeds






echo json_encode($data);

}//if post & file
else{
  echo json_encode(["status" => "error" , "message" => "Some of the fields have not been filled out"]);
}
