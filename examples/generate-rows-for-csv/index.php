<?php



/******************************
  INSERT DATA
******************************/



$submitted = isset(req["submit"]);

if ($submitted) {

  $mysql= new mysqli("localhost","username","password","Testing");

 if ($mysql->connect_errno)
   {
   echo "Failed to connect to MySQL: " . $mysql->connect_error;
   }

  $count = 100;
  $rowValues = [];
  $colNames = [];

  $result = false;

  $query = "SHOW COLUMNS FROM passwords";
  $result  = $mysql->query($query);

  if($result){
    while($row = $result->fetch_assoc()){
      $colNames[] = $row['Field'];
    }

  }

  $mysql->close();

  for ($i=0; $i < $count ; $i++) {
    $u = $faker->name;
    $p = password_hash("password", PASSWORD_DEFAULT);
    $e = $faker->email;
    $a = $faker->numberBetween(1,500);

    $rowValues[]= array("$u","$p","$e" ,$a);
  }


$file = getcwd()."/files/csv/new-passwords.csv";

$csv = fopen($file,"w");

fputcsv($csv, $colNames);

foreach ($rowValues as $key ) {
  fputcsv($csv, $key);
}

$response = fclose($csv);

if($response){

  chmod($file,0775);

  echo "csv has been created";

}else{
  echo "something went wrong";
}


}//submitted




 ?>


 <main>
     <section class="container">



       <form class="" action="" method="post">
         <input class="btn btn-primary" type="submit" name="submit" value="Generate CSV">
       </form>




     </section>
</main>


<script type="text/javascript">
  (function(){



  })()
</script>
