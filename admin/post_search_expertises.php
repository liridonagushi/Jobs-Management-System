<?php
// Including functions
require_once('assets/include/functions.php');

// Request filename
$filename=$_POST['filename'];

$_SESSION[$filename] = array(
          'sorting' => $_GET['sorting'],
          'orderby' => $_GET['orderby'],
          'sort_value' => $_GET['sort_value'],
          'id_expertise' => $_POST['id_expertise'],
          'id_category' => $_POST['id_category']
);

// If it exist a search value we activate the conditions
if(!empty($_SESSION[$filename]['id_category'])){
  $_SESSION[$filename]['search_cat_exp'] = ' AND (expertises.id_category="'.$_SESSION[$filename]['id_category'].'")';
  }else{
  $_SESSION[$filename]['search_cat_exp']='';
};

// If it exist a search value we activate the conditions
if(!empty($_SESSION[$filename]['id_expertise'])){
  $_SESSION[$filename]['id_expertise_query'] = ' AND (expertises.id_expertise = "'.$_SESSION[$filename]['id_expertise'].'")';
  }else{
  $_SESSION[$filename]['id_expertise_query']='';
};

// To reset the buffer memory of the queries
if(!empty($_POST['reset'])){
  $_SESSION[$filename]['search_query']='';
  $_SESSION[$filename]['id_category']='';
  $_SESSION[$filename]['id_expertise_query']='';
  $_SESSION[$filename]['id_expertise']='';
  $_SESSION[$filename]['search_cat_exp']='';
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

  $_SESSION[$filename]['search_query']=$_SESSION[$filename]['search_cat_exp'].$_SESSION[$filename]['id_expertise_query'];

// End Sorting
// // Redirection of the page
header('Location: lst_expertises.php');
?>