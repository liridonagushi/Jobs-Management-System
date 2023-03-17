<?php

function login(){
  if($_SESSION['jbms_back']['id_user']==0){
    header('Location: post_logout.php');
  }
}

function count_exp_area() {
  global $dbj;
  $expertise=$dbj->query('SELECT id_expertise FROM expertises');
  return $expertise->rowCount();
}

function count_cat_exp() {
  global $dbj;
  $dipl=$dbj->query('SELECT id_cat_expertise FROM category_expertises');
  return $dipl->rowCount();
}

function count_diplomas() {
  global $dbj;
  $dipl=$dbj->query('SELECT id_diploma FROM diploma_types');
  return $dipl->rowCount();
}

function count_companies() {
  global $dbj;
  $comp=$dbj->query('SELECT companies.id_employer FROM companies WHERE companies.id_employer="'.$_SESSION['jbms_back']['id_user'].'"');
  return $comp->rowCount();
}

function count_job_offers() {
  global $dbj;
  $jobs=$dbj->query('SELECT job_offers.id_job FROM job_offers LEFT JOIN companies ON job_offers.id_company=companies.id_company LEFT JOIN users ON companies.id_employer=users.id_user WHERE companies.id_employer="'.$_SESSION['jbms_back']['id_user'].'"');
  return $jobs->rowCount();
}

function count_favourite_candidates() {
  global $dbj;
  $fav=$dbj->query('SELECT * FROM profile_favourites LEFT JOIN users ON profile_favourites.id_employer=users.id_user WHERE profile_favourites.id_employer="'.$_SESSION['jbms_back']['id_user'].'"');
  return $fav->rowCount();
}

function count_received_msg() {
  global $dbj;
  $emails=$dbj->query('SELECT DISTINCT emails.id_from FROM emails LEFT JOIN users ON emails.id_to=users.id_user WHERE emails.id_to="'.$_SESSION['jbms_back']['id_user'].'"');
  return $emails->rowCount();
}

function count_sent_msg() {
  global $dbj;
  $emails=$dbj->query('SELECT DISTINCT emails.id_to FROM emails LEFT JOIN users ON emails.id_from=users.id_user WHERE emails.id_from="'.$_SESSION['jbms_back']['id_user'].'"');
  return $emails->rowCount();
}
// update, insert, delete actions auditor
function actions_auditor($action_type, $table_name, $id_value){

  global $dbj;

  $create_auditor=$dbj->exec('INSERT INTO auditor_admin (id_user, action_type, table_name, id_value) VALUES ('.$_SESSION['back']['id_user'].','.$action_type.', "'.$table_name.'", '.$id_value.')');
}
function log_message(){

    global $dbj;
    
    $id_notification=$_SESSION['id_notification'];
    $txt_msg=$_SESSION['txt_msg'];

    $msg=$dbj->query('SELECT * FROM notifications WHERE id_notification="'.$id_notification.'"');
    $count_msg=$msg->rowCount();
    $row_msg=$msg->fetch(PDO::FETCH_ASSOC);

  if ($count_msg>0) {
    $result_txt='<script type="text/javascript">
        $(window).load(function(){
            reset();
            alertify.'.$row_msg['msg_type'].'("'.$txt_msg.'");
    });

    </script>';
    echo $result_txt;
  }
    clear_notification();
}

?>