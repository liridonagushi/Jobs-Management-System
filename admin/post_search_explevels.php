<?php
// Including functions
require_once('assets/include/functions.php');

// Request filename
$filename=$_POST['filename'];

$_SESSION[$filename] = array(
          'sorting' => $_GET['sorting'],
          'orderby' => $_GET['orderby'],
          'title' => $_POST['title'],
          'sort_value' => $_GET['sort_value']
);

// If it exist a search value we activate the conditions
if(!empty($_SESSION[$filename]['title'])){
  $_SESSION[$filename]['title_query'] = ' AND (levels_experience.level_experience LIKE "%'.$_SESSION[$filename]['title'].'%")';
  }else{
  $_SESSION[$filename]['title_query']='';
};

// To reset the buffer memory of the queries
if(!empty($_POST['reset'])){
  $_SESSION[$filename]['search_query']='';
  $_SESSION[$filename]['title']='';
  $_SESSION[$filename]['title_query']='';
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

  $_SESSION[$filename]['search_query']=$_SESSION[$filename]['title_query'];

// End Sorting
// // Redirection of the page
header('Location: lst_experience_levels.php');
?>