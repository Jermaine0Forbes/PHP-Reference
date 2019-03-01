<?php

define("file" , $_FILES);
define("post" , $_POST);

function _p($text){
  echo "<p>$text </p>";
}

function is_empty($val){
   $result = (isset(post[$val]) && post[$val] != "")? true:false;
   return $result;
}

function check_all($arr){
   foreach($arr as $key){
     $checked = is_empty($key);
     if(!$checked){
       break;
     }
   }

   return $checked;
}

$submitted = isset(post["submit"]);

if($submitted){


  if(check_all(["username","password"])){
    $sql = new mysqli("localhost","jermaine", "yurizan8","Testing");

    $u = post["username"];
    $p = password_hash(post["password"], PASSWORD_DEFAULT);


    if($sql->connect_error){
      die($sql->connect_error);
    }

    $query =  "insert into passwords (password,username) values (?,?)";

    $state = $sql->prepare($query);
    $state->bind_param("ss",$p,$u);
    $success = $state->execute();

    if($success){
      _p("your username: $u, has been saved");
    }else{
      echo "something went wrong";
    }

    $state->close();

  }else{

    echo "something has not been filled";
  }





}//submitted


 ?>


 <main>
     <section class="container">
       <h2>Storing Password</h2>
       <form class="" action="" method="post">
         <div class="form-group row">
           <label for="">Username</label>
           <input class="form-control col-md-4 ml-4" type="text" name="username" >
         </div>
         <div class="form-group row">
           <label for="">Password</label>
           <input class="form-control col-md-4 ml-4" type="password" name="password" >
         </div>
         <div class="form-group row">
           <input class="btn btn-primary" type="submit" name="submit" value="Submit">
         </div>
       </form>

       <h2>Checking Password</h2>
       <div class="check-form">
         <div class="form-group row">
           <label for="">Username</label>
           <input class="form-control col-md-4 ml-4" type="text" name="username-check" >
         </div>
         <div class="form-group row">
           <label for="">Password</label>
           <input class="form-control col-md-4 ml-4" type="password" name="password-check" >
         </div>
         <button id="check-btn" type="button" name="button">Validate</button>
       </div>

       <p id="result"></p>

     </section>
</main>

<script type="text/javascript">
  (function(){

    const btn = document.querySelector("#check-btn");

    let result = document.getElementById("result"),
    username, password,use,pass, data, url;

    btn.onclick = function(){
       username = document.querySelector("input[name='username-check']");
       password = document.querySelector("input[name='password-check']");
       url = "views/ajax.php";
       // url = "practice.php";

      use = username.value;
      pass = password.value;
      data = {username: use, password:pass};

      // console.log(pass);
      // console.log(data);
      fetch(url,{
        method: "POST",
        body: JSON.stringify(data),
        headers:{"Content-Type": "application/json", 'Accept': 'application/json'}
      })
      .then(response => response.json())
      .then(res =>{
        // console.log(res)
        result.innerHTML = res.status;
      })
      .catch(err =>{
        console.log("error: "+err)
      })

    }//btn.onclick



  })()
</script>
