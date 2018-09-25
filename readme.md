
# PHP Reference

this will mainly be a reference on how to OOP in php and other methods that I think
I need to learn how to use

- [php coding style guide][psr]



## Essential Functions
- [isset][isset]
- [empty][empty]
- [var_dump][var-dump]
- [define][]

## String Functions
- [trim][trim]

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
- [how to use define]
- [how to query a database]
- [how to use .htaccess files]
- [how to create a layout file]
- [how to use traits]

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
