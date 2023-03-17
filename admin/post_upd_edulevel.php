<?php
// Including functions
include('assets/include/functions.php');

$error_txt = '';

// Validating Form
$error_txt = check_error(check_string_length($_POST['id_level_education'], 1, 8));
$error_txt = check_error(check_string_length($_POST['level_education'], 2, 80));

$exist=$dbj->query('SELECT level_education FROM levels_education WHERE level_education="'.$_POST['level_education'].'" AND id_level_education<>"'.$_POST['id_level_education'].'"');
if($exist->rowCount()){
  $error_txt=10;
}

if(!empty($error_txt)){

// Message type and text
set_message(2,''.$_POST['level_education'].' diploma already exists in the database !');

  // Last insert id
  header('Location: upd_edulevel.php?id_level_education='.$_POST['id_level_education'].'');

}else{

  $upd_level = "UPDATE levels_education SET level_education=:level_education, active=:active WHERE id_level_education=:id_level_education";

  $upd_prep = $dbj->prepare($upd_level);
  $upd_prep->bindValue(':level_education', $_POST['level_education']);
  $upd_prep->bindValue(':id_level_education', $_POST['id_level_education']);
  $upd_prep->bindValue(':active', var_status($_POST['active']));

  $upd_prep->execute();

  // Message type and text
  set_message(3,'Level '.$_POST['level_education'].' is updated succesfully');

// Redirection to the file
  header('Location: upd_edulevel.php?id_level_education='.$_POST['id_level_education'].'');
}
?>