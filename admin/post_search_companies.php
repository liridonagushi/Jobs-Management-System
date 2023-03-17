<?php
// Including functions
require_once('assets/include/functions.php');

// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('assets/include/variables.php');



$_SESSION[$_POST['filename']] = array(
          'sorting' => $_GET['sorting'],
          'orderby' => $_GET['orderby'],
          'sort_value' => $_GET['sort_value'],
          'search_comp' => $_POST['search_comp'],
          'id_cat_expertise' => $_POST['id_cat_expertise'],
          'filename' => $_POST['filename']
);

// If it exist a search value we activate the conditions
if(!empty($_SESSION[$_POST['filename']]['search_comp'])){
  $_SESSION[$_POST['filename']]['search_comp_query'] = ' AND ((companies.company_name LIKE "%'.$_SESSION[$_POST['filename']]['search_comp'].'%") OR (companies.company_sn LIKE "%'.$_SESSION[$_POST['filename']]['search_comp'].'%"))';
  }else{
  $_SESSION[$_POST['filename']]['search_comp_query']='';
};

// If it exist a search value we activate the conditions
if(!empty($_SESSION[$_POST['filename']]['id_cat_expertise'])){
  $_SESSION[$_POST['filename']]['search_exp_query'] = ' AND (companies.id_cat_expertise = "'.$_SESSION[$_POST['filename']]['id_cat_expertise'].'")';
  }else{
  $_SESSION[$_POST['filename']]['search_exp_query']='';
};

// To reset the buffer memory of the queries
if(!empty($_POST['reset'])){
  $_SESSION[$_POST['filename']]['search_query']='';
  $_SESSION[$_POST['filename']]['search_key']='';
  $_SESSION[$_POST['filename']]['search_exp']='';
  $_SESSION[$_POST['filename']]['search_comp']='';
  $_SESSION[$_POST['filename']]['search_comp_query']='';
  $_SESSION[$_POST['filename']]['search_exp_query']='';
  $_SESSION[$_POST['filename']]['id_cat_expertise']='';
};

// Table sorting
// Later to put in session value and the screen
  if(($_SESSION[$_POST['filename']]['sorting']=='ASC')){
    $_SESSION[$_POST['filename']]['sorting']='DESC';
  }else{
    $_SESSION[$_POST['filename']]['sorting']='ASC';
  }

  if(!empty($_SESSION[$_POST['filename']]['sort_value']) && !empty($_SESSION[$_POST['filename']]['sorting'])){
    $_SESSION[$_POST['filename']]['orderby']='ORDER BY '.$_SESSION[$_POST['filename']]['sort_value'].' '.$_SESSION[$_POST['filename']]['sorting'].'';
  }else{
    $_SESSION[$_POST['filename']]['orderby']='';
  };

  $_SESSION[$_POST['filename']]['search_query']=$_SESSION[$_POST['filename']]['search_comp_query'].$_SESSION[$_POST['filename']]['search_exp_query'];

// End Sorting
// // Redirection of the page
header('Location: '.$_POST['module'].'');
?>