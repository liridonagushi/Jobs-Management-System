<?php
// Including functions
include('assets/include/functions.php');

$error_txt = '';
$target=$_POST['target'];

    $file = $_FILES[$target]['tmp_name'];
    $handle = fopen($file, "r");
    $records = 0;

    while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
    {
      if($records>0){
      $name = $filesop[0];
      $surname = $filesop[1];
      $email = $filesop[2];
      $password = $filesop[3];
      $birthday = $filesop[4];
      $admin_level = $filesop[5];

      $ins_imp = "INSERT INTO temporary_data (target, value1, value2, value3, value4, value5, value6) VALUES (:target, :value1, :value2, :value3, :value4, :value5, :value6)";
      $upd_prep = $dbj->prepare($ins_imp);
      $upd_prep->bindValue(':target', $target);
      $upd_prep->bindValue(':value1', $name);
      $upd_prep->bindValue(':value2', $surname);
      $upd_prep->bindValue(':value3', $email);
      $upd_prep->bindValue(':value4', $password);
      $upd_prep->bindValue(':value5', $birthday);
      $upd_prep->bindValue(':value6', $admin_level);
      $upd_prep->execute();
      }
      $records = $records + 1;
    }

  // Message type and text
  set_message(3,'You imported '. $records .' records !');

// Redirection to the file
  header('Location: import_data.php');
?>