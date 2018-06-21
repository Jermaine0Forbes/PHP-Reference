# PHP Functions 

These are the essential functions I need to learn how to use 

## Permissions
- [chown][chown]
- [chmod][chmod]

## Files
- [create a file][put-contents]

[home]:#php-functions
[chown]:#chown
[chmod]:#chmod
[put-contents]:#file_put_contents

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

