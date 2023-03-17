<?php
// Including functions
require_once('admin/assets/include/functions.php');

if(!empty( $_SESSION['jbms_front']['id_user'])){

  $langupd = 'UPDATE users SET id_language=:id_language WHERE id_user=:id_user';

  $upd_prep = $dbj->prepare($langupd);
  $upd_prep->bindValue(':id_language', $_GET['id_language']);
  $upd_prep->bindValue(':id_user', $_SESSION['jbms_front']['id_user']);

  $upd_prep->execute();

  // Message type and text
  set_message(3,'Website language successfully updated !');

}
  $_SESSION['jbms_front']['lang_code']=$_GET['lang_code'];

  // Redirection to the page
  header('Location: index.php');
?>