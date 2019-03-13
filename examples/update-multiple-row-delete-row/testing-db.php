<?php
$sql = new mysqli("localhost","jermaine","yurizan8","Testing");

if( $sql->connect_error){
  die($sql->connect_error);
}
