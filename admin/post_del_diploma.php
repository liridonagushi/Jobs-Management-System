<?php
// Including functions
include('assets/include/functions.php');

// Validating Form
$error_txt = check_error(check_string_length($_GET['id_type_diploma'], 1, 11));

// Verification existing value
$diploma=$dbj->query('SELECT id_type_diploma FROM diploma_users WHERE id_type_diploma="'.$_GET['id_type_diploma'].'"');

if($diploma->rowCount()){
 $error_txt='Diploma '.$_GET['type_diploma'].' is used in the database';
}

if(!empty($error_txt)){

  // Message type and text
  set_message(2,''.$error_txt.'');

  header('Location: lst_diploma_types.php#module');

}else{

$del = "DELETE FROM diploma_types WHERE id_type_diploma=:id_type_diploma";

$del_prepare = $dbj->prepare($del);
$del_prepare->bindValue(':id_type_diploma', $_GET['id_type_diploma']);

$del_prepare->execute();

// Message type and text
set_message(3,''.$_GET['type_diploma'].' diploma is deleted successfully !');

// Redirection to the file
header('Location: lst_diploma_types.php#module');
}
?>