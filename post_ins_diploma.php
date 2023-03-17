<?php
// Including functions
include('admin/assets/include/functions.php');

  // Validating Form
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

    $ins_dipl = "INSERT INTO diploma_users (id_user, id_level_education, id_type_diploma,  title_diploma, date_started, date_finished, on_load) VALUES (:id_user, :id_level_education, :id_type_diploma, :title_diploma, :date_started, :date_finished, :on_load)";

    $ins_prep = $dbj->prepare($ins_dipl);
    $ins_prep->bindValue(':id_user', $_SESSION['jbms_front']['id_user']);
    $ins_prep->bindValue(':id_level_education', $_POST['id_level_education']);
    $ins_prep->bindValue(':id_type_diploma', $_POST['id_type_diploma']);
    $ins_prep->bindValue(':title_diploma', $_POST['title_diploma']);
    $ins_prep->bindValue(':date_started', $_POST['date_started']);
    $ins_prep->bindValue(':date_finished', $_POST['date_finished']);
    $ins_prep->bindValue(':on_load', $_POST['on_load']);

    $ins_prep->execute();

    $id_diploma_user = $dbj->lastInsertId();
    
// Message type and text
    set_message(3,''.$_POST['title_diploma'].' diploma is successfully inserted');

  // Redirection to the file
    header('Location: profile.php?collapse=3');
  }
?>