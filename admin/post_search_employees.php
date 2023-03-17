<?php
// Including functions
require_once('assets/include/functions.php');

// Request filename
$filename=$_POST['filename'];

$_SESSION[$filename] = array(
          'sorting' => $_GET['sorting'],
          'orderby' => $_GET['orderby'],
          'sort_value' => $_GET['sort_value'],
          'id_employee' => $_POST['id_employee'],
          'emp_name' => $_POST['emp_name'],
          'id_expertise' => $_POST['id_expertise'],
          'search_query' => $_POST['search_query']
);

// If it exist a search value we activate the conditions
if(!empty($_SESSION[$filename]['emp_name'])){
  $_SESSION[$filename]['emp_name_query'] = ' AND (concat(employees.name," ",employees.surname) like "%'.$_SESSION[$filename]['emp_name'].'%"
    OR concat(employees.surname," ",employees.name) like "%'.$_SESSION[$filename]['emp_name'].'%")';
  }else{
  $_SESSION[$filename]['emp_name_query']='';
};

// If it exist a search value we activate the conditions
if(!empty($_SESSION[$filename]['id_employee'])){
  $_SESSION[$filename]['id_employee_query'] = ' AND (profile_favourites.id_employee LIKE "%'.$_SESSION[$filename]['id_employee'].'%")';
  }else{
  $_SESSION[$filename]['id_employee_query']='';
};

// To reset the buffer memory of the queries
if(!empty($_POST['reset'])){
  $_SESSION[$filename]['search_query']='';
  $_SESSION[$filename]['emp_name']='';
  $_SESSION[$filename]['emp_name_query']='';
  $_SESSION[$filename]['id_employee']='';
  $_SESSION[$filename]['id_employee_query']='';
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

  $_SESSION[$filename]['search_query']=$_SESSION[$filename]['emp_name_query'].$_SESSION[$filename]['id_employee_query'];

// End Sorting
// // Redirection of the page
header('Location: lst_fav_candidates.php');
?>