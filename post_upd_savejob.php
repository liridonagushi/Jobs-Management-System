<?php
// Including functions
include('admin/assets/include/functions.php');

  // Validating Form
  $error_txt = check_error(check_string_length($_GET['id_job'], 1,10));

  if(!empty($error_txt)){

    // Message type and text
    set_message(2,''.check_error($error_txt).'');

    // Last insert id
    header('Location: '.$_GET['link'].'');

  }else{

  $exist=$dbj->query('SELECT id_job, id_employee FROM saved_jobs WHERE id_job="'.$_GET['id_job'].'" AND id_employee="'.$_SESSION['jbms_front']['id_user'].'"');

  if(!$exist->rowCount()>0){

    $ins_cat = "INSERT INTO saved_jobs (id_job, id_employee) VALUES (:id_job, :id_employee)";

    $ins_prep = $dbj->prepare($ins_cat);
    $ins_prep->bindValue(':id_job', $_GET['id_job']);
    $ins_prep->bindValue(':id_employee', $_SESSION['jbms_front']['id_user']);
    $ins_prep->execute();
    
    $id_cat_expertise = $dbj->lastInsertId();

    // Message type and text
    set_message(3,'Job is successfully saved in your list !');

  }else{

      $revoke = "DELETE FROM saved_jobs WHERE id_job=:id_job AND id_employee=:id_employee";
      $revoke_prep = $dbj->prepare($revoke);
      $revoke_prep->bindValue(':id_job', $_GET['id_job']);
      $revoke_prep->bindValue(':id_employee', $_SESSION['jbms_front']['id_user']);
      $revoke_prep->execute();
      
      $id_cat_expertise = $dbj->lastInsertId();

      // Message type and text
      set_message(3,'Job is successfully removed from list !');
  }

  // Redirection to the file
    header('Location: '.$_GET['link'].'');
}
?>