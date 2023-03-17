<?php
// Including functions
include('admin/assets/include/functions.php');

// Validating Form
$error_txt = check_error(check_string_length($_GET['id_diploma_user'], 1, 11));

if(!empty($error_txt)){

  // Message type and text
  set_message(2,''.$error_txt.'');

  header('Location: profile.php?collapse=3');

}else{

$del = "DELETE FROM diploma_users WHERE id_diploma_user=:id_diploma_user";

$del_prepare = $dbj->prepare($del);
$del_prepare->bindValue(':id_diploma_user', $_GET['id_diploma_user']);

$del_prepare->execute();

// Message type and text
set_message(3,''.$_GET['type_diploma'].' diploma is deleted successfully !');

// Redirection to the file
header('Location: profile.php?collapse=3');
}
?>