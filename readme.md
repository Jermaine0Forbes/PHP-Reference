
# PHP Reference

this will mainly be a reference on how to OOP in php and other methods that I think
I need to learn how to use

- [php coding style guide][psr]

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

[php-timezone]:#how-to-setup-timezone-in-php
[faker-provider]:#how-to-create-your-own-faker-provider
[faker-basic]:#how-to-use-faker
[namespace]:#how-to-use-namespaces
[design-reference]:#design-reference-guide
[psr]:#php-coding-style-guide
[home]:#php-reference

---


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
