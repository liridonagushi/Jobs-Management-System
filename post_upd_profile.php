<?php
// Including functions
include('admin/assets/include/functions.php');
$error_txt = '';
// Validating Form
$error_txt = check_error(check_string_length($_POST['adress'], 2, 50));
$error_txt = check_error(check_string_length($_POST['postal_code'], 2, 50));
$error_txt = check_error(check_string_length($_POST['city'], 2, 50));

if(strlen($error_txt)>0){

  // Message type and text
  set_message(2,''.$error_txt.'');

  // Last insert id
  header('Location: profile.php');

}else{

$adress=$dbj->query('SELECT * FROM adresses WHERE id_adress="'.$_POST['id_adress'].'"');
$find_adress=$adress->rowCount();

if ($find_adress>0){
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

  $upd = "UPDATE users SET phone_number=:phone_number, id_adress=:id_adress, birthday=:birthday, id_gender=:id_gender WHERE id_user=:id_user";

  $stmt = $dbj->prepare($upd);
  $stmt->bindValue(':phone_number', $_POST['phone_number']);
  $stmt->bindValue(':id_adress', $_POST['id_adress']);
  $stmt->bindValue(':birthday', $_POST['birthday']);
  $stmt->bindValue(':id_gender', $_POST['id_gender']);
  $stmt->bindValue(':id_user', $_SESSION['jbms_front']['id_user']);
  $stmt->execute();

// Message type and text
set_message(3,'Details successfully updated');

// Redirection to the file
  header('Location: profile.php?collapse=2');
}

?>