<?php
// Including functions
include('assets/include/functions.php');

// If the value is received
if ($_GET['id_company']) {

  // Message type and text
  set_message(3,''.$_GET['company_name'].' is successfully removed');

  // Removing the values
  $del=$dbj->exec('DELETE FROM companies WHERE id_company="'.$_GET['id_company'].'"');
  header('Location: lst_companies.php');

}else{

  // Default message type and text
  set_message(1,'Company ID not found');

  // Redirection
  header('Location: lst_companies.php');
}
?>