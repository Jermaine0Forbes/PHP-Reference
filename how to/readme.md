# How To 

[how to create a simple routing system][simple-router]

## MYSQLI

[how to fetch data][fetch-data]

[fetch-data]:#how-to-fetch-data
[simple-router]:#how-to-create-a-simple-routing-system
[home]:#how-to

### how to fetch data 

<details>
<summary>
View Content
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


