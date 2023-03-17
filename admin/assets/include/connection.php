<?php
session_start();
$hostname = 'localhost';
$database = 'jbms';
$username = 'root';
$password = '';

  try {
  $dbj = new PDO('mysql:host='.$hostname.';dbname='.$database.';charset=utf8', ''.$username.'', ''.$password.'');
  } catch (PDOException $e){
    print "Error!:".$e->getMessage()."<br/>";
    die();
  }
?>