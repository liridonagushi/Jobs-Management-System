<?php
// Including functions
include('assets/include/functions.php');

  // Validating Form
  $error_txt = check_error(check_string_length($_POST['company_name'], 2, 50));
  $error_txt = check_error(check_string_length($_POST['company_sn'], 2, 50));
  $error_txt = check_error(check_string_length($_POST['id_cat_expertise'], 1, 10));
  $error_txt = check_error(check_string_length($_POST['number_employees'], 1, 20));
  $error_txt = check_error(check_string_length($_POST['id_adress'], 1, 10));
  $error_txt = check_error(check_string_length($_POST['id_country'], 1, 10));

// If the value is received
$check_sn = $dbj->query('SELECT company_sn FROM companies WHERE id_employer="'.$_SESSION['jbms_back']['id_user'].'" AND company_sn="'.$_POST['company_sn'].'"');
if($check_sn->rowCount()>0){$error_txt=check_error(20);}

$check_name = $dbj->query('SELECT company_name FROM companies WHERE id_employer="'.$_SESSION['jbms_back']['id_user'].'" AND company_name="'.$_POST['company_name'].'"');
if($check_name->rowCount()>0){$error_txt=check_error(21);}

  if(!empty($error_txt)){

    // Message type and text
    set_message(2,''.$error_txt.'');

    // Last insert id
    header('Location: ins_company.php');

  }else{

    $adress = "INSERT INTO adresses (adress, postal_code, city, id_country) VALUES (:adress,:postal_code,:city,:id_country)";

    $addr = $dbj->prepare($adress);
    $addr->bindValue(':adress', $_POST['adress']);
    $addr->bindValue(':postal_code', $_POST['postal_code']);
    $addr->bindValue(':city', $_POST['city']);
    $addr->bindValue(':id_country', $_POST['id_country']);
    $addr->execute();

    $_POST['id_adress'] = $dbj->lastInsertId();

    $upd_comp = "INSERT INTO companies (id_employer, company_name, company_sn, id_cat_expertise, number_employees, phone_number, id_adress) VALUES(:id_employer, :company_name, :company_sn, :id_cat_expertise, :number_employees, :phone_number, :id_adress)";

    $upd_prep = $dbj->prepare($upd_comp);
    $upd_prep->bindValue(':id_employer', $_SESSION['jbms_back']['id_user']);
    $upd_prep->bindValue(':company_name', $_POST['company_name']);
    $upd_prep->bindValue(':company_sn', $_POST['company_sn']);
    $upd_prep->bindValue(':id_cat_expertise', $_POST['id_cat_expertise']);
    $upd_prep->bindValue(':number_employees', $_POST['number_employees']);
    $upd_prep->bindValue(':phone_number', $_POST['phone_number']);
    $upd_prep->bindValue(':id_adress', $_POST['id_adress']);
    $upd_prep->execute();
    
    $id_company = $dbj->lastInsertId();

    // Message type and text
    set_message(3,''.$_POST['company_name'].' company is successfully inserted');

  // Redirection to the file
    header('Location: upd_company.php?id_company='.$id_company.'#adress');
  }
?>