<?php
// Including functions
include('admin/assets/include/functions.php');

  // Validating Form
  $error_txt = check_error(check_string_length($_POST['id_diploma_user'], 1, 10));
  $error_txt = check_error(check_string_length($_POST['id_level_education'], 1, 10));
  $error_txt = check_error(check_string_length($_POST['id_type_diploma'], 1, 8));
  $error_txt = check_error(check_string_length($_POST['title_diploma'], 2, 80));
  $error_txt = check_error(check_string_length($_POST['date_started'], 1, 10));

  if(!empty($error_txt)){

    // Message type and text
    set_message(2,''.$error_txt.'');

    // Last insert id
    header('Location: ins_diploma.php');

  }else{

  if(empty($_POST['date_finished'])){
    $_POST['on_load']=1;
  }else{
    $_POST['on_load']=0;
  }
    $upd_dipl = "UPDATE diploma_users SET id_level_education=:id_level_education, id_type_diploma=:id_type_diploma, title_diploma=:title_diploma, date_started=:date_started, date_finished=:date_finished, on_load=:on_load, active=:active WHERE id_diploma_user=:id_diploma_user";

    $upd_prep = $dbj->prepare($upd_dipl);
    $upd_prep->bindValue(':id_diploma_user', $_POST['id_diploma_user']);
    $upd_prep->bindValue(':id_level_education', $_POST['id_level_education']);
    $upd_prep->bindValue(':id_type_diploma', $_POST['id_type_diploma']);
    $upd_prep->bindValue(':title_diploma', $_POST['title_diploma']);
    $upd_prep->bindValue(':date_started', $_POST['date_started']);
    $upd_prep->bindValue(':date_finished', $_POST['date_finished']);
    $upd_prep->bindValue(':on_load', $_POST['on_load']);
    $upd_prep->bindValue(':active', var_status($_POST['active']));
    $upd_prep->execute();
    
    // Message type and text
    set_message(3,''.$_POST['title_diploma'].' diploma is successfully updated');

  // Redirection to the file
    header('Location: upd_diploma.php?id_diploma_user='.$_POST['id_diploma_user'].'');
  }
?>