<?php
// Including functions
include('admin/assets/include/functions.php');

// Validating Form
$error_txt = check_error(check_string_length($_POST['id_job'], 1, 10));
$error_txt = check_error(check_string_length($_POST['cv_code'], 1, 80));
$error_txt = check_error(check_string_length($_POST['lm_code'], 1, 80));


$exist=$dbj->query('SELECT id_candidature FROM job_candidatures WHERE id_job="'.$_POST['id_job'].'" AND id_employee="'.$_SESSION['jbms_front']['id_user'].'"');
if($exist->rowCount()){
  $error_txt=10;
}
  if(!empty($error_txt)){

    // Message type and text
    set_message(2,''.check_error($error_txt).'');

    // Last insert id
    header('Location: ins_category.php');

  }else{

    $apply = "INSERT INTO job_candidatures (id_job, id_company, id_employee, motivation_words) VALUES (:id_job, :id_company, :id_employee, :motivation_words)";

    $job_appl = $dbj->prepare($apply);
    $job_appl->bindValue(':id_job', $_POST['id_job']);
    $job_appl->bindValue(':id_company', $_POST['id_company']);
    $job_appl->bindValue(':id_employee', $_SESSION['jbms_front']['id_user']);
    $job_appl->bindValue(':motivation_words', $_POST['motivation_words']);
    $job_appl->execute();
    
    $id_candidature = $dbj->lastInsertId();

    // Message type and text
    set_message(3,'You application is made successfully !');

  // Redirection to the file
    header('Location: view_job.php?id_job='.$_POST['id_job'].'');
  }
?>