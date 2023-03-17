<?php
// Including functions
require_once('assets/include/functions.php');

// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('assets/include/variables.php');



$_SESSION['jbms_back_msg_sent'] = array(
          'sorting' => $_GET['sorting'],
          'orderby' => $_GET['orderby'],
          'sort_value' => $_GET['sort_value'],
          'search_comp' => $_POST['search_comp'],
          'search_query' => $_POST['search_query']
);

// If it exist a search value we activate the conditions
if(!empty($_SESSION['jbms_back_msg_sent']['search_comp'])){
  $_SESSION['jbms_back_msg_sent']['search_comp_query'] = ' AND (concat(to_user.name," ",to_user.surname) like "%'.$_SESSION['jbms_back_msg_sent']['search_comp'].'%"
    OR concat(to_user.surname," ",to_user.name) like "%'.$_SESSION['jbms_back_msg_sent']['search_comp'].'%") OR ((emails.object_title LIKE "%'.$_SESSION['jbms_back_msg_sent']['search_comp'].'%") OR (emails.message LIKE "%'.$_SESSION['jbms_back_msg_sent']['search_comp'].'%") OR (to_user.email LIKE "%'.$_SESSION['jbms_back_msg_sent']['search_comp'].'%"))';
  }else{
  $_SESSION['jbms_back_msg_sent']['search_comp_query']='';
};

// To reset the buffer memory of the queries
if(!empty($_POST['reset'])){
  $_SESSION['jbms_back_msg_sent']['search_query']='';
  $_SESSION['jbms_back_msg_sent']['search_comp']='';
  $_SESSION['jbms_back_msg_sent']['search_comp_query']='';
};

// Table sorting
// Later to put in session value and the screen
  if(($_SESSION['jbms_back_msg_sent']['sorting']=='ASC')){
    $_SESSION['jbms_back_msg_sent']['sorting']='DESC';
  }else{
    $_SESSION['jbms_back_msg_sent']['sorting']='ASC';
  }

  if(!empty($_SESSION['jbms_back_msg_sent']['sort_value']) && !empty($_SESSION['jbms_back_msg_sent']['sorting'])){
    $_SESSION['jbms_back_msg_sent']['orderby']='ORDER BY '.$_SESSION['jbms_back_msg_sent']['sort_value'].' '.$_SESSION['jbms_back_msg_sent']['sorting'].'';
  }else{
    $_SESSION['jbms_back_msg_sent']['orderby']='';
  };

  $_SESSION['jbms_back_msg_sent']['search_query']=$_SESSION['jbms_back_msg_sent']['search_comp_query'];

// End Sorting
// // Redirection of the page
header('Location: lst_sent.php');
?>