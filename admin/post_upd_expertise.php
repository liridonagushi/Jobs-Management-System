<?php
// Including functions
include('assets/include/functions.php');

$error_txt = '';

// Validating Form
$error_txt = check_error(check_string_length($_POST['id_cat_expertise'], 1, 8));
$error_txt = check_error(check_string_length($_POST['id_expertise'], 1, 8));
$error_txt = check_error(check_string_length($_POST['expertise_area'], 2, 80));
$error_txt = check_error(check_string_length(var_status($_POST['active']), 0, 1));

$exist=$dbj->query('SELECT id_category, '.$_SESSION['jbms_front']['lang_code'].'_expertise_area FROM expertises WHERE '.$_SESSION['jbms_front']['lang_code'].'_expertise_area="'.$_POST['expertise_area'].'" AND id_category="'.$_POST['id_cat_expertise'].'" AND id_expertise<>"'.$_POST['id_expertise'].'"');

if($exist->rowCount()){
  $error_txt=10;
}

if(!empty($error_txt)){

  // Message type and text
 set_message(2,''.$_POST['expertise_area'].' expertise already exists in the database !');

  // Last insert id
  header('Location: upd_expertise.php?id_expertise='.$_POST['id_expertise'].'');

}else{

  $upd_cat = "UPDATE expertises SET expertise_area=:expertise_area, id_category=:id_category, id_expertise=:id_expertise, active=:active WHERE id_expertise=:id_expertise";

  $upd_prep = $dbj->prepare($upd_cat);
  $upd_prep->bindValue(':expertise_area', $_POST['expertise_area']);
  $upd_prep->bindValue(':id_category', $_POST['id_cat_expertise']);
  $upd_prep->bindValue(':id_expertise', $_POST['id_expertise']);
  $upd_prep->bindValue(':active', var_status($_POST['active']));

  $upd_prep->execute();

  // Message type and text
  set_message(3,'Area '.$_POST['expertise_area'].' is updated succesfully');

  // Redirection to the file
  header('Location: upd_expertise.php?id_expertise='.$_POST['id_expertise'].'');
}
?>