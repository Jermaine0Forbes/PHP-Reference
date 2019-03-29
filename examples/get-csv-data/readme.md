# Get CSV data

This just an example where you get the csv data and display it in the table 

**index.php**
```php
<?php



/******************************
  GETTING CSV DATA
******************************/
$user = [];
$pass = [];
$id = [];
$row = [];
$submitted = isset(req["submit"]);

if($submitted){

  $file = fopen("files/csv/passwords.csv","r");

  while(!feof($file)){
    $row = fgetcsv($file);
    if($row[0] == "id"){
      continue;
    }
    $id[] = $row[0];
    $user[] = $row[1];
    $pass[] = $row[2];

  }

  fclose($file);

}


// var_dump($user);
 ?>


 <main>
     <section class="container">
       <h2>Get CSV Data</h2>
       <form class="" action="" method="post">
         <input class="btn btn-primary" type="submit" name="submit" value="Retrieve the data">
       </form>

       <?php
       if (!empty($id)) {

        ?>

        <table class="table">
          <thead>
            <tr>
              <th>id</th>
              <th>username</th>
              <th>password</th>
            </tr>
          </thead>
          <tbody>
            <?php
            for ($i =0; $i < count($id) ; $i++) {
              echo "<tr><td>$id[$i]</td> <td>$user[$i]</td> <td>$pass[$i]</td></tr>";
            }

             ?>
          </tbody>
        </table>

        <?php


       }

        ?>

     </section>
</main>


<script type="text/javascript">
  (function(){



  })()
</script>


```
