<?php
// Including functions
include('assets/include/functions.php');

// Validating Form
$error_txt = check_error(check_string_length($_GET['id_user'], 1, 11));

if(strlen($error_txt)>0){

  // Message type and text
  set_message(2,''.$error_txt.'');

  header('Location: lst_job_offers.php');

}else{

switch ($_GET['target']) {

  case 'inbox':

    $del = "UPDATE emails SET active_idfrom='0' WHERE id_from=:id_from";

    $del_prepare = $dbj->prepare($del);
    $del_prepare->bindValue(':id_from', $_GET['id_user']);

    $del_prepare->execute();

    // Message type and text
    set_message(3,'Messages of '.$_GET['email_adress'].' are deleted successfully');

    // Redirection to the file
    header('Location: lst_inbox.php');
        break;
    
  case 'sent':
    // Redirection to the file
    header('Location: lst_sent.php');
        break;
  }
}
?>