<?php
// Including functions
include('assets/include/functions.php');

// Validating Form
$error_txt = check_error(check_string_length($_GET['id_level_education'], 1, 11));

$verify=$dbj->query('SELECT id_level_education FROM diploma_users WHERE id_level_education="'.$_GET['id_level_education'].'"');
if($verify->rowCount()){
  $error_txt=''.$_GET['level_education'].' is used in the database !';
}

if(strlen($error_txt)>0){

  // Message type and text
  set_message(2,''.$error_txt.'');

  header('Location: lst_education_levels.php#module');

}else{

$del = "DELETE FROM levels_education WHERE id_level_education=:id_level_education";

$del_prepare = $dbj->prepare($del);
$del_prepare->bindValue(':id_level_education', $_GET['id_level_education']);

$del_prepare->execute();

// Message type and text
set_message(3,'Level '.$_GET['level_education'].' is deleted successfully');

// Redirection to the file
header('Location: lst_education_levels.php#module');
}
?>