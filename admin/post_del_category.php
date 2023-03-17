<?php
// Including functions
include('assets/include/functions.php');

// Validating Form
$error_txt = check_error(check_string_length($_GET['id_cat_expertise'], 1, 11));

// Verification existing value
 $category=$dbj->query('SELECT id_category FROM expertises WHERE id_category="'.$_GET['id_cat_expertise'].'"');

 if($category->rowCount()){
  $error_txt='Category '.$_GET['expertise_category'].''.check_error(22);
 }

if(!empty($error_txt)){

  // Message type and text
  set_message(2,''.$error_txt.'');

  header('Location: lst_categories.php#module');

}else{

$del = "DELETE FROM category_expertises WHERE id_cat_expertise=:id_cat_expertise";

$del_prepare = $dbj->prepare($del);
$del_prepare->bindValue(':id_cat_expertise', $_GET['id_cat_expertise']);

$del_prepare->execute();

// Message type and text
set_message(3,'Category '.$_GET['expertise_category'].' is deleted successfully');

// Redirection to the file
header('Location: lst_categories.php#module');
}
?>