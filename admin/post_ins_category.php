<?php
// Including functions
include('assets/include/functions.php');

  // Validating Form
  $error_txt = check_error(check_string_length($_POST['expertise_category'], 2, 80));


$exist=$dbj->query('SELECT expertise_category FROM category_expertises WHERE expertise_category="'.$_POST['expertise_category'].'"');
if($exist->rowCount()){
  $error_txt=10;
}
  if(!empty($error_txt)){

    // Message type and text
    set_message(2,''.$_POST['expertise_category'].' category already exists in the database !');

    // Last insert id
    header('Location: ins_category.php');

  }else{

    $ins_cat = "INSERT INTO category_expertises (expertise_category) VALUES (:expertise_category)";

    $ins_prep = $dbj->prepare($ins_cat);
    $ins_prep->bindValue(':expertise_category', $_POST['expertise_category']);
    $ins_prep->execute();
    
    $id_cat_expertise = $dbj->lastInsertId();

    // Message type and text
    set_message(3,''.$_POST['expertise_category'].' category is successfully inserted');

  // Redirection to the file
    header('Location: upd_category.php?id_cat_expertise='.$id_cat_expertise.'');
  }
?>