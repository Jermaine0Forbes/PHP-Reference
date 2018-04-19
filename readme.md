
# PHP Reference

this will mainly be a reference on how to OOP in php and other methods that I think
I need to learn how to use

- [php coding style guide][psr]

## Design Patterns
- [design reference guide][design-reference]

## Namepspaces
- [how to use namespace][namespace]

## Suggestions
- [best security practices]
- [how to autoload classes]

[namespace]:#how-to-use-namespaces
[design-reference]:#design-reference-guide
[psr]:#php-coding-style-guide
[home]:#php-reference

---


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
