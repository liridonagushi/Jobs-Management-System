<?php
// Including functions
include('admin/assets/include/functions.php');
$error_txt = '';
switch ($_POST['target']) {

case 'cv_lm':

$cvlm=$dbj->query('SELECT * FROM cv_lm WHERE id_user="'.$_SESSION['jbms_front']['id_user'].'"');
$row_cvlm=$cvlm->fetch(PDO::FETCH_ASSOC);



if ($_FILES['cv_code']['tmp_name']){
  $old_file=$row_cvlm['cv_code'];
  $image_name = $_FILES['cv_code']['name'];
  $image_temp = $_FILES['cv_code']['tmp_name'];
  $image_size = $_FILES['cv_code']['size']; //file size

}else if($_FILES['lm_code']['tmp_name']){
  $old_file=$row_cvlm['lm_code'];
  $image_name = $_FILES['lm_code']['name'];
  $image_temp = $_FILES['lm_code']['tmp_name'];
  $image_size = $_FILES['lm_code']['size']; //file size
}

if($image_temp){
    $error_txt = check_error(image_upload($_SESSION['jbms_front']['id_user'], $image_name, $image_temp, $_SESSION['jbms_front']['directory_pdf'], $image_size, 'document', $max_size='200000', $max_height=null, $max_width=null, $old_file), 1, 200);
}

if (!empty($error_txt)){

 set_message(2,$error_txt);
}else{

  if(!($cvlm->rowCount()>=1)){

    $ins_file = "INSERT INTO cv_lm (id_user) VALUES (:id_user)";

    $ins_prep = $dbj->prepare($ins_file);
    $ins_prep->bindValue(':id_user', $_SESSION['jbms_front']['id_user']);
    $ins_prep->execute();
    // $last_id_cv = $conn->lastInsertId();
}
 if ($_FILES['cv_code']['tmp_name']) {
      $file_db = "UPDATE cv_lm SET cv_code=:cv_code WHERE id_user=:id_user";
      $logo_upload = $dbj->prepare($file_db);
      $logo_upload->bindValue(':cv_code', $_SESSION['temp_img_name']);
      $logo_upload->bindValue(':id_user', $_SESSION['jbms_front']['id_user']);
      $logo_upload->execute();

  }else if($_FILES['lm_code']['tmp_name']) {
      $file_db = "UPDATE cv_lm SET lm_code=:lm_code WHERE id_user=:id_user";
      $logo_upload = $dbj->prepare($file_db);
      $logo_upload->bindValue(':lm_code', $_SESSION['temp_img_name']);
      $logo_upload->bindValue(':id_user', $_SESSION['jbms_front']['id_user']);
      $logo_upload->execute();
  }
      set_message(3,'Your file was successfully uploaded');
      // Empty Session
      unset($_SESSION['temp_img_name']);

}
  break;

case 'profile_img':
$img=$dbj->query('SELECT * FROM users WHERE id_user="'.$_SESSION['jbms_front']['id_user'].'"');
$findimg=$img->fetch(PDO::FETCH_ASSOC);

if ($_FILES['profile_img']['tmp_name']){

// if(strlen($row_cvlm['profile_img'])>0){unlink($_SESSION['directory_pdf'].''.$row_cvlm['profile_img'].'');}
  $image_name = $_FILES['profile_img']['name'];
  $image_temp = $_FILES['profile_img']['tmp_name'];
  $image_size = $_FILES['profile_img']['size']; //file size
}


if($image_temp){
  $error_txt = check_error(image_upload($_SESSION['jbms_front']['id_user'], $image_name, $image_temp, $_SESSION['jbms_front']['directory_profile_img'], $image_size, 'image', $max_size='200000', $max_height='500', $max_width='500', $old_file=$findimg['profile_img']), 1, 200);
}
  
if ($error_txt){
    set_message(2,''.$error_txt.'');
}else{
  if(!empty($findimg['profile_img'])){
    unlink($_SESSION['directory_profile_img'].$findimg['profile_img']);
  }

  if ($_FILES['profile_img']['tmp_name']) {
      $file_db = "UPDATE users SET profile_img=:profile_img WHERE id_user=:id_user";
      $logo_upload = $dbj->prepare($file_db);
      $logo_upload->bindValue(':profile_img', $_SESSION['temp_img_name']);
      $logo_upload->bindValue(':id_user', $_SESSION['jbms_front']['id_user']);
      $logo_upload->execute();

  }

      set_message(3,'Your file was successfully uploaded');
      // Empty Session
      unset($_SESSION['temp_img_name']);

}
  break;

}

switch ($_POST['destination']) {

   case 'file_job':
      // Redirection to file
      header('Location: view_job.php?id_job='.$_POST['id_job'].'');
   break;

   case 'profile':
      // Redirection to file
      header('Location: profile.php?collapse='.$_POST['collapse'].'');
    break;
}

?>