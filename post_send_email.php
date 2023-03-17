<?php
// Including functions
include('admin/assets/include/functions.php');

// Validating Form
$error_txt = check_error(check_string_length($_POST['id_employee'], 1, 11));
$error_txt = check_error(check_string_length($_POST['object_title'], 2, 35));
$error_txt = check_error(check_string_length($_POST['message'], 2, 800));

if(strlen($error_txt)>0){

  // Message type and text
  set_message(2,''.$error_txt.'');

}else{

$email=$dbj->query('SELECT users.name FROM users WHERE users.id_user="'.$_POST['id_employee'].'"');
$row_email=$email->fetch(PDO::FETCH_ASSOC);

$ins = "INSERT INTO emails (id_from, id_to, object_title, message) VALUES (:id_from, :id_to, :object_title, :message)";

$stmt = $dbj->prepare($ins);
$stmt->bindValue(':id_from', $_SESSION['jbms_front']['id_user']);
$stmt->bindValue(':id_to', $_POST['id_employee']);
$stmt->bindValue(':object_title', $_POST['object_title']);
$stmt->bindValue(':message', $_POST['message']);

$stmt->execute(); 

// if ($id_email = $dbj->lastInsertId()){

//   $to = $_POST['employee_email'];
        
//   $subject = $_POST['object_title'];
        
//   $message = $_POST['message'];
        
//   $headers  = 'MIME-Version: 1.0' . "\\r\ ";
//   $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\\r\ ";
  
        
//   mail($to, $subject, $message, $headers);

// }


// Message type and text
set_message(3,'Email is successfully sent to '.$row_email['name'].'');
}

if ($_POST['target']=='messages') {
  
    // Redirection to the file
    header('Location: view_messages.php?id_user='.$_POST['id_employee'].'');

}else{

   // Redirection to the file
   header('Location: send_email.php?id_user='.$_POST['id_employee'].'');
  }
?>