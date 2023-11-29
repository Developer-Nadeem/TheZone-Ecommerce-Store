<?php
try{
  $dbname = '';
  $dbhost = '';
  $username = '';
  $password = '';
  $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $username, $password);

  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(Exception $e){
  echo "Connection failed: " . $e->getMessage();
  die(); 
}
?>