<?php
// Including functions
include('assets/include/functions.php');

// Validating Form
$error_txt = check_error(check_string_length($_POST['type_diploma'], 1, 50));

$verify=$dbj->query('SELECT * FROM diploma_types WHERE type_diploma="'.$_POST['type_diploma'].'"');

if($verify->rowCount()>0){
  $error_txt=''.$_POST['type_diploma'].' diploma already exists !';
}

if(!empty($error_txt)){
  // Message type and text
  set_message(2,''.$error_txt.'');

  // Last insert id
  header('Location: ins_diploma.php');

}else{

  $ins_dipl = "INSERT INTO diploma_types (type_diploma) VALUES (:type_diploma)";

  $ins_prep = $dbj->prepare($ins_dipl);
  $ins_prep->bindValue(':type_diploma', $_POST['type_diploma']);

  $ins_prep->execute();

  $id_diploma = $dbj->lastInsertId();
  
  // Message type and text
  set_message(3,''.$_POST['title_diploma'].' diploma is successfully inserted');

// Redirection to the file
  header('Location: upd_diploma.php?id_type_diploma='.$id_diploma.'');
}
?>