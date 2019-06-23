
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

## Server

- [how to get a root directory][root-dir]

## Filesystem
- [how to write data to a file][put-contents]
- [how to create a file][touch]
- [check if file exists][file-exists]
- [how to get a file][get-contents]
- [how to upload a file][upload-file]
- [how to create a cvs file][csv-file]
- [how to get csv data][get-csv]
- [how to upload a file with ajax][upload-ajax]

## MySQLi

- [how to read data][query-data]
- [how to insert data][insert-data]
- [how to update data][update-data]
- [how to delete data][delete-data]
- [how to update multiple rows][update-rows]
- [how to insert multiple rows][create-rows]
- [how to delete multiple rows][delete-rows]

## PDO

- [how to insert data][pdo-insert]
- [how to read data][pdo-read]
- [how to update data][pdo-update]
- [how to delete data][pdo-delete]
- [how to insert multiple rows][pdo-insert-x]
- [how to update multiple rows][pdo-update-x]
- [how to delete multiple rows][pdo-delete-x]
- [how to get data with like statement][pdo-like]
- [how to bind a number to a prepared  LIMIT statement][pdo-limit]



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
- [how to hash a password][pass-hash]
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

[upload-ajax]:#how-to-upload-a-file-with-ajax
[root-dir]:#how-to-get-a-root-directory
[pdo-limit]:#how-to-bind-a-number-to-a-prepared-limit-statement
[pdo-like]:#how-to-get-data-with-like-statement
[delete-rows]:#how-to-delete-multiple-rows
[create-rows]:#how-to-insert-multiple-rows
[pdo-delete-x]:#how-to-delete-multiple-rows-in-pdo
[pdo-update-x]:#how-to-update-multiple-rows-in-pdo
[pdo-insert-x]:#how-to-insert-multiple-rows-in-pdo
[pdo-delete]:#how-to-delete-pdo-data
[pdo-update]:#how-to-update-pdo-data
[pdo-insert]:#how-to-insert-pdo-data
[pdo-read]:#how-to-read-pdo-data
[delete-data]:#how-to-delete-data
[update-data]:#how-to-update-data
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

### how to upload a file with ajax

<details>
<summary>
View Content
</summary>

Here is one of the ways to upload a file through ajax

**The PHP**

```
<?php
define("files",$_FILES);
$fileName = files["file"]["name"];
$tmpName = files["file"]["tmp_name"];
$type = files["file"]["type"];
$size = files["file"]["size"];
$error = files["file"]["error"];
$root = $_SERVER["DOCUMENT_ROOT"];
$destination = $root."/files/$fileName";


// If an error does occur it will print out the reason why the file
// was not uploaded 
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

```

**The Ajax**

```js
(function(){
   let form = document.getElementById("myForm"),
      data = new FormData(),
      options,
      inpt = document.querySelector("input[name='file']"),
      progress = document.querySelector("progress"),
      status = document.querySelector("p#status"),
       url = "ajax/upload-progress.php";

       function setByte(num, size){
         switch(size){
           case "kb":
            num = num / 1000;
           break;
           case "mb":
           num = (num / 1000)/10;
           break;
           case "gb":
           num = (num / 1000)/100;
           break;
         }
         return num;
       }


   form.onsubmit = function(e){

     $("input[type='submit']").val("uploading")

      e.preventDefault();

      data.append("file", inpt.files[0])


    $.ajax({
      xhr:() => {
        const xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener("progress", (e) =>{
          let loading , total, percent;
          if (e.lengthComputable){
            loading = e.loaded;
            total = e.total;
            percent = (loading / total)*100;
            status.innerHTML = setByte(loading,"kb")+" of "+setByte(total,"kb")+" kilobytes have been loaded"
            progress.value= percent;
          }//lengthComputable
        }, false)//progress event

        xhr.addEventListener("progress", (e) =>{
          let loading , total, percent;
          if (e.lengthComputable){
            loading = e.loaded;
            total = e.total;
            percent = (loading / total)*100;
            status.innerHTML = loading+" of "+total+" bytes have been loaded"
              progress.value= percent;
          }//lengthComputable
        }, false)//progress event

        return xhr;
      },
      type:"POST",
      url: url,
      contentType:false,
      processData:false,
      data:data
    }).done((res) =>{
      console.log(res+" it is done")
    })


   }//onsubmit
})()
```

**The form**

```html
<section class="container">
  <form id="myForm" class="form"  enctype="multipart/form-data" method="post">
   <div class="form-group">
     <input class="form-control col-5"  type="file" name="file" value="">
   </div>
   <input class="btn btn-primary" type="submit" name="" value="submit">
  </form>
  <div class="">
    <progress  value="0" max="100">0%</progress>
    <p id="status"></p>
  </div>
</section>
```

</details>


[go back :house:][home]

### how to get a root directory

<details>
<summary>
View Content
</summary>

**reference**
- [How to get root dir on PHP](https://stackoverflow.com/questions/1427721/how-to-get-root-dir-on-php)

```
$_SERVER['DOCUMENT_ROOT'];
```

</details>


[go back :house:][home]


### how to bind a number to a prepared LIMIT statement

<details>
<summary>
View Content
</summary>

**reference**
- [Binding number to the LIMIT of a PDO query with PHP
](https://stackoverflow.com/questions/17178993/binding-number-to-the-limit-of-a-pdo-query-with-php)
- [LIMIT keyword on MySQL with prepared statement
](https://stackoverflow.com/questions/10014147/limit-keyword-on-mysql-with-prepared-statement)

**Add this before you prepare a statement for limit**
`$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);`


```php

try {

  $db = new PDO("mysql:host=localhost;dbname=Testing","username","password");

} catch (PDOException $e) {
  $message = $e->getMessage();

  $json = json_encode(["error" => $message]);
}

$amount= req["limit"];
$query = "SELECT id , name, city FROM locate_peoples LIMIT :amount";

// This supposed to remove any quotes from an integer/number so it should work now
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$stmt = $db->prepare($query);
$stmt->bindValue(":amount",$amount);
$result = $stmt->execute();
$stmt->bindColumn("id",$id);
$stmt->bindColumn("name",$name);
$stmt->bindColumn("city",$city);
$json = json_encode(["error" => $stmt->errorInfo()[2]]);

if($result){

  while($stmt->fetch(PDO::FETCH_BOUND)){
      $data[] = [
        "id" => $id,
        "name" => $name,
        "city" => $city
      ];
  }


  $json = json_encode($data);
}

  $stmt->closeCursor();


```

</details>


[go back :house:][home]


### how to get data with like statement

<details>
<summary>
View Content
</summary>

**reference**
- [How do I create a PDO parameterized query with a LIKE statement?
](https://stackoverflow.com/questions/583336/how-do-i-create-a-pdo-parameterized-query-with-a-like-statement)

```php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$_REQUEST = json_decode(file_get_contents("php://input"),true);
define("req",$_REQUEST);
$rows = "something went wrong";


if( isset(req["location"])){


  try {

    $db = new PDO("mysql:host=localhost;dbname=Testing","username","password");

  } catch (PDOException $e) {
    $message = $e->getMessage();

    _p($message);
  }

  $location = req["location"];
  $rows = "<table class='table' style='max-width:960px;'> <tbody>";

// using the concat function helps with like statement
  $query = "SELECT name , state, city  FROM locate_peoples  WHERE state LIKE  concat('%', :loc, '%')  ";

  $state = $db->prepare($query);
  $state->bindValue(":loc", $location);
  $result = $state->execute();
  $state->bindColumn("name", $name);
  $state->bindColumn("state", $st);
  $state->bindColumn("city", $city);

  if($result){
    while($state->fetch(PDO::FETCH_BOUND)){

    $rows .="
    <tr>
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
   // echo "data has been saved";
 }else{
   $err = $state->errorInfo();
   echo "something went wrong : $err[2]";
 }

 $state->closeCursor();



}


echo $rows;
```

</details>


[go back :house:][home]

### how to insert multiple rows

<details>
<summary>
View Content
</summary>

#### With the prepared method

```php
$submitted = isset(req["submit"]);

if ($submitted) {

  $mysql = new mysqli("localhost","username","password","Testing");

 if( $mysql->connect_error){
   die($mysql->connect_error);
 }
  $user = req["username"];
  $pass = req["password"];
  $email = req["email"];
  $amount = req["amount"];
  $count = count(req["username"]);
  $result = false;
  $results = 0;



  for ($i=0; $i < $count ; $i++) {
    $u = $mysql->real_escape_string($user[$i]);
    $p = password_hash($mysql->real_escape_string($pass[$i]), PASSWORD_DEFAULT);
    $e = $mysql->real_escape_string($email[$i]);
    $a = $amount[$i];

    $query = "INSERT INTO passwords (username,password,email,amount)  VALUES (?,?,?,?)";
    $stmt = $mysql->prepare($query);
    $stmt->bind_param("sssi",$u,$p,$e,$a);
    $result = $stmt->execute();

    if($result){
      $results++;
    }

  }


  if($result){
    echo $results." rows have been inserted";
  }else{
    echo "something went wrong: $db->errorInfo()[2] ";
  }




}//submitted
```

#### With the mysqli functions

```php
$submitted = isset(req["submit"]);

if ($submitted) {

  $conn = mysqli_connect("localhost","username","password","Testing");

 if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

  $user = req["username"];
  $pass = req["password"];
  $email = req["email"];
  $amount = req["amount"];
  $count = count(req["username"]);
  $rowValues = [];
  $result = false;



  for ($i=0; $i < $count ; $i++) {
    $u = mysqli_real_escape_string($conn, $user[$i]);
    $p = password_hash(mysqli_real_escape_string($conn,$pass[$i]), PASSWORD_DEFAULT);
    $e = mysqli_real_escape_string($conn,$email[$i]);
    $a = $amount[$i];
    $rowValues[] = "('$u','$p','$e',$a)";

  }

  $query = "INSERT INTO passwords (username,password,email,amount)  VALUES ".implode(",",$rowValues);
  $result = mysqli_query($conn,$query);





  if($result){
    echo $count." rows have been inserted";
  }else{
    echo "something went wrong: ".mysqli_error($conn);
  }

  mysqli_close($conn);




}//submitted

```

</details>


[go back :house:][home]


### how to delete multiple rows

<details>
<summary>
View Content
</summary>

#### With the prepare method

```php

$submitted = isset(req["submit"]);

if ($submitted) {

  $mysql= new mysqli("localhost","username","password","Testing");

 if ($mysql->connect_errno)
   {
   echo "Failed to connect to MySQL: " . $mysql->connect_error;
   }

  $id = req["id"];
  $count = count(req["id"]);
  $result = false;



  for ($i=0; $i < $count ; $i++) {
    $id_ = $mysql->escape_string($id[$i]);

    $query = "DELETE FROM passwords WHERE id =?";
    $stmt = $mysql->prepare($query);
    $stmt->bind_param("i",$id_);
    $result = $stmt->execute();

  }


  if($result){
    echo $count." rows have been deleted";
    // echo $count." rows have been updated";
  }else{
    echo "something went wrong: ".$stmt->error;
  }

$stmt->close();




}//submitted
```


#### With the mysqli functions

```php


$submitted = isset(req["submit"]);

if ($submitted) {

  $conn= mysqli_connect("localhost","username","password","Testing");

 if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

  $id = req["id"];
  $count = count(req["id"]);
  $result = false;



  for ($i=0; $i < $count ; $i++) {
    $id_ = mysqli_real_escape_string($conn, $id[$i]);

    $query = "DELETE FROM passwords WHERE id =$id_";
    $result = mysqli_query($conn,$query);

  }


  if($result){
    echo $count." rows have been deleted";
  }else{
    echo "something went wrong: ".mysqli_error();
  }

mysqli_close($conn);




}//submitted

```

</details>


[go back :house:][home]

### how to delete multiple rows in PDO

<details>
<summary>
View Content
</summary>


#### With the prepare method

```php
define("req" , $_REQUEST);
$submitted = isset(req["submit"]);

if ($submitted) {

  try {

    $db = new PDO("mysql:host=localhost;dbname=Testing","username","password");

  } catch (PDOException $e) {
    $message = $e->getMessage();

    _p($message);
  }

  $id = req["id"];
  $result = false;
  $results = 0;



  for ($i=0; $i < count($id) ; $i++) {
    $query = "DELETE FROM passwords  WHERE id=:id ";

    $stmt = $db->prepare($query);
    $stmt->bindValue(":id",$id[$i]);
    $result = $stmt->execute();

    if($result){
      $results++;
    }

  }


  if($result){
    echo $results." rows have been deleted";
  }else{
    echo "something went wrong: $stmt->errorInfo()[2] ";
  }




}//submitted

```


#### With the exec method

```php


$submitted = isset(req["submit"]);

if ($submitted) {

  try {

    $db = new PDO("mysql:host=localhost;dbname=Testing","username","password");

  } catch (PDOException $e) {
    $message = $e->getMessage();

    _p($message);
  }

  $id = req["id"];
  $result = false;
  $results = 0;



  for ($i=0; $i < count($id) ; $i++) {
    $query = "DELETE FROM passwords  WHERE id=$id[$i] ";
    $result = $db->exec($query);

    if($result){
      $results++;
    }

  }


  if($result){
    echo $results." rows have been deleted";
  }else{
    echo "something went wrong: $db->errorInfo()[2] ";
  }




}//submitted

```

</details>


[go back :house:][home]



### how to update multiple rows in PDO

<details>
<summary>
View Content
</summary>


#### With the prepare method

```php
define("req" , $_REQUEST);
$submitted = isset(req["submit"]);

if ($submitted) {

  try {

    $db = new PDO("mysql:host=localhost;dbname=Testing","username","password");

  } catch (PDOException $e) {
    $message = $e->getMessage();

    _p($message);
  }

  $id = req["id"];
  $user = req["username"];
  $email = req["email"];
  $result = false;
  $results = 0;



  for ($i=0; $i < count($user) ; $i++) {
    $query = "UPDATE passwords SET username=:user , email=:email WHERE id=:id ";

    $stmt = $db->prepare($query);
    $stmt->bindValue(":user",$user[$i]);
    $stmt->bindValue(":email",$email[$i]);
    $stmt->bindValue(":id",$id[$i]);
    $result = $stmt->execute();

    if($result){
      $results++;
    }

  }


  if($result){
    echo $results." rows have been updated";
  }else{
    echo "something went wrong: $stmt->errorInfo()[2] ";
  }




}//submitted


```


#### With the exec method

```php

$submitted = isset(req["submit"]);

if ($submitted) {

  try {

    $db = new PDO("mysql:host=localhost;dbname=Testing","username","password");

  } catch (PDOException $e) {
    $message = $e->getMessage();

    _p($message);
  }

  $id = req["id"];
  $user = req["username"];
  $email = req["email"];
  $result = false;
  $results = 0;



  for ($i=0; $i < count($user) ; $i++) {
    $id_ = $id[$i];
    $u = $db->quote($user[$i]);
    $e = $db->quote($email[$i]);
    $query = "UPDATE passwords SET username=$u , email=$e WHERE id=$id_ ";
    $result = $db->exec($query);

    if($result){
      $results++;
    }

  }


  if($result){
    echo $results." rows have been updated";
  }else{
    echo "something went wrong: $db->errorInfo()[2] ";
  }




}//submitted
```

</details>


[go back :house:][home]

### how to insert multiple rows in PDO

<details>
<summary>
View Content
</summary>

#### With prepared statement

```php

$submitted = isset(req["submit"]);

if ($submitted) {

  try {

    $db = new PDO("mysql:host=localhost;dbname=Testing","username","password");

  } catch (PDOException $e) {
    $message = $e->getMessage();

    _p($message);
  }

  $user = req["username"];
  $pass = req["password"];
  $email = req["email"];
  $amount = req["amount"];
  $result = false;




  for ($i=0; $i < count($user) ; $i++) {

    $query = "INSERT INTO passwords (username,password,email,amount) VALUES (:user,:pass,:mail,:amou)";
    $state = $db->prepare($query);
    $state->bindValue(":user", $user[$i]);
    $state->bindValue(":pass", password_hash($pass[$i] , PASSWORD_DEFAULT));
    $state->bindValue(":mail", $email[$i]);
    $state->bindValue(":amou", $amount[$i]);
    $result = $state->execute();

    if(!$result){
      break;
    }
  }


  if($result){
    echo $state->rowCount()." rows have been inserted";
  }else{
    $err = $state->errorInfo();
    echo "something went wrong : $err[2]";
  }

  $state->closeCursor();


}

```

#### With exec method

```php

$submitted = isset(req["submit"]);


if ($submitted) {

  try {

    $db = new PDO("mysql:host=localhost;dbname=Testing","username","password");

  } catch (PDOException $e) {
    $message = $e->getMessage();

    _p($message);
  }

  $user = req["username"];
  $pass = req["password"];
  $email = req["email"];
  $amount = req["amount"];
  $result = false;

  for ($i=0; $i < count($user) ; $i++) {
    $u = $db->quote($user[$i]);
    $p = $db->quote(password_hash($pass[$i],PASSWORD_DEFAULT));
    $e = $db->quote($email[$i]);
    $a = $amount[$i];

    $query = "INSERT INTO passwords (username,password,email,amount) VALUES ($u, $p,$e,$a)";
     $result = $db->exec($query);

     if(empty($result)){
       break;
     }
  }



  if($result){
    echo $result." rows have been inserted";
  }else{
    echo "something went wrong: $db->errorInfo()[2] ";
  }




}//submitted
```

#### With the query method

```php

$submitted = isset(req["submit"]);
define("req" , $_REQUEST);

if ($submitted) {

  try {

    $db = new PDO("mysql:host=localhost;dbname=Testing","username","password");

  } catch (PDOException $e) {
    $message = $e->getMessage();

    _p($message);
  }

  $user = req["username"];
  $pass = req["password"];
  $email = req["email"];
  $amount = req["amount"];
  $result = false;



  for ($i=0; $i < count($user) ; $i++) {
    $u = $db->quote($user[$i]);
    $p = $db->quote(password_hash($pass[$i],PASSWORD_DEFAULT));
    $e = $db->quote($email[$i]);
    $a = $amount[$i];

    $rowValues[] = "($u,$p ,$e ,$a)";
  }


    $query = "INSERT INTO passwords (username,password,email,amount) VALUES ".implode(",",$rowValues);
    $result = $db->query($query);



  if($result){
    echo $result->rowCount()." rows have been inserted";
  }else{
    echo "something went wrong: $db->errorInfo()[2] ";
  }




}//submitted




```

</details>


[go back :house:][home]


### how to delete PDO data

<details>
<summary>
View Content
</summary>

```php
define("req" , $_REQUEST);
$submitted = isset(req["submit"]);

if ($submitted) {

  try {

    $db = new PDO("mysql:host=localhost;dbname=Testing","username","password");

  } catch (PDOException $e) {
    $message = $e->getMessage();

    _p($message);
  }

  $id = req["id"];

  $query = "DELETE FROM passwords WHERE id=:id  ";
  $state = $db->prepare($query);
  $state->bindValue(":id", $id);
  $result = $state->execute();

  if($result){
    echo $state->rowCount()." rows have been deleted";
  }else{
    $err = $state->errorInfo();
    echo "something went wrong : $err[2]";
  }

  $state->closeCursor();


}
```

</details>


[go back :house:][home]


### how to update PDO data

<details>
<summary>
View Content
</summary>

```php
define("req" , $_REQUEST);
$submitted = isset(req["submit"]);

if ($submitted) {

  try {

    $db = new PDO("mysql:host=localhost;dbname=Testing","username","password");

  } catch (PDOException $e) {
    $message = $e->getMessage();

    _p($message);
  }

  $user = req["username"];
  $email = req["email"];
  $id = req["id"];

  $query = "UPDATE passwords SET username=:user , email=:mail WHERE id=:id  ";
  $state = $db->prepare($query);
  $state->bindValue(":id", $id);
  $state->bindValue(":user", $user);
  $state->bindValue(":mail", $email);
  $result = $state->execute();

  if($result){
    echo "data has been saved";
  }else{
    $err = $state->errorInfo();
    echo "something went wrong : $err[2]";
  }

  $state->closeCursor();


}

```

</details>


[go back :house:][home]



### how to insert PDO data

<details>
<summary>
View Content
</summary>

#### One way

```php
$submitted = isset(req["submit"]);

if ($submitted) {

  try {

    $db = new PDO("mysql:host=localhost;dbname=Testing","username","password");

  } catch (PDOException $e) {
    $message = $e->getMessage();

    _p($message);
  }

  $user = req["username"];
  $pass = password_hash(req["password"], PASSWORD_DEFAULT);
  $email = req["email"];
  $amount = req["amount"];

  $query = "INSERT INTO  passwords (username, password, email, amount) VALUES (:user, :pass, :email, :amount)  ";
  $state = $db->prepare($query);
  $state->bindValue(":user", $user);
  $state->bindValue(":pass", $pass);
  $state->bindValue(":email", $email);
  $state->bindValue(":amount", $amount);
  $result = $state->execute();

  if($result){
    echo "data has been saved";
  }else{
    $err = $state->errorInfo();
    echo "something went wrong : $err[2]";
  }

  $state->closeCursor();


}
```

</details>


[go back :house:][home]



### how to read PDO data

<details>
<summary>
View Content
</summary>

#### Best Way

```php
$rows = "";


try {

  $db = new PDO("mysql:host=localhost;dbname=Testing","username","password");

} catch (PDOException $e) {
  $message = $e->getMessage();

  _p($message);
}

$query = "SELECT id,username, email FROM passwords  ";
$state = $db->prepare($query);
$state->execute();
$state->bindColumn("id", $id);
$state->bindColumn("username", $user);
$state->bindColumn("email", $email);

while($state->fetch(PDO::FETCH_BOUND)){

    $rows .="
    <tr>
      <td>$id</td>
      <td>$user</td>
      <td>$email</td>
    </tr>
    ";
}
$state->closeCursor();

```

#### 2nd Way

```php
try {

  $db = new PDO("mysql:host=localhost;dbname=Testing","username","password");

} catch (PDOException $e) {
  $message = $e->getMessage();

  _p($message);
}

$query = "SELECT id,username, email FROM passwords  ";
$state = $db->prepare($query);
$state->execute();
$data= $state->fetchAll();
$state->closeCursor();

foreach ($data as $key => $value) {

  $id = $value["id"];
  $user = $value["username"];
  $email = $value["email"];

  $rows .="
  <tr>
    <td>$id</td>
    <td>$user</td>
    <td>$email</td>
  </tr>
  ";

}

```

</details>


[go back :house:][home]


### how to delete data

<details>
<summary>
View Content
</summary>

#### With the mysqli class

```php
define("req" , $_REQUEST);
$submitted = isset(req["submit"]);

if($submitted){

  $mysql = new mysqli("localhost","username","password","Testing");

  $id = req["id"];

  if( $mysql->connect_error){
    die($mysql->connect_error);
  }

$query= "DELETE FROM  passwords  WHERE id=?" ;

  $state = $mysql->prepare($query);
  $state->bind_param("i",$id);
  $result = $state->execute();


  if($result){
    echo "data has been deleted";
  }else{

    echo "something went wrong";
  }

  $state->close();

}

```

#### With the mysqli functions

```php

define("req" , $_REQUEST);
$submitted = isset(req["submit"]);

if($submitted){

  $conn = mysqli_connect("localhost","username","password","Testing");

  $id = req["id"];

  if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

  $result = mysqli_query($conn,"DELETE FROM  passwords  WHERE id=$id");

  if($result){
    echo mysqli_affected_rows($conn)." rows have been deleted";
  }else{

    echo "something went wrong";
  }

  mysqli_close($conn);

}

```

</details>


[go back :house:][home]

### how to update data

<details>
<summary>
View Content
</summary>
**reference**
- [mysqli_query](https://www.w3schools.com/php/func_mysqli_query.asp)

#### With the mysqli class

```php

define("req" , $_REQUEST);

$submitted = isset(req["submit"]);

if($submitted){

  $mysql = new mysqli("localhost","username","password","Testing");

  $id = req["id"];
  $user = $mysql->escape_string(req["username"]);

  if( $mysql->connect_error){
    die($mysql->connect_error);
  }

$query= "UPDATE  passwords SET username=?  WHERE id=?" ;

  $state = $mysql->prepare($query);
  $state->bind_param("si",$user,$id);
  $result = $state->execute();


  if($result){
    echo "data has been saved";
  }else{

    echo "something went wrong";
  }

  $state->close();

}


```


#### With the mysqli functions

```php
define("req" , $_REQUEST);
$submitted = isset(req["submit"]);

if($submitted){




  $conn = mysqli_connect("localhost","username","password","Testing");

  $id = req["id"];
  $user = mysqli_real_escape_string($conn,req["username"]);

  if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }


  $result = mysqli_query($conn, "UPDATE  passwords SET username='$user'  WHERE id=$id") ;


  if($result){
    echo "data has been saved";
  }else{

    echo "something went wrong";
  }

  mysqli_close($conn);

}

```

</details>


[go back :house:][home]


### how to insert data

<details>
<summary>
View Content
</summary>

**reference**
- [w3schools](https://www.w3schools.com/php/php_mysql_insert.asp)
- [mysqli_query](https://www.w3schools.com/php/func_mysqli_query.asp)

#### With the mysqli class

```php

define("req" , $_REQUEST);

$submitted = isset(req["submit"]);

if($submitted){

  $user = req["username"];
  $pass = password_hash(req["password"], PASSWORD_DEFAULT);
  $email = req["email"];

  $mysql = new mysqli("localhost","username","password","Testing");

  if( $mysql->connect_error){
    die($mysql->connect_error);
  }

  $query = "INSERT INTO passwords (username,password,email) values (?,?,?)";

  $state = $mysql->prepare($query); // prepares the statement
  $state->bind_param("sss", $user, $pass,$email);// this binds variables into the ? values from the query
  $result = $state->execute();//executes the statement and returns a bool value

  if($result){
    echo "data has been saved";
  }else{

    echo "something went wrong";
  }

  $state->close();

}
```

#### With the mysqli functions

```php

$submitted = isset(req["submit"]);

if($submitted){

  $user = req["username"];
  $pass = password_hash(req["password"], PASSWORD_DEFAULT);
  $email = req["email"];

  $conn = mysqli_connect("localhost","username","password","Testing");

  if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    // returns a bool value if the query was executed successfully, also make sure you add quotes on the values or /**
   // it will not work
  $result = mysqli_query($conn, "INSERT INTO passwords (username,password,email) VALUES ('$user','$pass','$email')") ;


  if($result){
    echo "data has been saved";
  }else{

    echo "something went wrong";
  }

  mysqli_close($conn);

}


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


#### With the prepared method

```php

$submitted = isset(req["submit"]);

if ($submitted) {

  $mysql= new mysqli("localhost","username","password","Testing");

 if ($mysql->connect_errno)
   {
   echo "Failed to connect to MySQL: " . $mysql->connect_error;
   }

  $id = req["id"];
  $count = count(req["id"]);
  $user = req["username"];
  $email = req["email"];
  $result = false;

  for ($i=0; $i < $count ; $i++) {
    $id_ = $mysql->escape_string( $id[$i]);
    $u = $mysql->escape_string($user[$i]);
    $e = $mysql->escape_string($email[$i]);

    $query = "UPDATE passwords SET username=? , email=? WHERE id =?";
    $stmt= $mysql->prepare($query);
    $stmt->bind_param("ssi",$u,$e,$id_);
    $result = $stmt->execute();

  }


  if($result){
    // echo $count." rows have been deleted";
    echo $count." rows have been updated";
  }else{
    echo "something went wrong: ".$stmt->error;
  }

$stmt->close();




}//submitted

```

#### With the mysqli functions

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

<details>
<summary>
If uploading with the fetch method
</summary>

**In php**

```php
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


```

**In html**

```html
<section class="container">
  <form id="myForm" class="form" action="index.html" enctype="multipart/form-data" method="post">
    <input type="hidden" name="<?php echo ini_get("session.upload_progress.name"); ?>" value="myForm" />
   <div class="form-group">
     <input class="form-control col-5"  type="file" name="file" value="">
   </div>
   <input class="btn btn-primary" type="submit" name="" value="submit">
  </form>
</section>

<script type="text/javascript">
  (function(){
     let form = document.getElementById("myForm"),
        data = new FormData(),
        options,
        inpt = document.querySelector("input[name='file']"),
         url = "ajax/upload-progress.php";


     form.onsubmit = function(e){


        e.preventDefault();

        data.append("file", inpt.files[0])

        options =  new Request(url,{
          method:"POST",
          body: data,

        }
      );

        fetch(options)
        .then(res => res.text())
        .then(res => {
          console.log(res)
        })

     }
  })()
</script>


```


<details>


<details>
<summary>
If uploading on the same page
</summary>

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

<details>



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

**reference**

- [mysqli_fetch_assoc](https://www.php.net/manual/en/mysqli-result.fetch-assoc.php)


#### Best way with mysqli class

```php
$rows = "";


  $mysql = new mysqli("localhost","username","password","Testing");

  if( $mysql->connect_error){
    die($mysql->connect_error);
  }


  $query = "SELECT * FROM passwords";

  $state = $mysql->prepare($query);
  $state->bind_result($id, $user, $pass, $email,$amount);
  $result = $state->execute();




  if($result){

    while( $state->fetch()){

      $rows .="
        <tr>
        <td>$id</td>
        <td>$user</td>
        <td>$email</td>
        <td>$amount</td>
        </tr>
      ";

    }
  }else{

    echo "something went wrong";
  }

    $state->close();
```

#### Alternative way with mysqli class

```php

$sql = new mysqli("localhost","username","password","Testing");
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

#### With mysqli functions

```php

$rows = "";


  $conn= mysqli_connect("localhost","username","password","Testing");

  if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

  $query = "SELECT * FROM passwords";

  $result = mysqli_query($conn, $query);


  if($result){


    while( $row = mysqli_fetch_assoc($result)){

      $id = $row["id"];
      $user = $row["username"];
      $email = $row["email"];
      $amount = $row["amount"];

      $rows .="
        <tr>
        <td>$id</td>
        <td>$user</td>
        <td>$email</td>
        <td>$amount</td>
        </tr>
      ";

    }
  }else{

    echo "something went wrong";
  }

    mysqli_close($conn);

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
