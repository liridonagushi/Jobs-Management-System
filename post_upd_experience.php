<?php
// Including functions
include('admin/assets/include/functions.php');

  // Validating Form
  $error_txt = check_error(check_string_length($_POST['job_title'], 2, 80));
  $error_txt = check_error(check_string_length($_POST['company_name'], 2, 50));
  $error_txt = check_error(check_string_length($_POST['company_website'], 0, 80));
  $error_txt = check_error(check_string_length($_POST['company_city'], 0, 50));
  $error_txt = check_error(check_string_length($_POST['company_state'], 0, 50));
  $error_txt = check_error(check_string_length($_POST['id_expertise'], 1, 10));
  $error_txt = check_error(check_string_length($_POST['start_date'], 1, 10));

  if(!empty($error_txt)){

    // Message type and text
    set_message(2,''.$error_txt.'');

    // Last insert id
    header('Location: ins_diploma.php');

  }else{

  if(empty($_POST['end_date'])){
    $_POST['on_load']=1;
  }else{
    $_POST['on_load']=0;
  }

    $upd_exp = "UPDATE working_experiences SET job_title=:job_title, company_name=:company_name, company_website=:company_website, company_city=:company_city, company_state=:company_state, id_expertise=:id_expertise, start_date=:start_date, end_date=:end_date, on_load=:on_load, description=:description WHERE id_experience=:id_experience";

    $upd_prep = $dbj->prepare($upd_exp);
    $upd_prep->bindValue(':job_title', $_POST['job_title']);
    $upd_prep->bindValue(':company_name', $_POST['company_name']);
    $upd_prep->bindValue(':company_website', $_POST['company_website']);
    $upd_prep->bindValue(':company_city', $_POST['company_city']);
    $upd_prep->bindValue(':company_state', $_POST['company_state']);
    $upd_prep->bindValue(':id_expertise', $_POST['id_expertise']);
    $upd_prep->bindValue(':start_date', $_POST['start_date']);
    $upd_prep->bindValue(':end_date', $_POST['end_date']);
    $upd_prep->bindValue(':on_load', $_POST['on_load']);
    $upd_prep->bindValue(':description', $_POST['description']);
    $upd_prep->bindValue(':id_experience', $_POST['id_experience']);


    $upd_prep->execute();
    
    // Message type and text
    set_message(3,''.$_POST['title_diploma'].' diploma is successfully inserted');

  // Redirection to the file
    header('Location: upd_experience.php?id_experience='.$_POST['id_experience'].'');
  }
?>