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

//check we have username post var
if(isset($_POST["cv_code"])) 
{
	//trim and lowercase username
	$cv_code =  strtolower(trim($_POST["cv_code"])); 
	
	//sanitize username
	$cv_code = filter_var($cv_code, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
		//trim and lowercase username
	$lm_code =  strtolower(trim($_POST["lm_code"])); 
	
	//sanitize username
	$lm_code = filter_var($lm_code, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	
	//check username in db
	$results = $dbj->query("SELECT cv_code FROM cv_lm WHERE cv_code='".$cv_code."'");
	
	//return total count
	$cv_lm = $results->rowCount(); //total records
	
	//if value is more than 0, username is not available
	if($cv_lm) {
		return $response=0;
	}else{
		// echo '<img src="assets/images/check_available/available.png" />';
		return $response=1;
	}
	
}
//check we have username post var
if(isset($_POST["lm_code"])) 
{
	//trim and lowercase username
	$cv_code =  strtolower(trim($_POST["cv_code"])); 
	
	//sanitize username
	$cv_code = filter_var($cv_code, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
		//trim and lowercase username
	$lm_code =  strtolower(trim($_POST["lm_code"])); 
	
	//sanitize username
	$lm_code = filter_var($lm_code, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	
	//check username in db
	$results = $dbj->query("SELECT cv_code, lm_code FROM cv_lm WHERE lm_code='".$lm_code."'");
	
	//return total count
	$cv_lm = $results->rowCount(); //total records
	
	//if value is more than 0, username is not available
	if($cv_lm) {
		return $response=0;
	}else{
		// echo '<img src="assets/images/check_available/available.png" />';
		return $response=1;
	}
	
}
?>

