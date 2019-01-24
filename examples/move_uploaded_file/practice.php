<?php

define("file" , $_FILES);
define("post" , $_POST);

function _p($text){
  echo "<p>$text </p>";
}

$file = (isset($_FILES["file"]) !=null)?file["file"]:null;
$size = (isset(post["size"]) !=null)? post["size"]:null;

// if the submit button was not pressed then the code will not run
if(isset(post["submit"])){


  if($file["name"]){
    // this will spit out the name of file, example: dog.jpg
    $fileName = $file["name"];

    // this return a weird code that is needed to use the move_uploaded_file function
    $tmpName = $file["tmp_name"];

    //the destination that I want the image/file to be placed
    $destination = getcwd()."/files".DIRECTORY_SEPARATOR.$fileName ;

    // you have to use the tmp_name in order for you to upload a file
    $moved = move_uploaded_file($tmpName, $destination);

    
    if($size){
      _p("file size is $size");
    }

    // if move_uploaded_file returns true, then it echo out the message
    if($moved){
        _p("file $fileName has been moved to $destination");
    }else{
      _p("The file was not moved");
    }


  }else{
    echo "nothing";
  }

}

 ?>


 <main>
     <section class="container">
       <h2>Uploading a file </h2>


       <div class="row">

         <form class="w-100" action="/practice" method="post" enctype="multipart/form-data">
           <span id="error"></span>
          <input id="file" type="file" class="col-md-4" name="file" >
          <input id="size" type="hidden" name="size" value="">
          <div class="form-group">
            <input  type="submit" class="col-md-4 btn btn-primary" name="submit" >
          </div>
         </form>

       </div>

     </section>
</main>

<script type="text/javascript">
  (function(){
    const file = document.getElementById("file");
    const error = document.getElementById("error");
    const size = document.getElementById("size");

    file.onchange = function(){
      size.value = (this.files[0].size / 1024).toFixed(2)+" kb";
    }
  })()
</script>

