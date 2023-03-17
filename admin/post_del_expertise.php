<?php
// Including functions
include('assets/include/functions.php');

// Validating Form
$error_txt = check_error(check_string_length($_GET['id_expertise'], 1, 11));

if(strlen($error_txt)>0){

  // Message type and text
  set_message(2,''.$error_txt.'');

  header('Location: lst_expertises.php#module');

}else{

$del = "DELETE FROM expertises WHERE id_expertise=:id_expertise";

$del_prepare = $dbj->prepare($del);
$del_prepare->bindValue(':id_expertise', $_GET['id_expertise']);

$del_prepare->execute();

// Message type and text
set_message(3,'Expertise '.$_GET['expertise_area'].' is deleted successfully');

// Redirection to the file
header('Location: lst_expertises.php#module');
}
?>