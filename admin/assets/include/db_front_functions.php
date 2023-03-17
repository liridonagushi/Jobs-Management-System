<?php
function log_message(){

    global $dbj;
    
    $txt_msg=$_SESSION['txt_msg'];

    $msg=$dbj->query('SELECT * FROM notifications WHERE id_notification="'.$_SESSION['id_notification'].'"');
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

function login(){

    if($_SESSION['jbms_front']['id_user']==0){
   
    // Message type and text
    set_message(2,'You are not allowed to access this area !');

    header('Location: login.php');
  }
}

?>