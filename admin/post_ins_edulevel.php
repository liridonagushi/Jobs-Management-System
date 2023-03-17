<?php
// Including functions
include('assets/include/functions.php');

  // Validating Form
  $error_txt = check_error(check_string_length($_POST['level_education'], 2, 80));


$exist=$dbj->query('SELECT level_education FROM levels_education WHERE level_education="'.$_POST['level_education'].'"');
if($exist->rowCount()){
  $error_txt=10;
}
  if(!empty($error_txt)){

    // Message type and text
    set_message(2,''.$_POST['level_education'].' diploma already exists in the database !');

    // Last insert id
    header('Location: ins_category.php#module');

  }else{

    $ins_cat = "INSERT INTO level_education (level_education) VALUES (:level_education)";

    $ins_prep = $dbj->prepare($ins_cat);
    $ins_prep->bindValue(':level_education', $_POST['level_education']);
    $ins_prep->execute();
    
    $id_level_education = $dbj->lastInsertId();

    // Message type and text
    set_message(3,''.$_POST['level_education'].' category is successfully inserted');

  // Redirection to the file
    header('Location: upd_edulevel.php?id_level_education='.$id_levels_education.'');
  }
?>