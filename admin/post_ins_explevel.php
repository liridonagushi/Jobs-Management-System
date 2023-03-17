<?php
// Including functions
include('assets/include/functions.php');

  // Validating Form
  $error_txt = check_string_length($_POST['level_experience'], 2, 80);
  $error_txt = check_string_length($_POST['years_experience'], 2, 10);


$exist=$dbj->query('SELECT level_experience FROM levels_experience WHERE level_experience="'.$_POST['level_experience'].'"');
if($exist->rowCount()){
  $error_txt=''.$_POST['level_experience'].' already exists in the database !';
}

if(!empty($error_txt)){

    // Message type and text
    set_message(2,''.$error_txt.'');

    // Last insert id
    header('Location: ins_explevel.php');

  }else{

    $ins_cat = "INSERT INTO levels_experience (level_experience, years_experience) VALUES (:level_experience, :years_experience)";

    $ins_prep = $dbj->prepare($ins_cat);
    $ins_prep->bindValue(':level_experience', $_POST['level_experience']);
    $ins_prep->bindValue(':years_experience', $_POST['years_experience']);
    $ins_prep->execute();
    
    $id_level_experience = $dbj->lastInsertId();

    // Message type and text
    set_message(3,''.$_POST['level_experience'].' level is successfully inserted');

  // Redirection to the file
    header('Location: upd_explevel.php?id_level_experience='.$id_level_experience.'');
  }
?>