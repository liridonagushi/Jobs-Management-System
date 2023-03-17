<?php
// Including functions
require_once('assets/include/functions.php');

// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('assets/include/variables.php');



if($_POST['email']){
  $email=$_POST['email'];
  $password=$_POST['password'];
}

if($_GET['email']){
  $email=$_GET['email'];
  $password=$_GET['password'];
}

$error=0;
$txt_msg='';

$log=$dbj->query('SELECT * FROM users WHERE ((email="'.$email.'" AND password="'.$password.'") AND ((admin_level="1")OR(admin_level="2")))');
$verify_user=$log->rowCount();

$row_user=$log->fetch(PDO::FETCH_ASSOC);

// Checking if the user is banned before
$checkban=$dbj->query('SELECT * FROM banned_users WHERE id_user_banned="'.$row_user['id_user'].'"');
// Showing details
$row_ban=$checkban->fetch(PDO::FETCH_ASSOC);

if($row_user['active']=='0'){
  $verify_user=0;
  $txt_msg='User is not activated, please reset your password !';
  $error=1;
}

if(($verify_user=='0') && ($error=='0')){
  $txt_msg='Email or password do not match !';
  $error=1;
}

if(($log->rowCount()>0)&&(date('Y-m-d',strtotime($row_ban['ban_date']))>=date('Y-m-d'))){
  $txt_msg='User '.$row_user['surname'].' is banned since '.date('d-m-Y',strtotime($row_ban['ban_date'])).', for '.$row_ban['ban_period_days'].' days.<br /> Please contact Help Desk to remove the ban limit !';
  $error=1;
}

if(($verify_user>0) && ($error=='0')){

$admin_level=$dbj->query('SELECT id_level FROM admin_levels WHERE id_level="'.$row_user['admin_level'].'"');
$row_admin=$admin_level->fetch(PDO::FETCH_ASSOC);

$lang=$dbj->query('SELECT id_language, lang_code FROM languages WHERE id_language="'.$row_user['id_language'].'"');
$row_lang=$lang->fetch(PDO::FETCH_ASSOC);

$currency=$dbj->query('SELECT * FROM currencies WHERE id_currency="'.$row_user['id_currency'].'"');
$row_currency=$currency->fetch(PDO::FETCH_ASSOC);


$_SESSION['jbms_back']['id_user']=$row_user['id_user'];
$_SESSION['jbms_back']['name']=$row_user['name'];
$_SESSION['jbms_back']['surname']=$row_user['surname'];
$_SESSION['jbms_back']['email']=$row_user['email'];
$_SESSION['jbms_back']['currency']=$row_currency['symbol'];
$_SESSION['jbms_back']['title']=$row_user['name'].' '.$row_user['surname'].' - Jobs Management System';

$_SESSION['jbms_back']['company_name']=$row_company['company_name'];
$_SESSION['jbms_back']['admin_level']=$row_admin['id_level'];

$_SESSION['jbms_back']['logged_in']='Oui';
$_SESSION['jbms_back']['directory_profile_img']='assets/images/profile_img/';
$_SESSION['jbms_back']['directory_logo']='assets/images/logo/';
$_SESSION['jbms_back']['directory_pdf']='assets/attachments/cv_lm/';
$_SESSION['jbms_back']['images']='assets/images/';

$_SESSION['jbms_back_companies']['search_query']="";
$_SESSION['jbms_back_companies']['orderby']="";
$_SESSION['jbms_back_companies']['search_key']="";

// Language
$_SESSION['jbms_front']['lang_code']=$row_lang['lang_code'];

$_SESSION['jbms_back_job_offers']['search_query']="";
$_SESSION['jbms_back_job_offers']['orderby']="";
$_SESSION['jbms_back_job_offers']['search_key']="";
$_SESSION['jbms_back_job_offers']['id_expertise']="";

$_SESSION['jbms_back_favourites']['search_query']='';
$_SESSION['jbms_back_favourites']['emp_name']='';
$_SESSION['jbms_back_favourites']['id_cat_expertise']='';
$_SESSION['jbms_back_favourites']['id_expertise_query']='';
$_SESSION['jbms_back_favourites']['id_employee']='';
$_SESSION['jbms_back_favourites']['id_employee_query']='';

$_SESSION['jbms_back_msg_inbox']['search_query']='';
$_SESSION['jbms_back_msg_inbox']['search_comp']='';
$_SESSION['jbms_back_msg_inbox']['search_comp_query']='';

$_SESSION['jbms_back_msg_sent']['search_query']='';
$_SESSION['jbms_back_msg_sent']['search_comp']='';
$_SESSION['jbms_back_msg_sent']['search_comp_query']='';

$_SESSION['jbms_back_diplomatypes']['search_query']='';
$_SESSION['jbms_back_diplomatypes']['search_txt']='';
$_SESSION['jbms_back_diplomatypes']['title']='';
$_SESSION['jbms_back_diplomatypes']['id_cat_expertise']='';
$_SESSION['jbms_back_diplomatypes']['search_expertise']='';

$_SESSION['jbms_back_diplomatypes']['search_query']='';
$_SESSION['jbms_back_diplomatypes']['id_cat_expertise']='';
$_SESSION['jbms_back_diplomatypes']['search_expertise']='';

$_SESSION['jbms_back_edulevel']['search_query']='';
$_SESSION['jbms_back_edulevel']['search_txt']='';
$_SESSION['jbms_back_edulevel']['search_txt_query']='';

$_SESSION['jbms_back_explevel']['search_query']='';
$_SESSION['jbms_back_explevel']['search_txt']='';
$_SESSION['jbms_back_explevel']['search_txt_query']='';

  // Message type and text
  set_message(3,''.$row_user['name'].' is connected !');

// Redirection to the page
header('Location: index.php');
}else{
    // Message type and text
  set_message(2,''.$txt_msg.'');

  // Redirection to the page
  header('Location: sign.php');
}

?>