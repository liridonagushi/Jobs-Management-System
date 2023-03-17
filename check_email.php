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

// check we have username post var
if(!empty($_SESSION['jbms_front']['id_user']))
{
  //trim and lowercase email
  $email =  strtolower(trim($_REQUEST['email'])); 
  
  //sanitize email
  $email_adress = filter_var($email, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
  
  //check email in db
  $results = $dbj->query('SELECT id_user, email FROM users WHERE email="'.$email_adress.'" AND id_user!="'.$_SESSION['jbms_front']['id_user'].'"');
  
  //return total count
  $email_exist = $results->rowCount(); //total records
  
  //if value is more than 0, email is not available
  if($email_exist) {
    echo "false";
  }else{
    echo "true";
    // echo '<img src="assets/images/check_available/available.png" />';
  }
  
}
?>

