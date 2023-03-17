<?php
// Including functions
include('assets/include/functions.php');

// Validating Form
$error_txt = check_error(check_string_length($_GET['id_company'], 1, 11));


$comp = $dbj->query('SELECT id_adress FROM companies WHERE id_adress="'.$_GET['id_company'].'"');
$row_comp=$comp->fetch(PDO::FETCH_ASSOC);

$adress = $dbj->query('SELECT id_adress FROM adresses WHERE id_adress="'.$row_comp['id_adress'].'"');

if($adress->rowCount()){
  $error_txt='Company adress not found !';
}

if (empty($error_txt)){

  $find_adress=$adress->fetch(PDO::FETCH_ASSOC);

  // Removing the values
  $dbj->exec('UPDATE companies SET active="0" WHERE id_company="'.$_GET['id_company'].'"');
  $dbj->exec('UPDATE adresses SET active="0" WHERE id_adress="'.$find_adress['id_adress'].'"');
  $dbj->exec('UPDATE job_offers SET active="0" WHERE id_company="'.$_GET['id_company'].'"');
  
  $job_offer = $dbj->query('SELECT id_job FROM job_offers WHERE id_company="'.$_GET['id_company'].'"');

  if($job_offer->rowCount()){
   $dbj->exec('DELETE FROM job_offers WHERE id_company="'.$_GET['id_company'].'"');
  }

  // Message type and text
  set_message(3,''.$_GET['company_name'].' is successfully removed');
  
  header('Location: lst_companies.php#module');

}else{

  // Default message type and text
  set_message(2,''.$error_txt.'');

  // Redirection
  header('Location: lst_companies.php#module');
}
?>