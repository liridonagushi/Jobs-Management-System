<?php
include('admin/assets/include/functions.php');

if(isset($_POST['email'])){
  $email=$_POST['email'];
  $password=$_POST['password'];
}

if(isset($_GET['email'])){
  $email=$_GET['email'];
  $password=$_GET['password'];
}

$error=0;
$txt_msg='';

$log=$dbj->query('SELECT * FROM users WHERE email="'.$email.'" AND password="'.$password.'" AND admin_level="3"');
$verify_user=$log->rowCount();

$row_user=$log->fetch(PDO::FETCH_ASSOC);

// if($row_user['active']=='0'){
//   $verify_user=0;
//   $txt_msg='User is not activated, please reset your password !';
//   $error=1;
// }

if(($verify_user=='0') && ($error=='0')){
  $txt_msg='Email or password is wrong !';
  $error=1;
}

if(($verify_user>0) && ($error=='0')){

  $admin_level=$dbj->query('SELECT id_level FROM admin_levels WHERE id_level="3"');
  $row_admin=$admin_level->fetch(PDO::FETCH_ASSOC);

  $lan=$dbj->query('SELECT * FROM languages WHERE id_language="'.$row_user['id_language'].'"');
  $row_lan=$lan->fetch(PDO::FETCH_ASSOC);

  $currency=$dbj->query('SELECT * FROM currencies WHERE id_currency="'.$row_user['id_currency'].'"');
  $row_currency=$currency->fetch(PDO::FETCH_ASSOC);

  $lang=$dbj->query('SELECT id_language, lang_code FROM languages WHERE id_language="'.$row_user['id_language'].'"');
  $row_lang=$lang->fetch(PDO::FETCH_ASSOC);

  $_SESSION['jbms_front']['id_user']=$row_user['id_user'];
  $_SESSION['jbms_front']['name']=$row_user['name'];
  $_SESSION['jbms_front']['surname']=$row_user['surname'];
  $_SESSION['jbms_front']['email']=$row_user['email'];
  $_SESSION['jbms_front']['currency']=$row_currency['currency'];
  $_SESSION['jbms_front']['title']=$row_user['name'].' '.$row_user['surname'].' - Jobs Management System';


  $_SESSION['jbms_front']['admin_level']=$row_admin['id_level'];

  $_SESSION['jbms_front']['logged_in']='Oui';
  $_SESSION['jbms_front']['directory_profile_img']='admin/assets/images/profile_img/';
  $_SESSION['jbms_front']['directory_logo']='admin/assets/images/logo/';
  $_SESSION['jbms_front']['directory_pdf']='admin/assets/attachments/cv_lm/';

  // Language
  $_SESSION['jbms_front']['lang_code']=$row_lang['lang_code'];

  // Message type and text
  set_message(3,''.$row_user['name'].' is connected !');

  // Redirection to the page
  header('Location: profile.php');
?>


<?php
// Redirection to the page
// header('Location: index.php');
}else{
    // Message type and text
  set_message(2,''.$txt_msg.'');

  // Redirection to the page
  header('Location: sign.php');
}

?>