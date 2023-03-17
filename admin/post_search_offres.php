<?php
// Including functions
require_once('assets/include/functions.php');

// Request filename
$filename=$_POST['filename'];

$_SESSION[$filename] = array(
          'sorting' => $_GET['sorting'],
          'orderby' => $_GET['orderby'],
          'sort_value' => $_GET['sort_value'],
          'search_comp' => $_POST['search_comp'],
          'id_cat_expertise' => $_POST['id_cat_expertise'],
          'search_query' => $_POST['search_query']
);

// If it exist a search value we activate the conditions
if(!empty($_SESSION[$filename]['search_comp'])){
  $_SESSION[$filename]['search_comp_query'] = ' AND ((job_offers.job_sn LIKE "%'.$_SESSION[$filename]['search_comp'].'%") OR (job_offers.job_title LIKE "%'.$_SESSION[$filename]['search_comp'].'%"))';
  }else{
  $_SESSION[$filename]['search_comp_query']='';
};

// If it exist a search value we activate the conditions
if(!empty($_SESSION[$filename]['id_cat_expertise'])){
  $_SESSION[$filename]['search_exp_query'] = ' AND (category_expertises.id_cat_expertise = "'.$_SESSION[$filename]['id_cat_expertise'].'")';
  }else{
  $_SESSION[$filename]['search_exp_query']='';
};

// To reset the buffer memory of the queries
if(!empty($_POST['reset'])){
  $_SESSION[$filename]['search_query']='';
  $_SESSION[$filename]['search_key']='';
  $_SESSION[$filename]['search_exp']='';
  $_SESSION[$filename]['search_comp']='';
  $_SESSION[$filename]['search_comp_query']='';
  $_SESSION[$filename]['search_exp_query']='';
  $_SESSION[$filename]['id_cat_expertise']='';
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

  $_SESSION[$filename]['search_query']=$_SESSION[$filename]['search_comp_query'].$_SESSION[$filename]['search_exp_query'];

// End Sorting
// // Redirection of the page
header('Location: lst_job_offers.php');
?>