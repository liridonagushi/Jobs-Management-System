<?php
// Including functions
include('assets/include/functions.php');

// Validating Form

$finduser=$dbj->query('SELECT * FROM users WHERE id_user="'.$_GET['id_user'].'"');
$rowuser=$finduser->fetch(PDO::FETCH_ASSOC);

$error_txt = check_error(check_string_length($rowuser['id_user'], 1, 11));

if(strlen($error_txt)>0){

  // Message type and text
  set_message(2,''.$error_txt.'');

  header('Location: lst_users.php');

}else{

$findbanned=$dbj->query('SELECT * FROM banned_users WHERE id_user_banned="'.$_GET['id_user'].'"');


$today=date('Y-m-d');
$onemonth=date('Y-m-d',strtotime("+30 days"));

if($findbanned->rowCount()>0){

    // Message type and text
    $unban = "DELETE FROM banned_users WHERE id_user_banned=:id_user_banned";

    $unban_prepare = $dbj->prepare($unban);
    $unban_prepare->bindValue(':id_user_banned', $_GET['id_user']);

    $unban_prepare->execute();

    // Message type and text
    set_message(3,'User ban limit successfully removed !');


}else{
    $ins = "INSERT INTO banned_users (ban_period_days, ban_date, ban_toDate, id_user_banned) VALUES (:ban_period_days, :ban_date, :ban_toDate, :id_user_banned)";

    $ins_prepare = $dbj->prepare($ins);
    $ins_prepare->bindValue(':ban_period_days', "30");
    $ins_prepare->bindValue(':ban_date', $today);
    $ins_prepare->bindValue(':ban_toDate', $onemonth);
    $ins_prepare->bindValue(':id_user_banned', $_GET['id_user']);

    $ins_prepare->execute();

   set_message(2,'User successfully banned for 30 days !');
 
}
}

  


// Redirection to the file
header('Location: lst_users.php');
?>