# PHP Functions

These are the essential functions I need to learn how to use

## MSQLI

## Permissions
- [chown][chown]
- [chmod][chmod]

## Files
- [create a file][put-contents]
- [move_uploaded_file][mu-file]

## Other
- [unset][unset]

[mu-file]:#move_uploaded_file
[unset]:#unset
[home]:#php-functions
[chown]:#chown
[chmod]:#chmod
[put-contents]:#file_put_contents

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
