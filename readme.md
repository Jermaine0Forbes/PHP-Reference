
# PHP Reference

this will mainly be a reference on how to OOP in php and other methods that I think
I need to learn how to use

- [php coding style guide][psr]
- [how to use define][define]
- [how to query a database][query-data]

## Essential Functions
- [isset][isset]
- [empty][empty]
- [var_dump][var-dump]
- [define][define]

## Ajax Examples
- [select ajax][ajax-select]
- [how to update data with ajax][update-ajax]


## Array Functions
- [explode][explode]


## Date Functions
- [date][date]


## String Functions
- [trim][trim]
- [implode][implode]

## Validate Forms
- [filter_validate_email][filter-validate-email]
- [filter_validate_int][filter-validate-int]
- [filter_validate_float][filter-validate-float]

## Sanitize Forms
- [filter_var][filter-var]

## Design Patterns
- [design reference guide][design-reference]

## Libraries

- [how to use faker][faker-basic]
- [how to create your own faker provider][faker-provider]

## Namespaces
- [how to use namespace][namespace]

## Settings
- [How to Setup Timezone][php-timezone]

## Suggestions
- [best security practices]
- [how to autoload classes]
- [how to use .htaccess files]
- [how to create a layout file]
- [php date functions]
- [php regular expressions]
- [php hashing passwords]
- [mysqli functions]
- [how to use traits]



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

  ```php
  <?php

  $str = "<h2> hello </h2> ";

  $filter  = filter_var($str, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  var_dump($filter); //string(29) "<h2> hello </h2> "


   ?>
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
