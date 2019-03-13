<?php

define("file" , $_FILES);
define("post" , $_POST);


/******************************
  HELPER FUNCTIONS
******************************/


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




/******************************
  INSERTING DATA INTO PASSWORDS
******************************/


$submit = isset(post["submit"]);


if($submit){



  $count = count(post["username"]);
  $user_arr = post["username"];
  $pass_arr = post["password"];
  $status = "";

  for($x = 0 ; $x < $count; $x++){

    $user = $sql->escape_string($user_arr[$x]);
    $pass = password_hash($sql->escape_string($pass_arr[$x]), PASSWORD_DEFAULT);

    $stmt = "insert into passwords (username, password) values ('$user', '$pass')";
    $status = $sql->query($stmt);
  }

  if($status){
    echo "data has been stored ".date("m-d-y h:i:s A");

    $sql->close();
  }

  // var_dump(post);
}

/******************************
  UPDATING DATA INTO PASSWORDS
******************************/
$submit = isset(post["edit-submit"]);

if($submit){

  $sql = new mysqli("localhost","jermaine","yurizan8","Testing");

  $users = post["username"];
  $ids = post["id"];
  $pwds = post["password"];
  $count = count($users);

  for($x=0; $x < $count; $x++){
    $query = "update passwords set username='$users[$x]', password='$pwds[$x]' where id=$ids[$x]; \n\n";
    $result = $sql->query($query);
  }

  if($result){
    _p("records have been updated");
  }
}



/******************************
  CREATING TABLE ROWS OF DATA
******************************/

include("components/testing-db.php");

$query = "select id, username, password from passwords;";
$t_rows = "" ;
$stmt = $sql->prepare($query);
$success = $stmt->execute();
$stmt->bind_result($id,$us,$pas);

if($success){
  while($stmt->fetch()){

  $t_rows .= "
      <tr data-id='$id'>
      <td class='id'><span>$id</span> <input class='d-none' type='hidden' name='id[]' value='$id'></td>
      <td class='username'><span>$us</span>  <input class='d-none' type='text' name='username[]' value='$us'></td>
      <td class='password'><span>$pas</span>  <input class='d-none' type='text' name='password[]' value='$pas'></td>
      <td class='position-relative'><button type='button' name='edit-btn'><span class='fa fa-edit'></span> </button>  </td>
    </tr>

    ";
  }

  $sql->close();
}

 ?>


 <main>
     <section class="container">
       <h2>Storing Password</h2>
       <form id="form-insert" class="" action="" method="post">
         <div class="form-group row section">
           <div class="col-md-4">
             <label for="">Username</label>
             <input class="form-control" type="text" name="username[]" >
           </div>
           <div class="col-md-4">
             <label for="">Password</label>
             <input class="form-control" type="text" name="password[]" >
           </div>
           <div class="col-md-4 d-flex align-items-end">
             <button class="btn btn-primary btn-duplicate"type="button" name="button"> <span class="fa fa-plus"></span>  </button>
           </div>

         </div>

         <div class="form-group row">
           <input class="btn btn-primary" type="submit" name="submit" value="Submit">
         </div>
       </form>



       <p id="result"></p>
       <h2>Edit Password</h2>
       <table id="table-edit" class="table">
         <thead>
             <tr>
               <th>Id</th>
               <th>Username</th>
               <th>Password</th>
               <th>Options</th>
             </tr>
         </thead>
         <tbody class="w-100">
           <form class="" action="" method="post">
             <?php echo $t_rows; ?>
             <input type="submit" name="edit-submit" class="btn btn-primary" value="Update">
           </form>

         </tbody>
       </table>

     </section>
</main>

<div id ="edit-menu" class="card card-menu" data-status="off">
 <ul class="list-group list-group-flush">
   <li id="edit-option" class="list-group-item">Edit</li>
   <li id="delete-option" class="list-group-item">Delete</li>
   <li class="list-group-item">Vestibulum at eros</li>
 </ul>
</div>

<script type="text/javascript">
  (function(){

    const result = document.getElementById("result")
    const insert = document.getElementById("form-insert")
    const row = document.querySelector("div.form-group.row.section").cloneNode(true)
    const edit = document.getElementById("table-edit")
    const editMenu = document.getElementById("edit-menu")
    let menuOn = false;

    editMenu.style.display = "none";




    function log(val){
      console.log(val)
    }

        function duplicateRow($){
      var group = ($.className == "btn btn-primary btn-duplicate")?$.parentNode.parentNode:$.parentNode.parentNode.parentNode;
      var copy = group.cloneNode(true);

      // let group = insert;
      // let copy = row;
      group.insertAdjacentElement("afterend", copy);
      // group.insertAdjacentElement("afterend", copy);
      // console.log(copy.children)

    }
    // function menuOn($){
    //   let column = ($.name == "edit-btn")?$.parentNode:$.parentNode.parentNode;
    //
    //   column.innerHTML = editMenu;
    //
    // }



    insert.addEventListener("click",function(e){

      if(e.target.className == "btn btn-primary btn-duplicate" || e.target.className == "fa fa-plus"){
          log("inside")
          // log(e.target)
        duplicateRow(e.target)
      }

    } , true)



    function toggleMenu(status, element){

        menuOn = status;
        let $ = element, url = "./ajax/ajax-delete.php", data = {};
        if(menuOn){

          let offset = element.btn.getBoundingClientRect(),
              left = ((window.pageXOffset + offset.left) - 200 )+"px",
              top = (window.pageYOffset +offset.top)+"px";

          editMenu.style.left = left;
          editMenu.style.top = top ;
          editMenu.style.display = "block";

          if(editMenu.dataset.status == "off" ){
            editMenu.dataset.status == "on";

            editMenu.querySelector("li#edit-option").onclick = () =>{
              console.log("you clicked on edit button")
              if(element.userClass == "d-none"){
                element.passTd.className = "d-inline-block form-control";
                element.userTd.className = "d-inline-block form-control";
                element.userSpan.className = "d-none";
                element.passSpan.className = "d-none";
              }else{
                element.passTd.className = "d-none form-control";
                element.userTd.className = "d-none form-control";
                element.userSpan.className = "d-inline-block";
                element.passSpan.className = "d-inline-block";
              }

            }
            editMenu.querySelector("li#delete-option").onclick = () =>{
              console.log("you clicked on delete button :"+$.id)
                data = {id:$.id};
              fetch(url,{
                method:"POST",
                body: JSON.stringify(data)
              })
              .then(res => res.json())
              .then(res => {
                if(res.status != "" || res.status != false){
                  result.innerHTML = res.status;
                  $.tr.style.display = "none";
                }else{
                  log(res)
                  // log("something went wrong")
                }
              })

            }// onclick
          }

        }else{
          editMenu.style.display="none";
        }

    }

    function extractProps(e){

      let element = (e.className == "fa fa-edit")? e.parentNode: e,
          id = element.parentNode.parentNode.dataset.id,
          tr = element.parentNode.parentNode,
          tds = Array.from(element.parentNode.parentNode.children),
          object = {};

          object.id = id;
          object.tr = tr;
          object.tds = tds;
          object.btn = element;
          // object.x = element.offsetLeft;
          // object.y = element.offsetTop;

      tds.forEach(function(e){

          switch (e.className) {
            case "username":
              object.userSpan = e.querySelector("span");
              object.userVal = e.querySelector("span").innerHTML;
              object.userClass = e.querySelector("input").className;
              object.userTd = e.querySelector("input");
              break;
            case "password":
            object.passSpan = e.querySelector("span");
            object.passVal = e.querySelector("span").innerHTML;
            object.passClass = e.querySelector("input").className;
            object.passTd = e.querySelector("input");
              break;
            default:

          }

      })

        // console.log(object)
        return object;

    }


    window.addEventListener("click", function(e){

      if(e.target.name == "edit-btn" || e.target.className == "fa fa-edit"){
          // log(e)
        let data = extractProps(e.target);
        log(data)
        toggleMenu(true, data);

         // console.log(e.target.getBoundingClientRect())
         // console.log(editMenu.offsetWidth)
      }else{
        toggleMenu(false)
      }
    })//click


  })()
</script>
