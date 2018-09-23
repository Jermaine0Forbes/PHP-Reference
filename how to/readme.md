# How To

- [how to create a simple routing system][simple-router]

## MYSQLI

- [how to fetch data][fetch-data]
- [how to delete data][delete-data]
- [how to update data][update-data]

[update-data]:#how-to-update-data
[delete-data]:#how-to-delete-data
[fetch-data]:#how-to-fetch-data
[simple-router]:#how-to-create-a-simple-routing-system
[home]:#how-to


### how to update data

<details>
<summary>
View Content
</summary>

```php
<?php

$sql = new mysqli("localhost","username","password","Testing");

if($sql->connect_error){

  die("PHP error my nig : ".$sql->connect_error);
}

$query = "update animals set animal='mongoose' where id=2";

if( $sql->query($query) == true){
  echo "row has been updated";
  $query = "select * from animals";
  $result = $sql->query($query);
}else{

  echo "something went wrong";
}

?>

<main>
    <section class="container">
    <?php

      if(!empty($result)){

        while($row = $result->fetch_assoc()){
          $id = $row['id'];
          $name = $row['animal'];
          $sex = $row['sex'];

          echo "<h2> $id </h2>";
          echo "<p> $name </p>";
          echo "<p> $sex </p>";
        }
        $result->free();
      }
      $sql->close();
     ?>

    </section>

</main>

```

</details>


[go back :house:][home]


### how to delete data

<details>
<summary>
View Content
</summary>

```php
<?php

$sql = new mysqli("localhost","username","password","Testing");

if($sql->connect_error){
  echo "something is wrong";

}

$query = "delete from animals where id = 1";

if ( $sql->query($query) == true){
  echo "<h2> row has been deleted</h2>";
  $query = "select * from animals";
  $result = $sql->query($query);
}else{
  echo "error";
}

?>

<main>
    <section class="container">
      <?php
        if (!empty($result) ){

          while($row = $result->fetch_assoc()){

            echo "<h2> ".$row['id']." </h2> <p> ".$row['animal']." </p><p> ".$row['sex']."</p>";

          }

            $result->free();
        }
      $sql->close();
        ?>

    </section>

</main>

```

</details>


[go back :house:][home]

### how to fetch data

<details>
<summary>
View Content
</summary>

<details>
<summary>
With Functions
</summary>
```php

 <?php

 // connects php to mysql
 $conn = mysqli_connect("localhost","jermaine","yurizan8","Testing");


 // checks if there is a connection error
 if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


 $sql = "select * from animals";


 ?>


 <main>
    <section class="container">
        <?php
            if($result = mysqli_query($conn, $sql)){

              while($row = mysqli_fetch_assoc($result)){
                  $id = $row["id"];  
                  $animal = $row["animal"];  
                  $sex = $row["sex"];  
                  $farm = $row["farmer_id"];  
                  $create = $row["created_at"];  
                  $update = $row["updated_at"];  

                    echo "<div><h3>$id: $animal</h3> <ul> <li>sex: $sex</li><li>farm id: $farm</li><li>born: $create</li><li>current date: $update</li> </ul></div>";
                }

        }


        mysqli_free_result();
        mysqli_close();
        ?>

    </section>

   </main>
```
</details>


<details>
<summary>
With OOP
</summary>

#### Or with OOP

```php
<?php
$sql = new mysqli("localhost","jermaine","yurizan8","Testing");
if($sql->connect_errno){
    echo "Big Error: ".$sql->connect_error;
}

$query = "select * from animals";
$result = $sql->query($query)
 ?>

 <main>
     <section class="container">
         <?php
             if($result){

               while($row = $result->fetch_assoc()){
                   $id = $row["id"];
                   $animal = $row["animal"];
                   $sex = $row["sex"];
                   $farm = $row["farmer_id"];
                   $create = $row["created_at"];
                   $update = $row["updated_at"];

                     echo "<div><h3>$id: $animal</h3> <ul> <li>sex: $sex</li><li>farm id: $farm</li><li>born: $create</li><li>current date: $update</li> </ul></div>";
                 }

         }


         $result->free();
         $sql->close();
         ?>

     </section>

 </main>

```

</details>


</details>

[go back :house:][home]



###  how to create a simple routing system

<details>
<summary>
View Content
</summary>

1. create an .htaccess file and add this

```
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule . index.php [L]
RewriteEngine On
```

2. create an index file and add this

```php
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

// Route it up!
switch ($request_uri[0]) {
    // Home page
    case '/':
        require 'views/index.php';
        break;
    // About page
    case '/about':
        require 'views/about.php';
        break;
    // Everything else
    default:
        header('HTTP/1.0 404 Not Found');
        require 'views/404.php';
        break;
}
```
3. Now create index, about, and a 404 page and add whatever code you want in it. And that is about it


</details>

[go back :house:][home]
