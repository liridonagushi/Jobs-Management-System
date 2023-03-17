<?php
// Including functions
include('assets/include/functions.php');

// Validating Form
$error_txt = check_error(check_string_length($_GET['id_job'], 1, 11));

if(strlen($error_txt)>0){

  // Message type and text
  set_message(2,''.$error_txt.'');

  header('Location: lst_job_offers.php#module');

}else{

$del = "DELETE FROM job_offers WHERE id_job=:id_job";

$del_prepare = $dbj->prepare($del);
$del_prepare->bindValue(':id_job', $_GET['id_job']);

$del_prepare->execute();

// Message type and text
set_message(3,'Job '.$_GET['job_title'].' is deleted successfully');

// Redirection to the file
header('Location: lst_job_offers.php#module');
}
?>