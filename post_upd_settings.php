<?php
// Including functions
include('admin/assets/include/functions.php');

$error_txt = '';

switch ($_POST['target']) {

    case 'info':

     // Validating Form
      $error_txt = check_error(check_string_length($_POST['name'], 2, 10));
      $error_txt = check_error(check_string_length($_POST['surname'], 2, 10));

      if(strlen($error_txt)>0){

      // Message type and text
      set_message(2,''.$error_txt.'');

      // Last insert id
       header('Location: account.php?collapse=1');

      }else{

      $upd_pass = "UPDATE users SET name=:name, surname=:surname WHERE id_user=:id_user";

      $upd_prep = $dbj->prepare($upd_pass);
      $upd_prep->bindValue(':id_user', $_SESSION['jbms_front']['id_user']);
      $upd_prep->bindValue(':name', $_POST['name']);
      $upd_prep->bindValue(':surname', $_POST['surname']);

      $upd_prep->execute();

      // Message type and text
      set_message(3,'Privacy updated successfully !');

      // Redirection to the file
       header('Location: account.php?collapse=1');
      }
    break;

  case 'email':
      // Validating Form
      $error_txt = check_error(check_string_length($_POST['email'], 1, 50));

      // Verify email exists
      $verify_email=$dbj->query('SELECT * FROM users WHERE email="'.$_POST['email'].'" AND id_user!="'.$_SESSION['jbms_front']['id_user'].'"');
      
      if($verify_email->rowCount()>0){
        $error_txt = 'This email already exists !';
      }

      if(strlen($error_txt)>0){

      // Message type and text
      set_message(2,''.$error_txt.'');

      // Last insert id
      header('Location: account.php?collapse=2');

      }else{

      $upd_email = "UPDATE users SET email=:email WHERE id_user=:id_user";

      $upd_prep = $dbj->prepare($upd_email);
      $upd_prep->bindValue(':id_user', $_SESSION['jbms_front']['id_user']);
      $upd_prep->bindValue(':email', $_POST['email']);

      $upd_prep->execute();

      // Message type and text
      set_message(3,' Email is updated succesfully');

      // Redirection to the file
      header('Location: account.php?collapse=2');
      }
    break;

  case 'password':
          // Validating Form
      $error_txt = check_error(check_string_length($_POST['password'], 1, 10));

      if(strlen($error_txt)>0){

      // Message type and text
      set_message(2,''.$error_txt.'');

      // Last insert id
       header('Location: account.php');

      }else{

      $upd_pass = "UPDATE users SET password=:password WHERE id_user=:id_user";

      $upd_prep = $dbj->prepare($upd_pass);
      $upd_prep->bindValue(':id_user', $_SESSION['jbms_front']['id_user']);
      $upd_prep->bindValue(':password', $_POST['password']);

      $upd_prep->execute();

      // Message type and text
      set_message(3,'Password is updated succesfully !');

      // Redirection to the file
       header('Location: account.php?collapse=3');
      }
    break;

    case 'language':

    // Validating Form
      $error_txt = check_error(check_string_length($_POST['id_language'], 1, 10));

      if(strlen($error_txt)>0){

      // Message type and text
      set_message(2,''.$error_txt.'');

      // Last insert id
       header('Location: account.php?collapse=4');

      }else{

      $upd_pass = "UPDATE users SET id_language=:id_language WHERE id_user=:id_user";

      $upd_prep = $dbj->prepare($upd_pass);
      $upd_prep->bindValue(':id_user', $_SESSION['jbms_front']['id_user']);
      $upd_prep->bindValue(':id_language', $_POST['id_language']);

      $upd_prep->execute();

      $lang=$dbj->query('SELECT * FROM languages WHERE id_language="'.$_POST['id_language'].'"');
      $row_lang=$lang->fetch(PDO::FETCH_ASSOC);

      $_SESSION['jbms_front']['lang_code']=$row_lang['lang_code'];

      // Message type and text
      set_message(3,'Language updated successfully !');

      // Redirection to the file
       header('Location: account.php?collapse=4');
      }
    break;

      case 'privacy':

    // Validating Form
      // $error_txt = check_error(check_string_length(var_status($_POST['public_profile']), 0, 10));

      if(strlen($error_txt)>0){

      // Message type and text
      set_message(2,''.$error_txt.'');

      // Last insert id
       header('Location: account.php');

      }else{

      $upd_pass = "UPDATE users SET public_profile=:public_profile WHERE id_user=:id_user";

      $upd_prep = $dbj->prepare($upd_pass);
      $upd_prep->bindValue(':id_user', $_SESSION['jbms_front']['id_user']);
      $upd_prep->bindValue(':public_profile', var_status($_POST['public_profile']));

      $upd_prep->execute();

      // Message type and text
      set_message(3,'Privacy updated successfully !');

      // Redirection to the file
       header('Location: account.php?collapse=5');
      }
    break;
}

?>