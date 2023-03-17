<?php
// Including functions
include('admin/assets/include/functions.php');

  // Validating Form
  $error_txt = check_error(check_string_length($_POST['name'], 2, 20));
  $error_txt = check_error(check_string_length($_POST['surname'], 2, 20));
  $error_txt = check_error(check_email_length($_POST['email'], 2, 50));
  $error_txt = check_error(check_string_length($_POST['password'], 2, 10));


$verify_exist=$dbj->query('SELECT email FROM users WHERE email="'.$_POST['email'].'"');
if($verify_exist->rowCount()){
  $error_txt=19;
}
  if(!empty($error_txt)){

    // Message type and text
    set_message(2,''.check_error($error_txt).'');

    // Last insert id
    header('Location: sign.php');

  }else{

    $ins_user = "INSERT INTO users (name, surname, email, password,  birthday, admin_level) VALUES (:name, :surname, :email, :password, :birthday, :admin_level)";

    $ins_prep = $dbj->prepare($ins_user);
    $ins_prep->bindValue(':name', $_POST['name']);
    $ins_prep->bindValue(':surname', $_POST['surname']);
    $ins_prep->bindValue(':email', $_POST['email']);
    $ins_prep->bindValue(':password', $_POST['password']);
    $ins_prep->bindValue(':birthday', $_POST['birthday']);
    $ins_prep->bindValue(':admin_level', 3);
    $ins_prep->execute();
    
    // Message type and text
    set_message(3,''.$_POST['email'].' is successfully registered');

  // Redirection to the file
    header('Location: post_login.php?email='.$_POST['email'].'&password='.$_POST['password'].'');
  }
?>