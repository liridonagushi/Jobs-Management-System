<?php
// Including functions
include('assets/include/functions.php');

$error_txt = '';

// Validating Form
$error_txt = check_error(check_string_length($_POST['id_job'], 1, 10));
$error_txt = check_error(check_string_length($_POST['id_level_education'], 1, 10));
$error_txt = check_error(check_string_length($_POST['id_level_experience'], 1, 10));
$error_txt = check_error(check_string_length($_POST['id_expertise'], 1, 10));
$error_txt = check_error(check_string_length($_POST['id_company'], 1, 10));
$error_txt = check_error(check_string_length($_POST['closing_date'], 1, 10));
$error_txt = check_error(check_string_length($_POST['job_title'], 2, 50));
$error_txt = check_error(check_string_length($_POST['id_salary'], 1, 50));
$error_txt = check_error(check_string_length($_POST['job_description'], 20, 800));

if(strlen($error_txt)>0){

  // Message type and text
  set_message(2,''.$error_txt.'');

  // Last insert id
  header('Location: index.php');

}else{

  $job_offer = "UPDATE job_offers SET id_expertise=:id_expertise, id_company=:id_company, closing_date=:closing_date, job_title=:job_title, id_level_education=:id_level_education, id_level_experience=:id_level_experience, id_salary=:id_salary, job_description=:job_description WHERE id_job=:id_job";

  $upd_prep = $dbj->prepare($job_offer);
  $upd_prep->bindValue(':id_expertise', $_POST['id_expertise']);
  $upd_prep->bindValue(':id_company', $_POST['id_company']);
  $upd_prep->bindValue(':id_job', $_POST['id_job']);
  $upd_prep->bindValue(':closing_date', $_POST['closing_date']);
  $upd_prep->bindValue(':job_title', $_POST['job_title']);
  $upd_prep->bindValue(':id_level_education', $_POST['id_level_education']);
  $upd_prep->bindValue(':id_level_experience', $_POST['id_level_experience']);
  $upd_prep->bindValue(':id_salary', $_POST['id_salary']);
  $upd_prep->bindValue(':job_description', $_POST['job_description']);
  $upd_prep->execute();

  // Message type and text
  set_message(3,'Job Offer \"'.$_POST['job_title'].'\" is updated succesfully');

// Redirection to the file
  header('Location: upd_job_offer.php?id_job='.$_POST['id_job'].'');
}
?>