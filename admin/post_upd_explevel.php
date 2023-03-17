<?php
// Including functions
include('assets/include/functions.php');

$error_txt = '';

// Validating Form
$error_txt = check_string_length($_POST['id_level_experience'], 1, 8);
$error_txt = check_string_length($_POST['level_experience'], 2, 80);

$exist=$dbj->query('SELECT id_level_experience, level_experience FROM levels_experience WHERE level_experience="'.$_POST['level_experience'].'" AND id_level_experience<>"'.$_POST['id_level_experience'].'"');

if($exist->rowCount()){
  $error_txt=10;
}

if(!empty($error_txt)){

// Message type and text
set_message(2,''.$_POST['level_experience'].' '.check_error($error_txt).'');

  // Last insert id
  header('Location: upd_explevel.php?id_level_experience='.$_POST['id_level_experience'].'');

}else{

  $upd_level = "UPDATE levels_experience SET level_experience=:level_experience, years_experience=:years_experience, active=:active WHERE id_level_experience=:id_level_experience";

  $upd_prep = $dbj->prepare($upd_level);
  $upd_prep->bindValue(':level_experience', $_POST['level_experience']);
  $upd_prep->bindValue(':years_experience', $_POST['years_experience']);
  $upd_prep->bindValue(':id_level_experience', $_POST['id_level_experience']);
  $upd_prep->bindValue(':active', var_status($_POST['active']));

  $upd_prep->execute();

  // Message type and text
  set_message(3,'Level '.$_POST['level_experience'].' is updated succesfully');

// Redirection to the file
  header('Location: upd_explevel.php?id_level_experience='.$_POST['id_level_experience'].'');
}
?>