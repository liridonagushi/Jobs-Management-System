<?php
// Including functions
include('assets/include/functions.php');

  // Validating Form
  $error_txt = check_error(check_string_length($_POST['id_cat_expertise'], 1, 8));
  $error_txt = check_error(check_string_length($_POST['expertise_area'], 2, 80));


$exist=$dbj->query('SELECT id_category, expertise_area FROM expertises WHERE expertise_area="'.$_POST['expertise_area'].'" AND id_category="'.$_POST['id_cat_expertise'].'"');
if($exist->rowCount()){
  $error_txt=10;
}

if(!empty($error_txt)){

    // Message type and text
    set_message(2,''.$_POST['expertise_area'].' expertise already exists in the database !');

    // Last insert id
    header('Location: ins_expertise.php');

  }else{

    $ins_cat = "INSERT INTO expertises (id_category, expertise_area) VALUES (:id_category, :expertise_area)";

    $ins_prep = $dbj->prepare($ins_cat);
    $ins_prep->bindValue(':id_category', $_POST['id_cat_expertise']);
    $ins_prep->bindValue(':expertise_area', $_POST['expertise_area']);
    $ins_prep->execute();
    
    $id_expertise = $dbj->lastInsertId();

    // Message type and text
    set_message(3,''.$_POST['expertise_area'].' area is successfully inserted');

  // Redirection to the file
    header('Location: upd_expertise.php?id_expertise='.$id_expertise.'');
}
?>