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
    header('Location: ins_experience.php');

  }else{

    if(empty($_POST['end_date'])){
      $_POST['on_load']=1;
    }else{
      $_POST['on_load']=0;
    }

    $ins_exp = "INSERT INTO working_experiences (id_user, job_title, company_name, id_expertise, description, start_date, end_date, on_load, company_website, company_city, company_state) VALUES (:id_user, :job_title, :company_name, :id_expertise, :description, :start_date, :end_date, :on_load, :company_website, :company_city, :company_state)";

    $ins_prep = $dbj->prepare($ins_exp);
    $ins_prep->bindValue(':id_user', $_SESSION['jbms_front']['id_user']);
    $ins_prep->bindValue(':job_title', $_POST['job_title']);
    $ins_prep->bindValue(':company_name', $_POST['company_name']);
    $ins_prep->bindValue(':id_expertise', $_POST['id_expertise']);
    $ins_prep->bindValue(':description', $_POST['description']);
    $ins_prep->bindValue(':start_date', $_POST['start_date']);
    $ins_prep->bindValue(':end_date', $_POST['end_date']);
    $ins_prep->bindValue(':on_load', $_POST['on_load']);
    $ins_prep->bindValue(':company_website', $_POST['company_website']);
    $ins_prep->bindValue(':company_city', $_POST['company_city']);
    $ins_prep->bindValue(':company_state', $_POST['company_state']);

    $ins_prep->execute();
    
    $id_experience = $dbj->lastInsertId();

    // Message type and text
    set_message(3,''.$_POST['job_title'].' experience is successfully inserted');

  // Redirection to the file
    header('Location: profile.php?collapse=4#work_exp');
  }
?>