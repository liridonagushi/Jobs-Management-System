<?php
// Including functions
include('admin/assets/include/functions.php');

// Validating Form
$error_txt = check_error(check_string_length($_GET['id_user'], 1, 11));

if(strlen($error_txt)>0){

  // Message type and text
  set_message(2,''.$error_txt.'');

  header('Location: index.php');

}else{

switch ($_GET['target']) {
  case 'messages':

      $del = "UPDATE emails SET active_employee='0' WHERE ((id_from=:id_from AND id_to=:id_to) OR (id_from=:id_to AND id_to=:id_from))";

      $del_prepare = $dbj->prepare($del);
      $del_prepare->bindValue(':id_from', $_GET['id_user']);
      $del_prepare->bindValue(':id_to', $_SESSION['jbms_front']['id_user']);

      $del_prepare->execute();

      // Message type and text
      set_message(3,'Messages deleted successfully !');

    break;
}

// Redirection to the file
header('Location: '.$_GET['hyperlink'].'');
}
?>