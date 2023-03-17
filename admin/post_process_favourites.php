<?php
$error_txt='';

// Including functions
include('assets/include/functions.php');

// Validating Form
$error_txt = check_error(check_string_length($_GET['id_user'], 1, 11));

$user=$dbj->query('SELECT * FROM users WHERE id_user="'.$_GET['id_user'].'"');

$row_user=$user->fetch(PDO::FETCH_ASSOC);

if(!empty($error_txt)){

// Message type and text
set_message(2,''.$error_txt.'');
return;
header('Location: index.php');

}else{

switch ($_GET['target']) {

  case 'insert':

      $ins = "INSERT INTO profile_favourites (id_employer, id_employee) VALUES (:id_employer, :id_employee)";

      $stmt = $dbj->prepare($ins);
      $stmt->bindValue(':id_employer', $_SESSION['jbms_back']['id_user']);
      $stmt->bindValue(':id_employee', $_GET['id_user']);

      $stmt->execute(); 

      // Message type and text
     set_message(3,''.$_GET['name'].' '.$_GET['surname'].' is added to your favourites');

      // Redirection to the file
      header('Location: '.$_GET['link'].'?id_job='.$_GET['id_job'].'');
    break;

  case 'remove':

      $del = "DELETE FROM profile_favourites WHERE id_employer=:id_employer AND id_employee=:id_employee";

      $del_prep = $dbj->prepare($del);
      $del_prep->bindValue(':id_employer', $_SESSION['jbms_back']['id_user']);
      $del_prep->bindValue(':id_employee', $_GET['id_user']);

      $del_prep->execute(); 

      // Message type and text
      set_message(3,''.$_GET['name'].' '.$_GET['surname'].' is removed from your favourites');

      // Redirection to the file
      header('Location: '.$_GET['link'].'?id_job='.$_GET['id_job'].'');

    break;

    case 'remove_from_page':

      $del = "DELETE FROM profile_favourites WHERE id_employer=:id_employer AND id_employee=:id_employee";

      $del_prep = $dbj->prepare($del);
      $del_prep->bindValue(':id_employer', $_SESSION['jbms_back']['id_user']);
      $del_prep->bindValue(':id_employee', $_GET['id_user']);

      $del_prep->execute(); 

      // Message type and text
      set_message(3,''.$_GET['name'].' '.$_GET['surname'].' is removed from your favourites');

      // Redirection to the file
      header('Location: lst_fav_candidates.php');

    break;
}



}

?>