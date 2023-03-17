<?php
// Including functions
require_once('assets/include/functions.php');

// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('assets/include/variables.php');



login_twoadmin();

// sanitize company_sn
$company_sn = filter_var($_REQUEST['company_sn'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);

// check we have company_sn post var
if(isset($company_sn))
{
  
switch ($_GET['target']) {
  case 'insert':
      //check company_sn in db
      $results = $dbj->query("SELECT id_company, company_sn FROM companies WHERE company_sn='".$company_sn."'");
    break;

  case 'update':
      //check company_sn in db
      $results = $dbj->query("SELECT id_company, company_sn FROM companies WHERE company_sn='".$company_sn."' AND id_company!=".$_GET['id_company']."");
    break;
}
  
  // trim and lowercase company_sn
  $company_sn =  strtolower(trim($_REQUEST["company_sn"])); 
  
  //return total count
  $company_sn_exist = $results->rowCount(); //total records
  
  //if value is more than 0, company_sn is not available
  if($company_sn_exist) {
     echo "false";
  }else{
   echo "true";
  }
}
?>
