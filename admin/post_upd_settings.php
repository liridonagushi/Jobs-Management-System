<?php
// Including functions
include('assets/include/functions.php');

$error_txt = '';

switch ($_POST['target']) {

    case 'info':

$error_txt = '';
// Validating Form
$error_txt = check_error(check_string_length($_POST['name'], 2, 50));
$error_txt = check_error(check_string_length($_POST['surname'], 2, 50));
$error_txt = check_error(check_string_length($_POST['adress'], 2, 50));
$error_txt = check_error(check_string_length($_POST['postal_code'], 2, 50));
$error_txt = check_error(check_string_length($_POST['city'], 2, 50));
$error_txt = check_error(check_string_length($_POST['id_country'], 1, 10));

if(strlen($error_txt)>0){

  // Message type and text
  set_message(2,''.$error_txt.'');

  // Last insert id
  header('Location: account.php');

}else{


$adress=$dbj->query('SELECT * FROM adresses WHERE id_adress="'.$_POST['id_adress'].'"');

if ($adress->rowCount()){
  $adress = "UPDATE adresses SET adress=:adress, postal_code=:postal_code, city=:city, id_country=:id_country WHERE id_adress=:id_adress";

  $addr = $dbj->prepare($adress);
  $addr->bindValue(':adress', $_POST['adress']);
  $addr->bindValue(':postal_code', $_POST['postal_code']);
  $addr->bindValue(':city', $_POST['city']);
  $addr->bindValue(':id_adress', $_POST['id_adress']);
  $addr->bindValue(':id_country', $_POST['id_country']);
  $addr->execute();
  
}else{
  $adress = "INSERT INTO adresses (adress, postal_code, city, id_country) VALUES (:adress,:postal_code,:city,:id_country)";

  $addr = $dbj->prepare($adress);
  $addr->bindValue(':adress', $_POST['adress']);
  $addr->bindValue(':postal_code', $_POST['postal_code']);
  $addr->bindValue(':city', $_POST['city']);
  $addr->bindValue(':id_country', $_POST['id_country']);
  $addr->execute();

  $_POST['id_adress'] = $dbj->lastInsertId();
}

  $ins = "UPDATE users SET name=:name, surname=:surname, id_adress=:id_adress, birthday=:birthday, phone_number=:phone_number, id_gender=:id_gender WHERE id_user=:id_user";

  $stmt = $dbj->prepare($ins);
  $stmt->bindValue(':name', $_POST['name']);
  $stmt->bindValue(':surname', $_POST['surname']);
  $stmt->bindValue(':id_adress', $_POST['id_adress']);
  $stmt->bindValue(':birthday', $_POST['birthday']);
  $stmt->bindValue(':phone_number', $_POST['phone_number']);
  $stmt->bindValue(':id_gender', $_POST['id_gender']);
  $stmt->bindValue(':id_user', $_SESSION['jbms_back']['id_user']);
  $stmt->execute(); 

// Message type and text
set_message(3,''.$_POST['name'].' '.$_POST['surname'].' is successfully updated');

// Redirection to the file
  header('Location: account.php?collapse=2');
}
    break;

  case 'email':
      // Validating Form
      $error_txt = check_error(check_string_length($_POST['email'], 1, 50));

      // Verify email exists
      $verify_email=$dbj->query('SELECT * FROM users WHERE email="'.$_POST['email'].'" AND id_user!="'.$_SESSION['jbms_back']['id_user'].'"');
      
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
      $upd_prep->bindValue(':id_user', $_SESSION['jbms_back']['id_user']);
      $upd_prep->bindValue(':email', $_POST['email']);

      $upd_prep->execute();

      // Message type and text
      set_message(3,' Email is updated succesfully');

      // Redirection to the file
      header('Location: account.php?collapse=3');
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
      $upd_prep->bindValue(':id_user', $_SESSION['jbms_back']['id_user']);
      $upd_prep->bindValue(':password', $_POST['password']);

      $upd_prep->execute();

      // Message type and text
      set_message(3,'Password is updated succesfully !');

      // Redirection to the file
       header('Location: account.php?collapse=4');
      }
    break;

      case 'fanpage':

    // Validating Form
      $error_txt = check_error(check_string_length($_POST['http_direction'], 1, 80));

      if(strlen($error_txt)>0){

      // Message type and text
      set_message(2,''.$error_txt.'');

      // Last insert id
       header('Location: account.php?collapse=5');

      }else{

      if(isset($_POST['showpage']) && ($_POST['showpage']=='show')){
      $active=1;
      }else if(isset($_POST['showpage']) && ($_POST['showpage']=='hide')){
      $active=0;
      }

      if(isset($_POST['showpage'])){
      $upd_fanpage = "UPDATE social_fanpages SET active=:active WHERE id_fanpage=:id_fanpage";

      $upd_prep = $dbj->prepare($upd_fanpage);
      $upd_prep->bindValue(':id_fanpage', $_POST['id_fanpage']);
      $upd_prep->bindValue(':active', $active);
      }else{
      $upd_fanpage = "UPDATE social_fanpages SET http_direction=:http_direction WHERE id_fanpage=:id_fanpage";

      $upd_prep = $dbj->prepare($upd_fanpage);
      $upd_prep->bindValue(':id_fanpage', $_POST['id_fanpage']);
      $upd_prep->bindValue(':http_direction', $_POST['http_direction']);
      }

      $upd_prep->execute();

      // Message type and text
      set_message(3,'Privacy updated successfully !');

      // Redirection to the file
       header('Location: account.php?collapse=5');
      }
    break;

      case 'privacy':

    // Validating Form
      // $error_txt = check_error(check_string_length(var_status($_POST['public_profile']), 0, 10));

      if(strlen($error_txt)>0){

      // Message type and text
      set_message(2,''.$error_txt.'');

      // Last insert id
       header('Location: account.php?collapse=6');

      }else{

      $upd_pass = "UPDATE users SET public_profile=:public_profile WHERE id_user=:id_user";

      $upd_prep = $dbj->prepare($upd_pass);
      $upd_prep->bindValue(':id_user', $_SESSION['jbms_back']['id_user']);
      $upd_prep->bindValue(':public_profile', var_status($_POST['public_profile']));

      $upd_prep->execute();

      // Message type and text
      set_message(3,'Privacy updated successfully !');

      // Redirection to the file
       header('Location: account.php?collapse=6');
      }
    break;
}


?>