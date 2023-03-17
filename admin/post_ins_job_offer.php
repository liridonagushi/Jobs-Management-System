<?php
// Including functions
include('assets/include/functions.php');

$error_txt = '';

// Validating Form
$error_txt = check_error(check_string_length($_POST['id_expertise'], 1, 10));
$error_txt = check_error(check_string_length($_POST['id_level_education'], 0, 10));
$error_txt = check_error(check_string_length($_POST['id_level_experience'], 0, 10));
$error_txt = check_error(check_string_length($_POST['id_company'], 1, 10));
$error_txt = check_error(check_string_length($_POST['job_title'], 2, 50));
$error_txt = check_error(check_string_length($_POST['job_description'], 20, 800));

if(!empty($error_txt)){

  // Message type and text
  set_message(2,''.$error_txt.'');

  // Last insert id
  header('Location: ins_job_offer.php');

}else{
  
$job_sn=rand(100,500).$_POST['id_company'];

$_POST['closing_date']=date('Y-m-d', strtotime("+1 month"));

$ins_job = "INSERT INTO job_offers (id_expertise, id_level_education, id_level_experience, id_company, job_sn, job_title, id_salary, job_type, closing_date, job_description) VALUES (:id_expertise, :id_level_education, :id_level_experience, :id_company,  :job_sn, :job_title,  :id_salary, :job_type, :closing_date, :job_description)";

$ins_job = $dbj->prepare($ins_job);
$ins_job->bindValue(':id_expertise', $_POST['id_expertise']);
$ins_job->bindValue(':id_level_education', $_POST['id_level_education']);
$ins_job->bindValue(':id_level_experience', $_POST['id_level_experience']);
$ins_job->bindValue(':id_company', $_POST['id_company']);
$ins_job->bindValue(':job_sn', $job_sn);
$ins_job->bindValue(':job_title', $_POST['job_title']);
$ins_job->bindValue(':id_salary', $_POST['id_salary']);
$ins_job->bindValue(':job_type', $_POST['job_type']);
$ins_job->bindValue(':closing_date', $_POST['closing_date']);
$ins_job->bindValue(':job_description', $_POST['job_description']);

$ins_job->execute();

$id_job = $dbj->lastInsertId();


  // Message type and text
  set_message(3,'A new job opportunity is inserted succesfully');

// Redirection to the file
  header('Location: upd_job_offer.php?id_job='.$id_job.'');
}
?>