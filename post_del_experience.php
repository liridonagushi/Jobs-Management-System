<?php
// Including functions
include('admin/assets/include/functions.php');

// Validating Form
$error_txt = check_error(check_string_length($_GET['id_experience'], 1, 11));

if(!empty($error_txt)){

  // Message type and text
  set_message(2,''.$error_txt.'');

  header('Location: profile.php?collapse=4');

}else{

$del = "DELETE FROM working_experiences WHERE id_experience=:id_experience";

$del_prepare = $dbj->prepare($del);
$del_prepare->bindValue(':id_experience', $_GET['id_experience']);

$del_prepare->execute();

// Message type and text
set_message(3,'Level '.$_GET['level_experience'].' is deleted successfully');

// Redirection to the file
header('Location: profile.php?collapse=4');
}
?>