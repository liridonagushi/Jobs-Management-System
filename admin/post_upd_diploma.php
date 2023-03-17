<?php
// Including functions
include('assets/include/functions.php');

  // Validating Form
  $error_txt = check_error(check_string_length($_POST['id_type_diploma'], 1, 8));
  $error_txt = check_error(check_string_length($_POST['type_diploma'], 2, 50));

  $verify=$dbj->query('SELECT * FROM diploma_types WHERE type_diploma="'.$_POST['type_diploma'].'" AND id_type_diploma<>"'.$_POST['id_type_diploma'].'"');

  if($verify->rowCount()>0){
    $error_txt=''.$_POST['type_diploma'].' diploma already exists !';
  }

  if(!empty($error_txt)){

    // Message type and text
    set_message(2,''.$error_txt.'');

    // Last insert id
    header('Location: upd_diploma.php?id_type_diploma='.$_POST['id_type_diploma'].'');

  }else{

    $upd_dipl = "UPDATE diploma_types SET type_diploma=:type_diploma, active=:active WHERE id_type_diploma=:id_type_diploma";

    $upd_prep = $dbj->prepare($upd_dipl);
    $upd_prep->bindValue(':id_type_diploma', $_POST['id_type_diploma']);
    $upd_prep->bindValue(':type_diploma', $_POST['type_diploma']);
    $upd_prep->bindValue(':active', var_status($_POST['active']));

    $upd_prep->execute();
    
    // Message type and text
    set_message(3,''.$_POST['type_diploma'].' diploma is successfully updated');

  // Redirection to the file
    header('Location: upd_diploma.php?id_type_diploma='.$_POST['id_type_diploma'].'');
  }
?>