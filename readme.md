
# PHP Reference

this will mainly be a reference on how to OOP in php and other methods that I think
I need to learn how to use

- [php coding style guide][psr]


## Ajax Examples
- [select ajax][ajax-select]
- [how to update data with ajax][update-ajax]
- [how to delete data with ajax][delete-ajax]
- [how to insert data with ajax][insert-ajax]

## Array Functions
- [explode][explode]


## Classes
- [how to autoload classes]
- [how to use traits]

## Date Functions
- [date][date]
- [date_create][date-create]
- [date_format][date-format]

## Design Patterns
- [design reference guide][design-reference]


## Essential Functions
- [isset][isset]
- [empty][empty]
- [var_dump][var-dump]
- [define][define]


## Filesystem
- [how to write data to a file][put-contents]
- [how to create a file][touch]
- [check if file exists][file-exists]
- [how to get a file][get-contents]
- [how to upload a file][upload-file]
- [how to create a cvs file][csv-file]
- [how to get csv data][get-csv]

## MySQLi

- [how to query a database][query-data]
- [how to update multiple rows][update-rows]
- [how to insert data][insert-data]


## Sanitize Forms
- [filter_var][filter-var]

## String Functions
- [trim][trim]
- [implode][implode]

## Regular Expressions
- [preg_match][]

## Security
- [filter_validate_email][filter-validate-email]
- [filter_validate_int][filter-validate-int]
- [filter_validate_float][filter-validate-float]
- [password hashing][pass-hash]
- [password verifying][pass-verify]

## Libraries

- [how to use faker][faker-basic]
- [how to create your own faker provider][faker-provider]

## Namespaces
- [how to use namespace][namespace]

## Settings
- [How to Setup Timezone][php-timezone]

## Suggestions
- [best security practices]
- [how to use .htaccess files]
- [how to create a layout file]

[insert-data]:#how-to-insert-data
[get-csv]:#how-to-get-csv-data
[csv-file]:#how-to-create-a-csv-file
[update-rows]:#how-update-multiple-rows
[pass-verify]:#password-verifying
[pass-hash]:#password-hashing
[upload-file]:#how-to-upload-a-file
[get-contents]:#how-to-get-a-file
[file-exists]:#file_exists
[touch]:#how-to-create-a-file
[put-contents]:#how-to-write-data-to-a-file
[date-format]:#date_format
[date-create]:#date_create
[insert-ajax]:#how-to-insert-data-with-ajax
[delete-ajax]:#how-to-delete-data-with-ajax
[update-ajax]:#how-to-update-data-with-ajax
[ajax-select]:#select-ajax
[date]:#date
[filter-validate-float]:#filter_validate_float
[filter-validate-int]:#filter_validate_int
[filter-validate-email]:#filter_validate_email
[explode]:#explode
[implode]:#implode
[query-data]:#how-to-query-a-database
[define]:#define
[var-dump]:#var_dump
[filter-var]:#filter_var
[trim]:#trim
[empty]:#empty
[isset]:#isset
[php-timezone]:#how-to-setup-timezone-in-php
[faker-provider]:#how-to-create-your-own-faker-provider
[faker-basic]:#how-to-use-faker
[namespace]:#how-to-use-namespaces
[design-reference]:#design-reference-guide
[psr]:#php-coding-style-guide
[home]:#php-reference

---


### how to insert data

<details>
<summary>
View Content
</summary>

**reference**
- [w3schools](https://www.w3schools.com/php/php_mysql_insert.asp)

```

```

</details>


[go back :house:][home]


### how to get csv data

<details>
<summary>
View Content
</summary>

**reference**
- [w3schools](https://www.w3schools.com/php/func_filesystem_fgetcsv.asp)

```php
//retreives the csv file data and assign it the file variable
$file = fopen("contacts.csv","r");

//this will loop until it reaches the end of file
while(! feof($file))
  {
    //this will dump an array of each row
  print_r(fgetcsv($file));
  }

//this will close the connection of the file
fclose($file);
```

</details>


[go back :house:][home]

### how to create a csv file

<details>
<summary>
View Content
</summary>

**reference**
- [w3schools](https://www.w3schools.com/php/func_filesystem_fputcsv.asp)
- [stackoverflow](https://stackoverflow.com/questions/4165195/mysql-query-to-get-column-names)

The main functions you need to worry about is **fopen**, **fputcsv**, and **fclose**
. You also need to get the through mysqli queries. And grabbing the columns from
the query is important.

```php


/*********************************
  GRAB COLUMNS AND ADD TO AN ARRAY
**********************************/

$column = []; $rows = [];

// This includes the mysqli
include("components/testing-db.php");

$query = "SHOW COLUMNS FROM passwords";
$result = $sql->query($query);
if($result){
  while($row = $result->fetch_assoc()){
      $column[] = $row['Field'];
  }



}

/*********************************
  GRAB VALUES AND ADD TO AN ARRAY
*********************************/

if($result){

  $query = "SELECT * FROM passwords";

  $stmt = $sql->prepare($query);
  $stmt->bind_result($id, $us, $pa);
  $rs = $stmt->execute();

  if($rs){
    while($stmt->fetch()){
      $rows[] = [$id,$us,$pa];
    }
  }

  $sql->close();

}



/**********************
  CREATE THE CSV FILE
**********************/
$file = "passwords.csv";

$csv = fopen($file,"w");

fputcsv($csv, $column);

foreach ($rows as $key ) {
  fputcsv($csv, $key);
}

$response = fclose($csv);

/*****************************
  MOVE THE FILE TO CVS FOLDER
******************************/

if($response){

  chmod($file,0775);
  $status = rename($file,"./files/csv/$file");
  if($status){

    echo "csv has been created";
  }else{
    echo "csv has not been moved and is now deleted";
    unlink($file);
  }
}

```

</details>


[go back :house:][home]

### how to update multiple rows

<details>
<summary>
View Content
</summary>

**reference**
- [stackoverflow](https://stackoverflow.com/questions/18929978/how-to-update-multiple-rows-in-php)

```php

$submit = isset(post["edit-submit"]);

if($submit){

  $sql = new mysqli("localhost","username","password","Testing");

  $users = post["username"];
  $ids = post["id"];
  $pwds = post["password"];
  $count = count($users);

  for($x=0; $x < $count; $x++){
    $query = "update passwords set username='$users[$x]', password='$pwds[$x]' where id=$ids[$x]; \n\n";
    $result = $sql->query($query);
  }

  if($result){
    _p("records have been updated");// this just puts the text into a paragraph
  }
}
```

</details>


[go back :house:][home]


### password verifying

<details>
<summary>
View Content
</summary>

**reference**
- [php.net](http://php.net/manual/en/function.password-verify.php)

**syntax**
```
password_verify ( string $password , string $hash ) : bool
```

**ajax.php**
```php
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
```
**index.php**
```html
<main>
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

```

</details>


[go back :house:][home]


### password hashing

<details>
<summary>
View Content
</summary>

**reference**
- [password_hash](http://php.net/manual/en/function.password-hash.php)

**My Definition:** it encrypts a password silly. Make sure you have the second parameter
as `PASSWORD_DEFAULT`

```php
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
    $sql = new mysqli("localhost","username", "password","database");

    $u = post["username"];
    $p = password_hash(post["password"], PASSWORD_DEFAULT);//hashes the password


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
```

</details>


[go back :house:][home]

### how to upload a file

<details>
<summary>
View Content
</summary>

**Important Note:** the move_uploaded_file is the most important function in uploading
a file, the first parameter should be the tmp_name from the file, example: `$_FILES["file"]["tmp_name"]`.
And the second parameter should be the destination where you put the file,
example: `$destination = getcwd()."/files".DIRECTORY_SEPARATOR.$fileName ;`


**PHP code**
```php
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
```
**HTML code**
```html
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
</main
```
**Javascript code**
```js
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
```

</details>


[go back :house:][home]

### how to get a file

<details>
<summary>
View Content
</summary>

**reference**
- (info)[http://php.net/manual/en/function.file-get-contents.php]

This function grabs whatever content from the path you named. That is pretty much
it, make sure you checked if the file exists.

```

<?php
$text = '<?php
$s = "something";
?>
<div> hello world </div>
 <p> this is some text</p>
 <h1> something </h1>';

$php =getcwd()."/files/test.php";

// check if the file even exists
if(file_exists($php)){
  $test = file_get_contents($php);// if it does then it will retreive contents of the file

}else{

  $test =  $text; //this will just add some example code into $test

}
?>
<pre>
<?php echo htmlspecialchars($test)?>
</pre>
```

</details>


[go back :house:][home]

### file_exists

<details>
<summary>
View Content
</summary>

**reference**
- [php.net](http://php.net/manual/en/function.file-exists.php)

**Note:** This function is simple and easily understandable. If you are false reports
that your file does not exist, then it must mean that your directory path to the
file is not accurate. So just make sure that is if you are getting an error

```php
$path = $_SERVER["DOCUMENT_ROOT"];

$file = $path."/404.php";

if(file_exists($file)){
  echo "yes it does exist";
}else{

  echo "no it doesn't";
}


```

</details>


[go back :house:][home]


### how to create a file

<details>
<summary>
View Content
</summary>

- [touch](http://php.net/manual/en/function.touch.php)

**My Definition:** This is exactly the same as linux touch command, you are just doing
it in PHP

```php

$file = getcwd()."myfile.txt";

if(file_exists($file)){
    echo "cool you created a file";

}else{

    touch($file);// this creates the file;
}

```

</details>


[go back :house:][home]


### how to write data to a file

<details>
<summary>
View Content
</summary>

- [file_put_contents](http://php.net/manual/en/function.file-put-contents.php)

**Note:** make sure that your file that you are trying to create is in a folder that
has group owner to be similar to what apache is represented as, usually it is www-data.
I think I explained to badly, basically I wanted to say that you should make sure that
www-data is going to be the group owner of the folder you are going to put it in.

```php

$farm = "data";
$filename = getcwd()."/farmer.json";
$result =file_put_contents($filename,$farm);
chmod($filename,0775);

echo $result // result returns either a 1 for  the file has been successfully created
            // or 0 meaning that the file was not created
```


</details>


[go back :house:][home]


### date_format

<details>
<summary>
View Content
</summary>

**My definition:** date_format is a function that takes two parameters, one is the
datetime object, and the second is how you want to format it. So its like the date function
so I'm going to drop the table in here too

Character|Description|Example
-|-|-
d|Day of the month, 2 digits with leading zeros|01 to 31
D|A textual representation of a day, three letters|Mon through Sun
l|A full textual representation of the day of the week| Sunday through Saturday
n|Numeric representation of a month, without leading zeros|1 through 12
Y|A full numeric representation of a year, 4 digits|1999 or 2003
y|A two digit representation of a year|99 or 03
A|Uppercase Ante meridiem and Post meridiem|AM or PM
i|Minutes with leading zeros|00 to 59
s|Seconds, with leading zeros|	00 through 59
c|ISO 8601 date (added in PHP 5)|2004-02-12T15:19:21+00:00
g|12-hour format of an hour without leading zeros|	1 through 12

```php

echo date_format(date_create(), "Y-m-d h:i:s");



// outputs: 2018-10-05 07:47:20

```

</details>


[go back :house:][home]

### date_create

<details>
<summary>
View Content
</summary>

**My definition:** creates a new instance of a DateTime object

```php


  echo date_format(date_create(), "Y-m-d h:i:s");



// outputs: 2018-10-05 07:47:20
```

</details>


[go back :house:][home]


### how to insert data with ajax

<details>
<summary>
View Content
</summary>


#### practice.php

```php


<main>
    <section class="container">
      <h2>Create an Animal</h2>
      <?php echo date_format(date_create(), "Y-m-d h:i:s"); ?>

      <form  method="POST" class="col-4" >
        <div class="form-group">
          <label for="">Id:</label>
          <input class="form-control id" type="number" min="1" name="id" value="">
        </div>
        <div class="form-group">
          <label for="">Animal:</label>
          <input class="form-control animal" type="text" name="animal" value="">
        </div>
        <div class="form-group">
          <label for="">Sex:</label>
          <select class="form-control" name="sex">
            <option selected value="male">male</option>
            <option value="female">female</option>
          </select>
        </div>

        <input  id="submitBtn" class="btn btn-primary" type="submit" value="submit">
      </form>



      <div id="data-info">

      </div>


    </section>

    <script type="text/javascript">

      (function(){
        var form = document.getElementsByTagName("form")[0],
        id,
        info,
        url,
        info  = $("#data-info");


        form.onsubmit = function(){
           id = document.querySelector("input[name='id']");
           let ani = document.querySelector("input[name='animal']");
          let sex = document.querySelector("select[name='sex']");

           url = "/views/ajax.php";
          let data = {id:id.value, animal: ani.value, sex:sex.value}

          $.ajax({url:url, data:data})
            .done(function(data){
              console.log(data)
               var r = JSON.parse(data);

               if(r.error){
                  info.html(r.error);
               }else{
                   info.html(r.data);
               }

            });

          return false;
        }//onsubmit



      })()
    </script>

</main>

```

#### ajax.php

```php
<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);



if(isset($_REQUEST['id']) && isset($_REQUEST['animal']) && isset($_REQUEST['sex'])){

  $id = $_REQUEST['id'];
  $animal = $_REQUEST['animal'];
  $sex = $_REQUEST['sex'];
  $date = date_format(date_create(), "Y-m-d h:i:s");
  $fid = 1;

  $sql = new mysqli("localhost","username","password","Testing");

  if($sql->connect_error){
    die($sql->connect_error);
  }

  $query = "insert into animals  (id,animal,sex,farmer_id,created_at,updated_at) values  (?,?,?,?,?,?)";

  $state = $sql->prepare($query);
  $state->bind_param("ississ",$id ,$animal, $sex,$fid,$date,$date);
  // $state->bind_result($id, $ani, $sex,$f_id);
  $success = $state->execute();

  if($success){
      $data = "<p style='font-size:1.3em; color:green'>
      $animal with the id of <strong> $id</strong> has been created </p>";

    $json = json_encode(["data" => $data]);

  }else{

    $data = "<p style='font-size:1.3em color:red'> some error occured</p>";
    $json = json_encode(["error" => $data]);
  }
    $state->close();

}else{

  $json = json_encode(["error" => "either the id was not recognized or some other fuck shit happened"]);
}

echo $json;

```

</details>


[go back :house:][home]


### how to delete data with ajax

<details>
<summary>
View Content
</summary>

#### practice.php

```php


<main>
    <section class="container">
      <h2>Delete your data</h2>

      <form  method="POST" class="col-4" action="/practice">
        <label for="">Choose an ID that needs to be deleted:</label>
        <input class="form-control mb-4" type="number" min="1" name="id" value="">
        <input  id="submitBtn" class="btn btn-primary" type="submit" name="" value="submit">
      </form>



      <div id="data-info">

      </div>


    </section>

    <script type="text/javascript">

      (function(){
        var form = document.getElementsByTagName("form")[0],
        id,
        info,
        url,
        info  = $("#data-info");


        form.onsubmit = function(){

           id = document.querySelector("input[type='number']");

           url = "/views/ajax.php";
           data = {id:id.value}
           // console.log(url)
          $.ajax({url:url, data:data})
            .done(function(data){
              // console.log(data);
               var r = JSON.parse(data);

               if(r.error){
                  info.html(r.error);
               }else{
                   info.html(r.data);
               }



            });

          return false;
        }//onsubmit



      })()
    </script>

</main>

```
#### ajax.php

```php
<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);



if(isset($_REQUEST['id']) && filter_var($_REQUEST['id'], FILTER_VALIDATE_INT)){

  $id = $_REQUEST['id'];

  $sql = new mysqli("localhost","username","password","Testing");

  if($sql->connect_error){
    die($sql->connect_error);
  }

  $query = "select id,animal,sex from animals where id = ?";

  $state = $sql->prepare($query);
  $state->bind_param("i",$id);
  $state->bind_result($i, $ani, $sex);
  $success = $state->execute();

  if($success){
    while($state->fetch()){
      $data = "$ani with the id of <strong> $i</strong> is deleted";
    }



    $query = "delete from animals where id = $i";
    $success = $sql->query($query);
      if($success){
        $json = json_encode(["data" => $data]);
      }

  }else{

    $json = json_encode(["error" => "some error happened in mysql"]);
  }
    // $success->free();
    $sql->close();

}else{

  $json = json_encode(["error" => "either the id was not recognized or some other fuck shit happened"]);
}

echo $json;

```

</details>


[go back :house:][home]


### how to update data with ajax

<details>
<summary>
View Content
</summary>

#### practice.php

```php


<main>
    <section class="container">
      <h2>Update your data</h2>

      <form  method="POST" class="col-4" action="/practice">
        <label for="">Choose an ID:</label>
        <input class="form-control mb-4" type="number" min="1" name="id" value="">
        <input  id="submitBtn" class="btn btn-primary" type="submit" name="" value="submit">
      </form>

      <form id="form-2" class="col-4" style="border-top:1px solid #eee; margin-top:2em; padding-top:2em; " method="post">
        <div class="form-group">
          <label for="">ID</label>
          <input type="number" class="form-control" name="id2" value="">
        </div>
        <div class="form-group">
          <label for="">Animal</label>
          <input type="text" class="form-control" name="animal" value="">
        </div>
        <div class="form-group">
          <label for="">Sex</label>
          <input type="text" class="form-control" name="sex" value="">
        </div>
        <input type="submit" class="btn btn-primary" name="" value="update">
      </form>



      <div id="data-info">

      </div>


    </section>

    <script type="text/javascript">

      (function(){
        var form = document.getElementsByTagName("form")[0],
        id,
        info,
        url,
        form2 = $("#form-2"),
        formTwo = document.querySelector("#form-2"),
        info  = $("#data-info");
        let animal = document.querySelector("input[name='animal']");
        let Id = document.querySelector("input[name='id2']");
        let sex = document.querySelector("input[name='sex']");

        form2.hide();

        form.onsubmit = function(){

           id = document.querySelector("input[type='number']");

           url = "/views/ajax.php?id="+id.value;
           console.log(url)
          $.ajax({url:url})
            .done(function(data){
              // console.log(data);
               var r = JSON.parse(data);

               if(r.error){
                  info.html(r.error);
               }else{
                 Id.value = r.id;
                 animal.value = r.animal;
                 sex.value = r.sex;
               }
              // info.html(result.data);

              form2.show();
            });

          return false;
        }//onsubmit


        formTwo.onsubmit = function(){

           // animal = document.querySelector("input[name='animal']").value;
           //  Id = document.querySelector("input[name='id']").value;
           // let sex = document.querySelector("input[name='sex']").value;

           let data = {sex:sex.value, Id:Id.value, animal:animal.value};
           url = "/views/ajax.php";


           $.ajax({url:url, data:data})
           .done(function(response){
             console.log(response)
             let r = JSON.parse(response);

             info.html(r.msg);


           })//ajax

           return false;
        }

      })()
    </script>

</main>

```
#### ajax.php

```php
<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);



if(isset($_REQUEST["Id"])){

  $Id = $_REQUEST["Id"];
  $animal = $_REQUEST["animal"];
  $sex = $_REQUEST["sex"];

}

if(isset($_REQUEST["id"]) && filter_var($_REQUEST["id"], FILTER_VALIDATE_INT) ){


  $id = $_REQUEST["id"];
  $sql = new mysqli("localhost","username","password","Testing");

  if($sql->connect_error){
    die($sql->connect_error);
  }
  $stmt = "select id, animal, sex from animals where id = ?";

   $query = $sql->prepare($stmt);
  $query->bind_param("i", $id);
  $query->bind_result($i, $ani, $sex);
  $success = $query->execute();

if($success){


  while($query->fetch()){
    // $data = "
    //   <h2> Id: $i </h2>
    //   <p> Animal: $ani </p>
    //   <p> Sex: $sex </p>
    // ";

    $data = ["id" => $i , "animal" => $ani, "sex" => $sex];
  }

  $json = json_encode($data);
}else{
   $data =" ERROR: ";

    $json = json_encode(["error" => $data]);
}

  $query->close();

}else if (isset($Id) && isset($animal) && isset($sex)){

  $sql = new mysqli("localhost","username","password","Testing");

  if($sql->connect_error){
    die($sql->connect_error);
  }

  $q = "update animals set animal = ?, sex = ? where id = ?";
  $state = $sql->prepare($q);
  $state->bind_param("ssi", $animal, $sex, $Id );
  $success = $state->execute();
  $sql->close();

  if($success){
    $json = json_encode(["msg" => "your data has been updated"]);
  }else{
    $json = json_encode(["msg" => "something went wrong"]);
  }
}else{

  $data ="SOME FUCK SHIT IS HAPPENING";

  $json = json_encode(["error" => $data]) ;



}

echo $json;

```

</details>


[go back :house:][home]

### select ajax

<details>
<summary>
View Content
</summary>

**practice.php**

```php


<main>
    <section class="container">

      <form  method="POST" class="col-4" action="/practice">
        <label for="">ID:</label>
        <input class="form-control" type="number" min="1" name="id" value="">
        <input  id="submitBtn" class="btn btn-primary" type="submit" name="" value="submit">
      </form>

      <div id="data-info">

      </div>


    </section>

    <script type="text/javascript">

      (function(){
        var form = document.getElementsByTagName("form")[0],
        id,
        info,
        url;




        form.onsubmit = function(){

           id = document.querySelector("input[type='number']");
           info  = $("#data-info");
           url = "/views/ajax.php?id="+id.value;
           console.log(url)
          $.ajax({url:url})
            .done(function(data){
              // console.log(data);
               var result = JSON.parse(data);
               // var result = data;
               console.log(result);
              info.html(result.data);
            });

          return false;
        }//onsubmit


      })()
    </script>

</main>

```

**ajax.php**

```php
<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


$id = $_REQUEST["id"];
if(isset($id) && filter_var($id, FILTER_VALIDATE_INT) ){

  $sql = new mysqli("localhost","jermaine","yurizan8","Testing");

  if($sql->connect_error){
    die($sql->connect_error);
  }
  $stmt = "select id, animal, sex from animals where id = ?";

   $query = $sql->prepare($stmt);
  $query->bind_param("i", $id);
  $query->bind_result($i, $ani, $sex);
  $success = $query->execute();

if($success){


  while($query->fetch()){
    $data = "
      <h2> Id: $i </h2>
      <p> Animal: $ani </p>
      <p> Sex: $sex </p>
    ";
  }

  $json = json_encode(["data" => $data]);
}else{
   $data =" ERROR: ";

    $json = json_encode(["data" => $data]);
}

  $query->close();

}else{

  $data ="SOME FUCK SHIT IS HAPPENING";

  $json = json_encode(["data" => $data]) ;



}
// header('Content-Type: application/json');


echo $json;

```

</details>


[go back :house:][home]


### date

<details>
<summary>
View Content
</summary>

- [date](http://php.net/manual/en/function.date.php)

Character|Description|Example
-|-|-
d|Day of the month, 2 digits with leading zeros|01 to 31
D|A textual representation of a day, three letters|Mon through Sun
l|A full textual representation of the day of the week| Sunday through Saturday
n|Numeric representation of a month, without leading zeros|1 through 12
Y|A full numeric representation of a year, 4 digits|1999 or 2003
y|A two digit representation of a year|99 or 03
A|Uppercase Ante meridiem and Post meridiem|AM or PM
i|Minutes with leading zeros|00 to 59
s|Seconds, with leading zeros|	00 through 59
c|ISO 8601 date (added in PHP 5)|2004-02-12T15:19:21+00:00
g|12-hour format of an hour without leading zeros|	1 through 12

```php
echo date("g:i:s");
// 4:57:12
```

</details>


[go back :house:][home]

### filter_validate_float

<details>
<summary>
View Content
</summary>

```php
$str = 542.1242234;
$str2 = "12";
$str3 = "234.43";

var_dump(filter_var($str,FILTER_VALIDATE_FLOAT));
echo "<br>";
var_dump(filter_var($str2,FILTER_VALIDATE_FLOAT));
echo "<br>";
var_dump(filter_var($str3,FILTER_VALIDATE_FLOAT));

/* outputs:
float(542.1242234)
float(12)
float(234.43)
*/
```

</details>


[go back :house:][home]


### filter_validate_int

<details>
<summary>
View Content
</summary>

```php
$str = "example@gmail.com";
$str2 = "12";
$str3 = "234.43";

var_dump(filter_var($str,FILTER_VALIDATE_INT));
echo "<br>";
var_dump(filter_var($str2,FILTER_VALIDATE_INT));
echo "<br>";
var_dump(filter_var($str3,FILTER_VALIDATE_INT));

/* outputs:
bool(false)
int(12)
bool(false)

*/
```

</details>


[go back :house:][home]

### filter_validate_email

<details>
<summary>
View Content
</summary>

```php
$str = "example@gmail.com";
$str2 = "jermaine forbes";
$str3 = "jermainegmail@com";

var_dump(filter_var($str,FILTER_VALIDATE_EMAIL));
var_dump(filter_var($str2,FILTER_VALIDATE_EMAIL));
var_dump(filter_var($str3,FILTER_VALIDATE_EMAIL));

```

</details>


[go back :house:][home]

### explode

<details>
<summary>
View Content
</summary>

**references**
- [explode() Function](https://www.w3schools.com/php/func_string_explode.asp)

**My definition:** removes the character from the string and splits the rest into
array

```php
$str = "edgar allen poe";

$r = explode("e",$str);

var_dump($r); //array(4) { [0]=> string(0) "" [1]=> string(8) "dgar all" [2]=> string(4) "n po" [3]=> string(0) "" }

$str = "earth, wind, fire";

$r = explode(",",$str);

var_dump($r); //array(3) { [0]=> string(5) "earth" [1]=> string(5) " wind" [2]=> string(5) " fire" }
```

</details>


[go back :house:][home]

### implode
<details>
<summary>
View Content
</summary>

**references**
- [implode() Function](https://www.w3schools.com/php/func_string_implode.asp)

```php
$arr = ["fish   ","  dog  ","  cat"];

$r = implode(" ",$arr);

var_dump($r);//string(21) "fish dog cat"


$arr2 = ["  fish   ","  dog  ","  cat"];

$a = implode(" *----",$arr2);

var_dump($a);//string(33) " fish *---- dog *---- cat"
```

</details>


[go back :house:][home]

### how to query a database

<details>
<summary>
View Content
</summary>

```php

$sql = new mysqli("localhost","jermaine","yurizan8","Testing");
if($sql->connect_errno){
    echo "Big Error: ".$sql->connect_error;
}

$query = "select * from animals";
$result = $sql->query($query)



             if($result){

               while($row = $result->fetch_assoc()){
                   $id = $row["id"];
                   $animal = $row["animal"];
                   $sex = $row["sex"];
                   $farm = $row["farmer_id"];
                   $create = $row["created_at"];
                   $update = $row["updated_at"];

                     echo "<div><h3>$id: $animal</h3>
                     <ul>
                     <li>sex: $sex</li>
                     <li>farm id: $farm</li>
                     <li>born: $create</li>
                     <li>current date: $update</li>
                     </ul></div>";
                 }

         }


         $result->free();
         $sql->close();



```

</details>


[go back :house:][home]


### define

<details>
<summary>
View Content
</summary>

**reference**
- [define](http://php.net/manual/en/function.define.php)

Constants are much like variables, except for the following differences

```php
define("DOG", "bark!");

echo DOG;//bark!

$d = constant("DOG");

echo "<br> $d";//bark!

```

</details>


[go back :house:][home]

### filter_var

<details>
<summary>
View Content
</summary>

**reference**
- [How to Validate (and Sanitize) User Input In PHP Using Filter_Input() and Filter_Var()](https://www.johnmorrisonline.com/validate-sanitize-user-input-php-using-filter_input-filter_var/)

**My Definition:** filter_var strips out or sanitizes a variable based on the second parameter


  <details>
  <summary>
   FILTER_SANITIZE_STRING
  </summary>

  I think this only strips out tags of the variable

  ```php


  $str = "<h2> hello </h2>";
  $filter  = filter_var($str, FILTER_SANITIZE_STRING);

  var_dump($filter); //string(7) " hello "


  ```

  </details>



  <details>
  <summary>
  FILTER_SANITIZE_FULL_SPECIAL_CHARS
  </summary>

  ```php


  $str = "<h2> hello </h2> ";

  $filter  = filter_var($str, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  var_dump($filter); //string(29) "<h2> hello </h2> "


  ```

  </details>



  <details>
  <summary>
  FILTER_SANITIZE_EMAIL
  </summary>

  Remove all characters except letters, digits and !#$%&'*+-=?^_`{|}~@.[].

  ```php

  $str = "example@gmail.com";

  $filter  = filter_var($str, FILTER_SANITIZE_EMAIL);

  var_dump($filter); //string(17) "example@gmail.com"
  ```

  </details>




</details>


[go back :house:][home]



### var_dump

<details>
<summary>
View Content
</summary>

**reference**
- [var_dump() function](https://www.w3resource.com/php/function-reference/var_dump.php)

**My definition**: Outputs information based on the type of the value and the value itself

```php

$arr = ["   dog", "cat         ", "       fish        "];


foreach( $arr as $a){

  $val = trim($a);
}



var_dump($arr);
// ouputs: array(3) { [0]=> string(6) " dog" [1]=> string(12) "cat " [2]=> string(19) " fish " }
```

</details>


[go back :house:][home]


### trim

<details>
<summary>
View Content
</summary>

**My definition:** trims any extra whitespace from a string

```php
$arr = ["   dog", "cat         ", "       fish        "];


foreach( $arr as $a){

  $val = trim($a);
}



var_dump($arr); //array(3) { [0]=> string(6) " dog" [1]=> string(12) "cat " [2]=> string(19) " fish " }
```

</details>


[go back :house:][home]


### empty

<details>
<summary>
View Content
</summary>

**reference**
- [empty reference](https://www.virendrachandak.com/techtalk/php-isset-vs-empty-vs-is_null/)

**My definition:** returns a **true** boolean value, if the value was 0, or null, or "", array(), or unset

```php

<?php

  $a = 0;

  echo empty($a) ? "true <br>" : "false <br>";//true

  $b = array();
  echo empty($b) ? "true <br>" : "false <br>";//true

  $c = "";
  echo empty($c) ? "true <br>" : "false <br>";//true


  echo empty($d) ? "true <br>" : "false <br>";//true

  $e = -1;
  echo empty($e) ? "true <br>" : "false <br>";//false

 ?>

```

</details>


[go back :house:][home]

### isset

<details>
<summary>
View Content
</summary>

**reference**
- [isset, empty, and is_null](https://www.virendrachandak.com/techtalk/php-isset-vs-empty-vs-is_null/)

**My definition**: isset checks whether or not a value is null or not. This function is best used for $_GET or $_POST type of globals, not variables. If the value is 0 or
an empty string it will still return true

```php
$a = 0;

// it works
echo (isset($a) == true)? "it works <br>" : "is not set <br>" ;

$b = "";

// it works
echo (isset($b) == true)? "it works <br>" : "is not set <br>" ;


// it does not work
echo (isset($c) == true)? "it works <br>" : "is not set <br>" ;

```

</details>


[go back :house:][home]

### how to setup timezone in php

<details>
<summary>
View Content
</summary>

**reference**
- [How to Setup Timezone in php.ini or PHP Script](https://tecadmin.net/setup-timezone-in-php-configuration/)
- [date_default_timezone_get](http://php.net/manual/en/function.date-default-timezone-get.php)

1. go to php.ini with vim

```
sudo vim /etc/php/7.0/apache2/php.ini
```

2. search the date.timezone section with the "?" keyword

```
? date.timezone
```

3. once you to find the section add the appropriate timezone

```
 date.timezone = "America/New_York"
```

4. after you have saved the file, then restart apache

```
sudo service apache2 restart;
```

</details>


[go back :house:][home]



### how to create your own faker provider

<details>
<summary>
View Content
</summary>

:link: **reference**

- [Generating Fake Data in PHP With Faker](http://wern-ancheta.com/blog/2016/01/28/generating-fake-data-in-php-with-faker/)

1. create a seperate class like this

```php
<?php

namespace Faker\Provider;

class Element extends \Faker\Provider\Base {


    protected static $element = ["fire","water","wind","earth"];


    public function element(){
        return static::randomElement(static::$element);
    }


}
```

2. now in your index file, add the class for the provider

```php
<!DOCTYPE html>
<html>

<head>
    <title>PHP Practice</title>
    <meta name="name" content="content">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <header>
        <?php
        require_once 'vendor/autoload.php';
        include "element.php";

        use Faker\Provider\Element;

        $faker = Faker\Factory::create();
        $faker->addProvider(new Element($faker));// add the provider and that is all you got to do

       echo  $faker->element;




		?>

    </header>
    <main>

    </main>
    <footer>

    </footer>
</body>

</html>


```

</details>


[go back :house:][home]



###  how to use faker

<details>
<summary>
View Content
</summary>

:link: **reference**

- [Faker Github](https://github.com/fzaninotto/Faker)

1. install faker with composer

```
composer require fzaninotto/faker

```
2. next in your index.php file require or include the faker autoload file

```php

<!DOCTYPE html>
<html>

<head>
    <title>PHP Practice</title>
    <meta name="name" content="content">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


</head>

<body>
    <header>
        <?php

		// including the file
        require_once 'vendor/autoload.php';




		?>

    </header>
    <main>

    </main>
    <footer>

    </footer>
</body>

</html>

```

3. Now call the create method from the Factory in order to be able to generate
faker data

```php


<!DOCTYPE html>
<html>

<head>
    <title>PHP Practice</title>
    <meta name="name" content="content">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


</head>

<body>
    <header>
        <?php

		// including the file
        require_once 'vendor/autoload.php';

		//initiate faker
        $faker = Faker\Factory::create();

		// Now faker should be able to generate random data
		echo $faker->name;

		?>

    </header>
    <main>

    </main>
    <footer>

    </footer>
</body>

</html>

```

</details>


[go back :house:][home]





### how to use namespaces

<details>
    <summary>
        View Content
    </summary>

**videos**

- [PHP Namespaces Tutorial](https://www.youtube.com/watch?v=t3SvDAoODr8)

So the point of namespaces is to give classes,functions,or constants that might have similar names
a unique identifier with namespaces. This should ultimately avoid name collisions

**Hello.php**

```php
    <?php

    namespace Greeting;

    class Hello{

        public function __construct(){

            echo "hello world";
        }
    }

```



**App.php**

```php
// You need to include the file where the class is, if you don't
// you will get an error
include "Hello.php";

use Greeting\Hello;


new Hello();// this should print out hello world


```

#### If you are using namespaces for functions

**Zelda.php**

```php

<?php

namespace Zelda;

function link(){

echo "I swing swords and solve puzzles";
}

```


**App.php**

```php

include "Zelda.php"

use Zelda;

Zelda\link();// this works

link(); // this will not work

```

</details>

[go back :house:][home]

### design reference guide

<details>
<summary>
View Content
</summary>

**reference**
- [design patterns php](http://designpatternsphp.readthedocs.io/en/latest/)

</details>

[go back :house:][home]

### PHP coding style guide

**reference**
- [psr-2](https://docs.opnsense.org/development/guidelines/psr2.html)
- [psr-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md)

[go back home][home]
