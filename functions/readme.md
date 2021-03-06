# PHP Functions

These are the essential functions I need to learn how to use

- [chmod][chmod]
- [chown][chown]
- [file_put_contents][put-contents]
- [fopen][fopen]
- [move_uploaded_file][mu-file]
- [password_hash][pass-hash]
- [password_verify][pass-verify]
- [unset][unset]

[pass-verify]:#password_verify
[pass-hash]:#password_hash
[mu-file]:#move_uploaded_file
[unset]:#unset
[home]:#php-functions
[chown]:#chown
[chmod]:#chmod
[put-contents]:#file_put_contents

### fopen

<details>
<summary>
View Content
</summary>

**reference**
- [php.net](https://www.php.net/manual/en/function.fopen.php)
- [w3schools](https://www.w3schools.com/php/func_filesystem_fopen.asp)

**syntax**
`fopen(filename,mode,include_path,context)`

**fopen modes**

mode|description
-|-
r|Read only. Starts at the beginning of the file
r+|Read/Write. Starts at the beginning of the file
w|Write only. Opens and clears the contents of file; or creates a new file if it doesn't exist
w+|Read/Write. Opens and clears the contents of file; or creates a new file if it doesn't exist
a|Write only. Opens and writes to the end of the file or creates a new file if it doesn't exist
a+|Read/Write. Preserves file content by writing to the end of the file
x|Write only. Creates a new file. Returns FALSE and an error if file already exists
x+|Read/Write. Creates a new file. Returns FALSE and an error if file already exists

```php
$file = "passwords.csv";

// the first parameter is the filename
// the second parameter creates a new file if it doesn't exist, but if it does it clears the content of the existing file
$csv = fopen($file,"w");
```

</details>


[go back :house:][home]


### password_verify

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

```php
$match = password_verify($pass, $db_pass);
```

</details>


[go back :house:][home]


### password_hash

<details>
<summary>
View Content
</summary>

**reference**
-[password_hash](http://php.net/manual/en/function.password-hash.php)

```php
  // make sure you add the second paremeter or you will get an error message
  $p = password_hash(post["password"], PASSWORD_DEFAULT);
```

</details>


[go back :house:][home]

### move_uploaded_file

<details>
<summary>
View Content
</summary>

**reference**
- [php](http://php.net/manual/en/function.move-uploaded-file.php)

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
  }

}
```

</details>


[go back :house:][home]

### unset

<details>
<summary>
View Content
</summary>

**reference**
- [w3resource](https://www.w3resource.com/php/function-reference/unset.php)

**w3 definition:** The unset() function destroys a given variable

```
unset (var1, var2.... )
```

```php

$xyz='w3resource.com';
echo 'Before using unset() the value of $xys is : '. $xyz.'<br>';
unset($xyz);
echo 'After using unset() the value of $xys is : '. $xyz;

```
</details>

[go back :house:][home]



### chown

<details>
<summary>
View Content
</summary>

**reference**
- [chown](http://php.net/manual/en/function.chown.php)

`chown(<insert file name>, <insert user name>)`

```php
$filename = getcwd()."/farmer.json";
file_put_contents($filename,$farm);
chmod($filename,0775);
chown($filename, "jermaine");//changes the ownership of farmer.json to jermaine
```
</details>

[go back :house:][home]


### chmod
<details>
<summary>
View Content
</summary>

**reference**
- [chmod](http://php.net/manual/en/function.chmod.php)

```
<?php
chmod("/somedir/somefile", 755);   // decimal; probably incorrect
chmod("/somedir/somefile", "u+rwx,go+rx"); // string; incorrect
chmod("/somedir/somefile", 0755);  // octal; correct value of mode
?>
```
</details>

[go back :house:][home]

### file_put_contents
<details>
<summary>
View Content
</summary>

- [file_put_contents](http://php.net/manual/en/function.file-put-contents.php)

```php
$filename = getcwd()."/farmer.json";
file_put_contents($filename,$farm);
chmod($filename,0775);
```
</details>

[go back :house:][home]
