# Autocomplete Search

## Date: 5/5/19

I just created a simple example of how to do ajax request in a search bar that will
pull data with  the help of PDO. I did with regular javascript and the fetch method.
I will eventually do it with jquery


## index.php

```php
<?php



 ?>


 <main>
     <section class="container">

       <h2>Autocomplete</h2>

       <form class="" action="" method="post">
	        <input type="search" name="search" value="">
       </form>

       <div id="result" style='max-width:960px;'>

       </div>

       <div id="user">

       </div>


     </section>
</main>


<script type="text/javascript">
  (function(){


    var inpt = document.querySelector("input[name='search']"),
        url = "views/ajax.php",
        result = document.getElementById("result"),
        user = document.getElementById("user"),
        data = "";

        function show(val,target = result){
          target.innerHTML = val;
        }
        // function show(val,target = "result"){
        //   document.getElementById(target).innerHTML = val;
        // }

        function empty(val){
          if( val == "" || val == undefined)
            return true;

          return false;
        }

    inpt.onkeyup = function(e){
      // console.log(e)
      data = { location : inpt.value};

      if( inpt.value != "" && e.keyCode != 8){
        fetch(url ,{ method:"POST", headers:{"Content-Type":"application/json"}, body : JSON.stringify(data)})
        .then(res => res.json())
        .then (res => {
          // console.log(res)
          let html = ` <p class='text-right'><strong> ${res.number} records have been found </strong></p> ${res.table}`;
           show(html)
           // show(res)
        })
        .catch(err => {
          console.log(err)
          show(err)
        })
      }else{
        console.log("end")
        show("")
      }

    }// onkeyup


    result.onclick = (e) =>{
      // console.log(e.srcElement)
      // console.log(e.target.parentNode)
      console.log(e)
      let target, id, url, data;

    if( e.srcElement.tagName == "TD"){

      target = e.target.parentNode;
      id = target.id;
      data = {id:id};
      url = "ajax/get-user.php";
      target.style.backgroundColor="teal";

      console.log(id)

      fetch(url,{method:"POST", headers:{"Content-Type":"application/json"}, body : JSON.stringify(data)})
      .then(res => res.text())
      .then(res => {
        console.log(res)
        show(res,user)
      })
      .catch(err =>{
        console.log(err)
      })
    }//if statement

    }//onclick


  })()
</script>


```


## get-user.php

```php
<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$_REQUEST = json_decode(file_get_contents("php://input"),true);
define("req",$_REQUEST);
$rows = "something went wrong";

if(isset(req["id"])){
  try {

    $db = new PDO("mysql:host=localhost;dbname=Testing","username","password");

  } catch (PDOException $e) {
    $message = $e->getMessage();

    _p($message);
  }


  $id = req["id"];

  $query = "SELECT name , state, city, address FROM locate_peoples WHERE id = :id";

  $stmt = $db->prepare($query);
  $stmt->bindValue(":id", $id);
  $result = $stmt->execute();
  $stmt->bindColumn("name", $name);
  $stmt->bindColumn("state", $state);
  $stmt->bindColumn("city", $city);
  $stmt->bindColumn("address", $address);

  if($result){
    while($stmt->fetch(PDO::FETCH_BOUND)){
      $rows ="
      <h1>$name</h1>
      <hr>
      <p>State: $state </p>
      <p>City: $city </p>
      <p>Address: $address </p>
      ";
    }
  }

}

echo $rows;


```


## ajax.php

```php

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

```
