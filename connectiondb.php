<?php
try{
  $dbname = 'u_220202983_db';
  $dbhost = ' localhost';
  $username = 'u-220202983';
  $password = 'IrPf3eQiFOTiS1O';
  $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $username, $password);

  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(Exception $e){
  echo "Connection failed: " . $e->getMessage();
  die(); 
}
?>