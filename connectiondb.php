<?php
try{
  $db = new PDO("mysql:dbname=thezonedb;host=localhost", 'root', '');  
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(Exception $e){
  echo "Connection failed: " . $e->getMessage();
  die(); 
}
?>