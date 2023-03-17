<?php
// Including functions
include('assets/include/functions.php');
$error_txt = '';
// Validating Form
$error_txt = check_error(check_string_length($_POST['name'], 2, 50));
$error_txt = check_error(check_string_length($_POST['surname'], 2, 50));
$error_txt = check_error(check_string_length($_POST['adress'], 2, 50));
$error_txt = check_error(check_string_length($_POST['postal_code'], 2, 50));
$error_txt = check_error(check_string_length($_POST['city'], 2, 50));
$error_txt = check_error(check_string_length($_POST['id_country'], 1, 10));
$error_txt = check_error(check_string_length($_POST['id_cat_expertise'], 1, 10));
$error_txt = check_error(check_string_length($_POST['id_expertise'], 1, 10));

if(strlen($error_txt)>0){

  // Message type and text
  set_message(2,''.$error_txt.'');

  // Last insert id
  header('Location: index.php');

}else{

$adress=$dbj->query('SELECT * FROM adresses WHERE id_adress="'.$_POST['id_adress'].'"');
$find_adress=$adress->rowCount();

if ($find_adress>0){
  $updadress = "UPDATE adresses SET adress=:adress, postal_code=:postal_code, city=:city, id_country=:id_country WHERE id_adress=:id_adress";

  $addr = $dbj->prepare($updadress);
  $addr->bindValue(':adress', $_POST['adress']);
  $addr->bindValue(':postal_code', $_POST['postal_code']);
  $addr->bindValue(':city', $_POST['city']);
  $addr->bindValue(':id_adress', $_POST['id_adress']);
  $addr->bindValue(':id_country', $_POST['id_country']);
  $addr->execute();
}else{
  $insadress = "INSERT INTO adresses (adress, postal_code, city, id_country) VALUES (:adress,:postal_code,:city,:id_country)";

  $addr = $dbj->prepare($insadress);
  $addr->bindValue(':adress', $_POST['adress']);
  $addr->bindValue(':postal_code', $_POST['postal_code']);
  $addr->bindValue(':city', $_POST['city']);
  $addr->bindValue(':id_country', $_POST['id_country']);
  $addr->execute();

  $_POST['id_adress'] = $dbj->lastInsertId();
}

  $upduser = "UPDATE users SET name=:name, surname=:surname, id_adress=:id_adress, id_expertise=:id_expertise, birthday=:birthday, email=:email, phone_number=:phone_number, sex=:sex WHERE id_user=:id_user";

  $stmt = $dbj->prepare($upduser);
  $stmt->bindValue(':name', $_POST['name']);
  $stmt->bindValue(':surname', $_POST['surname']);
  $stmt->bindValue(':id_adress', $_POST['id_adress']);
  $stmt->bindValue(':id_expertise', $_POST['id_expertise']);
  $stmt->bindValue(':birthday', $_POST['birthday']);
  $stmt->bindValue(':email', $_POST['email']);
  $stmt->bindValue(':phone_number', $_POST['phone_number']);
  $stmt->bindValue(':sex', $_POST['sex']);
  $stmt->bindValue(':id_user', $_SESSION['jbms_back']['id_user']);
  $stmt->execute(); 

// Message type and text
set_message(3,''.$_POST['name'].' '.$_POST['surname'].' is successfully updated');

// Redirection to the file
  header('Location: index.php');
}
?>