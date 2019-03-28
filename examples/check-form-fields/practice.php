<?php

define("file" , $_FILES);
define("post" , $_POST);
define("req" , $_REQUEST);


/******************************
  HELPER FUNCTIONS
******************************/


function _p($text){
  echo "<p>$text </p>";
}

function sanitize_all($err,$key, $type){


    // global req;
      $_req = req;
      $val = $_req[$key];
      // echo $_req[$key]."<br>";
    switch ($type) {
      case 'int':

       $_req[$key] = filter_var($val, FILTER_SANITIZE_STRING);
       $result = filter_var($_req[$key], FILTER_VALIDATE_INT);
        break;
      case 'email':
      $_req[$key] = filter_var($val, FILTER_SANITIZE_EMAIL);
      $result = filter_var($_req[$key], FILTER_VALIDATE_EMAIL);
        break;
      case 'float':
      $result = filter_var($_req[$key], FILTER_VALIDATE_FLOAT);
        break;
      case 'strip':
      $_req[$key] = filter_var($val, FILTER_SANITIZE_STRING);
        break;

      default:
        $result = true;
        break;
    }

    if(!$result){
      $err[] = "please enter a better value for ".$key;
    }


  return $err;
}

function not_empty($val){
   $result = (isset(req[$val]) && req[$val] != "")? true:false;
   return $result;
}

function check_all($arr){
  $check_err = [];
   foreach($arr as $key => $val){
     $filled = not_empty($key);
     // _p($key);
     if($filled == false){
        $check_err[] =  $key." is empty please fill in";
     }else{
        $check_err = sanitize_all($check_err, $key, $val);
     }
   }

   return $check_err;
}




/******************************
  INSERTING DATA INTO DATABASE
******************************/


$submitted = isset(req["submit"]);
$fields = [ "username" => "", "password" => "", "email" =>"email" , "amount" => "int"];


if($submitted){

  // var_dump();

  if(empty(check_all($fields))){
     // var_dump(req);
     include("./components/testing-db.php");
     $query = "insert into passwords (username, password, email, amount) values (?,?,?,?)";
     $user = req["username"];
     $pass = password_hash(req["password"], PASSWORD_DEFAULT);
     $email = req["email"];
     $amount = req["amount"];

     $stmt = $sql->prepare($query);
     $stmt->bind_param("sssi",$user,$pass,$email,$amount);
     $result = $stmt->execute();

     if($result){
       _p("Data has been saved!");
     }
  }else{

    $lists = check_all($fields);
    $error_list = "<ul>";

    foreach ($lists as $key ) {
      $error_list .= "<li class=text-danger >$key </li>";
    }

    $error_list .="</ul>";
  }

}


 ?>


 <main>
     <section class="container">

       <?php if (isset($error_list)){
         echo $error_list;
       } ?>

       <form class="" action="" method="post">
         <div class="form-group row flex-column">
           <label for="">Username</label>
           <input  class="form-control col-4" type="text" name="username" value="">
         </div>
         <div class="form-group row flex-column">
           <label for="">Password</label>
           <input  class="form-control col-4" type="text" name="password" value="">
         </div>
         <div class="form-group row flex-column">
           <label for="">Email</label>
           <input  class="form-control col-4" type="email" name="email" value="">
         </div>
         <div class="form-group row flex-column">
           <label for="">Amount</label>
           <input  class="form-control col-4" type="number" name="amount" value="">
         </div>
         <div class="form-group row">
           <input  class="btn btn-primary" type="submit" name="submit" value="Submit">
         </div>
       </form>

     </section>
</main>


<script type="text/javascript">
  (function(){



  })()
</script>
