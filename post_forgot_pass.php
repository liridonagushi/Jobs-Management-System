<?php
// Including functions
include('admin/assets/include/functions.php');

$error=0;

if ($_POST['email']){
  $email=$_POST['email'];
  $birthday=$_POST['birthday'];
}else{
  $email=$_GET['email'];
  $birthday=$_GET['birthday'];
}

// Validating Form
$error = check_email_length($email, 2, 50);

$verify_exist=$dbj->query('SELECT email, name, birthday FROM users WHERE email="'.$email.'" AND birthday="'.$birthday.'"');
if(!($verify_exist->rowCount()>0)){
  $error=14;
}

if($error==0){

      $to = ''.$email.'';
      $subject = ''.$_SESSION['jbms_front']['company_name'].': Password Reset Link !';
      // Get HTML contents from file
      // $htmlContent = file_get_contents("email_template.html");

      // Set content-type for sending HTML email
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

      // Additional headers
      $headers .= 'From: '.$email.'>' . "\r\n";

      // Send email
      if(mail($to, $subject, $htmlContent, $headers)){
       $error = 15;
      }else{
       $error = 16;
      }
}

 if(($error==0) OR ($error==15)){

    $row_user=$verify_exist->fetch(PDO::FETCH_ASSOC);

    $generate_pass_key=initials($row_user['name']).rand(10000,1000000);

    $upd_user = "UPDATE users SET generate_pass_key=:generate_pass_key WHERE email=:email";
    $ins_prep = $dbj->prepare($upd_user);
    $ins_prep->bindValue(':generate_pass_key', $generate_pass_key);
    $ins_prep->bindValue(':email', $email);
    $ins_prep->execute();

     // Message type and text
    set_message(3,''.check_error($error).'');

  // Redirection to the file
    header('Location: '.$_GET['destination'].'');

  }else{

   // Message type and text
    set_message(2,' '.check_error($error).'');

  // Redirection to the file
    header('Location: forgot_pass.php');
  }
?>