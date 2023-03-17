<?php
// Including functions
include('assets/include/functions.php');
$error_txt = '';

switch ($_POST['target']) {

case 'profile_img':

if ($_FILES['profile_img']['tmp_name']){

  $image_name = $_FILES['profile_img']['name'];
  $image_temp = $_FILES['profile_img']['tmp_name'];
  $image_size = $_FILES['profile_img']['size']; //file size
}

if($image_temp){
$img=$dbj->query('SELECT * FROM users WHERE id_user="'.$_SESSION['jbms_back']['id_user'].'"');
$findimg=$img->fetch(PDO::FETCH_ASSOC);

  $error_txt = check_error(image_upload($_SESSION['jbms_back']['id_user'], $image_name, $image_temp, $_SESSION['jbms_back']['directory_profile_img'], $image_size, 'image', $max_size='200000', $max_height='500', $max_width='500', $old_file=$findimg['profile_img']), 1, 200);
}
  
if ($error_txt){
  set_message(2,''.$error_txt.'');
}else{

  if ($_FILES['profile_img']['tmp_name']) {
      $file_db = "UPDATE users SET profile_img=:profile_img WHERE id_user=:id_user";
      $logo_upload = $dbj->prepare($file_db);
      $logo_upload->bindValue(':profile_img', $_SESSION['temp_img_name']);
      $logo_upload->bindValue(':id_user', $_SESSION['jbms_back']['id_user']);
      $logo_upload->execute();
  }

      set_message(3,'Your profile picture was successfully uploaded');
      // Empty Session
      unset($_SESSION['temp_img_name']);

  break;
}


case 'logo_img':

if ($_FILES['logo_img']['tmp_name']){

  $image_name = $_FILES['logo_img']['name'];
  $image_temp = $_FILES['logo_img']['tmp_name'];
  $image_size = $_FILES['logo_img']['size']; //file size
}

if($image_temp){
$img=$dbj->query('SELECT * FROM companies WHERE id_company="'.$_POST['id_company'].'"');
$findimg=$img->fetch(PDO::FETCH_ASSOC);

  $error_txt = check_error(image_upload($_SESSION['jbms_back']['id_user'], $image_name, $image_temp, $_SESSION['jbms_back']['directory_logo'], $image_size, 'image', $max_size='200000', $max_height='500', $max_width='500', $old_file=$findimg['logo_img']), 1, 200);
}

if ($error_txt){
  set_message(2,''.$error_txt.'');
  $collapse=1;
}else{

  if ($_FILES['logo_img']['tmp_name']) {
      $file_db = "UPDATE companies SET logo_img=:logo_img WHERE id_company=:id_company";
      $logo_upload = $dbj->prepare($file_db);
      $logo_upload->bindValue(':logo_img', $_SESSION['temp_img_name']);
      $logo_upload->bindValue(':id_company', $_POST['id_company']);
      $logo_upload->execute();
  }

      set_message(3,'Your company logo was successfully updated !');
      // Empty Session
      unset($_SESSION['temp_img_name']);
      $collapse=1;
  break;
}

}

switch ($_POST['destination']) {

   case 'company':
      // Redirection to file
      header('Location: upd_company.php?id_company='.$_POST['id_company'].'&collapse='.$collapse.'');
   break;

   case 'profile':
      // Redirection to file
      header('Location: account.php');
    break;
}

?>