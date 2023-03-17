<?php
// Including functions
include('assets/include/functions.php');
$error_txt = '';

switch ($_POST['target']) {

case 'company_logo':

$image_name = $_FILES['uploadlogo']['name'];
$image_temp = $_FILES['uploadlogo']['tmp_name'];
$image_size = $_FILES['uploadlogo']['size']; //file size

$error_txt = check_error(image_upload($_POST['id_company'], $image_temp, $image_size), 1, 200);

if (!empty($error_txt)) {

    set_message(2,''.$error_txt.'');

}else{

    set_message(3,'Your logo was successfully updated');

    $upd_logo = "UPDATE companies SET logo_img=:logo_img WHERE id_company=:id_company";

    $logo_upload = $dbj->prepare($upd_logo);
    $logo_upload->bindValue(':logo_img', $_SESSION['temp_img_name']);
    $logo_upload->bindValue(':id_company', $_POST['id_company']);
    
    $logo_upload->execute();
    
    // Empty Session
    unset($_SESSION['temp_img_name']);
}

// Last insert id
header('Location: upd_company.php?id_company='.$_POST['id_company'].'');

break;

case 'company_info':
  // Validating Form
  $error_txt = check_error(check_string_length($_POST['id_company'], 2, 50));
  $error_txt = check_error(check_string_length($_POST['company_name'], 2, 50));
  $error_txt = check_error(check_string_length($_POST['company_sn'], 2, 50));
  $error_txt = check_error(check_string_length($_POST['id_cat_expertise'], 2, 50));
  $error_txt = check_error(check_string_length($_POST['number_employees'], 2, 50));
  $error_txt = check_error(check_string_length($_POST['phone_number'], 1, 10));
  $error_txt = check_error(check_string_length($_POST['id_adress'], 1, 10));
  $error_txt = check_error(check_string_length($_POST['id_country'], 1, 10));

// If the value is received
$check_sn = $dbj->query('SELECT company_sn FROM companies WHERE company_sn="'.$_POST['company_sn'].'" AND id_company<>"'.$_POST['id_company'].'"');
if($check_sn->rowCount()){$error_txt=check_error(20);}

$check_name = $dbj->query('SELECT company_name FROM companies WHERE company_name="'.$_POST['company_name'].'" AND id_company<>"'.$_POST['id_company'].'"');
if($check_name->rowCount()){$error_txt=check_error(21);}

if(!empty($error_txt)){

    // Message type and text
    set_message(2,''.$error_txt.'');

    // Last insert id
    header('Location: upd_company.php?id_company='.$_POST['id_company'].'&collapse=2');

  }else{

  $adress=$dbj->query('SELECT * FROM adresses WHERE id_adress="'.$_POST['id_adress'].'"');

  if ($adress->rowCount()){
    $adress = "UPDATE adresses SET adress=:adress, postal_code=:postal_code, city=:city, id_country=:id_country WHERE id_adress=:id_adress";

    $addr = $dbj->prepare($adress);
    $addr->bindValue(':adress', $_POST['adress']);
    $addr->bindValue(':postal_code', $_POST['postal_code']);
    $addr->bindValue(':city', $_POST['city']);
    $addr->bindValue(':id_country', $_POST['id_country']);
    $addr->bindValue(':id_adress', $_POST['id_adress']);
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

    $upd_comp = "UPDATE companies SET company_name=:company_name, company_sn=:company_sn, id_cat_expertise=:id_cat_expertise, number_employees=:number_employees, phone_number=:phone_number, company_description=:company_description, id_adress=:id_adress, active=:active WHERE id_company=:id_company";

    $upd_prep = $dbj->prepare($upd_comp);
    
    $upd_prep->bindValue(':company_name', $_POST['company_name']);
    $upd_prep->bindValue(':company_sn', $_POST['company_sn']);
    $upd_prep->bindValue(':id_cat_expertise', $_POST['id_cat_expertise']);
    $upd_prep->bindValue(':number_employees', $_POST['number_employees']);
    $upd_prep->bindValue(':phone_number', $_POST['phone_number']);
    $upd_prep->bindValue(':company_description', $_POST['company_description']);
    $upd_prep->bindValue(':id_adress', $_POST['id_adress']);
    $upd_prep->bindValue(':active', var_status($_POST['active']));
    $upd_prep->bindValue(':id_company', $_POST['id_company']);
    $upd_prep->execute();

  // Message type and text
  set_message(3,''.$_POST['company_sn'].' company is successfully updated');

  // Redirection to the file
    header('Location: upd_company.php?id_company='.$_POST['id_company'].'&collapse=2');
  }
    break;

}
?>