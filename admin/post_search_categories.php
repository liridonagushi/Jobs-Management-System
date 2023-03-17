<?php
// Including functions
require_once('assets/include/functions.php');

// Request filename
$filename=$_POST['filename'];

$_SESSION[$filename] = array(
          'sorting' => $_GET['sorting'],
          'orderby' => $_GET['orderby'],
          'sort_value' => $_GET['sort_value'],
          'id_cat_expertise' => $_POST['id_cat_expertise']
);

// If it exist a search value we activate the conditions
if(!empty($_SESSION[$filename]['id_cat_expertise'])){
  $_SESSION[$filename]['search_expertise'] = ' AND (category_expertises.id_cat_expertise="'.$_SESSION[$filename]['id_cat_expertise'].'")';
  }else{
  $_SESSION[$filename]['search_expertise']='';
};

// To reset the buffer memory of the queries
if(!empty($_POST['reset'])){
  $_SESSION[$filename]['search_query']='';
  $_SESSION[$filename]['id_cat_expertise']='';
  $_SESSION[$filename]['search_expertise']='';
};

// Table sorting
// Later to put in session value and the screen
  if(($_SESSION[$filename]['sorting']=='ASC')){
    $_SESSION[$filename]['sorting']='DESC';
  }else{
    $_SESSION[$filename]['sorting']='ASC';
  }

  if(!empty($_SESSION[$filename]['sort_value']) && !empty($_SESSION[$filename]['sorting'])){
    $_SESSION[$filename]['orderby']='ORDER BY '.$_SESSION[$filename]['sort_value'].' '.$_SESSION[$filename]['sorting'].'';
  }else{
    $_SESSION[$filename]['orderby']='';
  };

  $_SESSION[$filename]['search_query']=$_SESSION[$filename]['search_expertise'];

// End Sorting
// // Redirection of the page
header('Location: lst_categories.php');
?>