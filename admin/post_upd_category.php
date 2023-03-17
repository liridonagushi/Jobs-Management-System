<?php
// Including functions
include('assets/include/functions.php');

$error_txt = '';

// Validating Form
$error_txt = check_error(check_string_length($_POST['id_cat_expertise'], 1, 8));
$error_txt = check_error(check_string_length($_POST['expertise_category'], 2, 80));

$exist=$dbj->query('SELECT expertise_category FROM category_expertises WHERE expertise_category="'.$_POST['expertise_category'].'" AND id_cat_expertise<>"'.$_POST['id_cat_expertise'].'"');
if($exist->rowCount()){
  $error_txt=10;
}
  if(!empty($error_txt)){

// Message type and text
set_message(2,''.$_POST['expertise_category'].' category already exists in the database !');

  // Last insert id
  header('Location: upd_category.php?id_cat_expertise='.$_POST['id_cat_expertise'].'');

}else{

  $upd_cat = "UPDATE category_expertises SET expertise_category=:expertise_category, active=:active WHERE id_cat_expertise=:id_cat_expertise";

  $upd_prep = $dbj->prepare($upd_cat);
  $upd_prep->bindValue(':expertise_category', $_POST['expertise_category']);
  $upd_prep->bindValue(':id_cat_expertise', $_POST['id_cat_expertise']);
  $upd_prep->bindValue(':active', var_status($_POST['active']));

  $upd_prep->execute();

  // Message type and text
  set_message(3,'Category '.$_POST['expertise_category'].' is updated succesfully');

// Redirection to the file
  header('Location: upd_category.php?id_cat_expertise='.$_POST['id_cat_expertise'].'');
}
?>