<?php
// Including functions
include('assets/include/functions.php');

// Validating Form
$error_txt = check_error(check_string_length($_GET['id_level_experience'], 1, 11));

// Verification existing value
$diploma=$dbj->query('SELECT id_level_experience FROM job_offers WHERE id_level_experience="'.$_GET['id_level_experience'].'"');

if($diploma->rowCount()){
 $error_txt=''.$_GET['level_experience'].' experience is used in the database !';
}

if(!empty($error_txt)){

  // Message type and text
  set_message(2,''.$error_txt.'');

  header('Location: lst_experience_levels.php#module');

}else{

$del = "DELETE FROM levels_experience WHERE id_level_experience=:id_level_experience";

$del_prepare = $dbj->prepare($del);
$del_prepare->bindValue(':id_level_experience', $_GET['id_level_experience']);

$del_prepare->execute();

// Message type and text
set_message(3,'Level '.$_GET['level_experience'].' is deleted successfully');

// Redirection to the file
header('Location: lst_experience_levels.php#module');
}
?>