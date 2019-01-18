<?php
$path .= "/views";
// $file = getcwd()."/404.php";

// $server = $_SERVER;
clearstatcache();
$s = DIRECTORY_SEPARATOR;
// $file = getcwd().$s."404.php";
$file = $path.$s."404.php";
$b = "<br>";

// print_r(posix_getpwuid(fileowner($file)));

// echo filetype(getcwd()."/404.php");

// if(file_exists($file)){
//   echo "yes it does exist";
// }else{
//   echo "no it doesnt : $file";
// }






$ext = (isset($_POST["ext"]) != null)?$_POST["ext"]:0;
$name = (isset($_POST["name"]) != null)?$_POST["name"]:0;
$body = (isset($_POST["body"]) != null)?$_POST["body"]:0;



if($ext && $name && $body){

$file = getcwd()."/files/$name.$ext";

file_put_contents($file,$body);
chmod($file,0775);
  $submit = "created";
}else if(isset($_POST["submit"]) !=null && $ext && $name && $body ){
  $submit = "error";
}else{
  $submit = "";
}


$text = '<?php
$s = "something";
?>
<div> hello world </div>
 <p> this is some text</p>
 <h1> something </h1>';

$php =getcwd()."/files/test.php";

if(file_exists($php)){
  $test = file_get_contents($php);

}else{

  $test = (isset($test) !=null)? $test : $text;

}

?>


<main>
    <section class="container">
      <h2>Creating a file </h2>

    <pre>
      <code class="agate">

         <?php echo htmlspecialchars($test); ?>
      </code>
    </pre>
      <div class="row">

        <form class="w-100" action="/practice" method="post">
          <span id="error"></span>
          <div class="col-md-4 mb-3">
            <label for="">Name:</label>
            <input id="title" class="form-control" type="text" name="name" value="">
          </div>
          <div class="col-md-4 mb-3">
            <label for="">Extension:</label>
            <input id="ext" class="form-control" type="text" name="ext" value="">
          </div>
          <div class="col-md-8 mb-3">
            <label for="">Body:</label>
            <div id="body" >

  <?php echo htmlspecialchars($test); ?>




</div>
            <textarea id="_body" class="d-none" name="body" rows="8" cols="80"></textarea>
          </div>
          <div class="col">
            <input class="btn btn-primary" type="submit" name="submit" value="submit">
          </div>
        </form>
        <p id="summary">

        </p>
      </div>
      <?php





      ?>



    </section>

    <script type="text/javascript">

      (function(){

        let submit = <?php echo json_encode($submit);?> ;

        let title = document.getElementById("title");
        let body = document.getElementById("body");
        let error = document.getElementById("error");
        let $body = document.getElementById("_body");
        let sum = document.getElementById("summary");
        // let editor = ace.edit(body);
        // editor.setTheme("ace/theme/monokai");
        // editor.session.setMode("ace/mode/javascript");
        // editor.setOption("minLines",10);
        var editor = ace.edit(body, {
        theme: "ace/theme/twilight",
        mode: "ace/mode/php",
        autoScrollEditorIntoView: true,
        maxLines: 30,
        minLines: 2
    });

// console.log(editor.session.getTextRange(editor.getSelectionRange()));
let e = editor.getValue();
sum.innerHTML = e;
$body.value = `${e} hello`;
console.log($body.value);
editor.on("change", function(e){
  $body.value = editor.getValue();
})


        if(submit == "error"){

          sum.innerHTML = "there is something wrong" ;

          sum.style.color = "red";
          // console.log(msg)
        }else if(submit == "created"){

          sum.innerHTML = "file has been created" ;

          sum.style.color = "green";

        }



      })()
    </script>

</main>

