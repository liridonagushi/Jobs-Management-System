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
          'id_company' => $_POST['id_company'],
          'id_job' => $_POST['id_job'],
          'id_level' => $_POST['id_level'],
          'emp_name' => $_POST['emp_name'],
          'search_query' => $_POST['search_query']
);

// If it exist a search value we activate the conditions
if(!empty($_SESSION[$filename]['emp_name'])){
  $_SESSION[$filename]['emp_name_query'] = ' AND ((concat(users.name," ",users.surname) like "%'.$_SESSION[$filename]['emp_name'].'%" OR concat(users.surname," ",users.name) like "%'.$_SESSION[$filename]['emp_name'].'%") OR (users.id_user = "'.$_SESSION[$filename]['emp_name'].'"))';
  }else{
  $_SESSION[$filename]['emp_name_query']='';
};

// If it exist a search value we activate the conditions
if(!empty($_SESSION[$filename]['id_company'])){
  $_SESSION[$filename]['id_company_query'] = ' AND (companies.id_company = "'.$_SESSION[$filename]['id_company'].'")';
  }else{
  $_SESSION[$filename]['id_company_query']='';
};

// If it exist a search value we activate the conditions
if(!empty($_SESSION[$filename]['id_employee'])){
  $_SESSION[$filename]['id_employee_query'] = ' AND (users.id_user = "'.$_SESSION[$filename]['id_employee'].'")';
  }else{
  $_SESSION[$filename]['id_employee_query']='';
};

// If it exist a search value we activate the conditions
if(!empty($_SESSION[$filename]['id_level'])){
  $_SESSION[$filename]['id_level_query'] = ' AND (users.admin_level = "'.$_SESSION[$filename]['id_level'].'")';
  }else{
  $_SESSION[$filename]['id_level_query']='';
};

// If it exist a search value we activate the conditions
if(!empty($_SESSION[$filename]['id_job'])){
  $_SESSION[$filename]['id_job_query'] = ' AND (job_offers.id_job = "'.$_SESSION[$filename]['id_job'].'")';
  }else{
  $_SESSION[$filename]['id_job_query']='';
};


// To reset the buffer memory of the queries
if(!empty($_POST['reset'])){
  $_SESSION[$filename]['search_query']='';
  $_SESSION[$filename]['emp_name']='';
  $_SESSION[$filename]['emp_name_query']='';
  $_SESSION[$filename]['id_expertise_query']='';
  $_SESSION[$filename]['id_company']='';
  $_SESSION[$filename]['id_company_query']='';
  $_SESSION[$filename]['id_employee']='';
  $_SESSION[$filename]['id_employee_query']='';
  $_SESSION[$filename]['id_level']='';
  $_SESSION[$filename]['id_level_query']='';
  $_SESSION[$filename]['id_job']='';
  $_SESSION[$filename]['id_job_query']='';
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

  $_SESSION[$filename]['search_query']=$_SESSION[$filename]['emp_name_query'].$_SESSION[$filename]['id_company_query'].$_SESSION[$filename]['id_employee_query'].$_SESSION[$filename]['id_job_query'].$_SESSION[$filename]['id_level_query'];

// End Sorting
// // Redirection of the page
header('Location: '.$_POST['link'].'');
?>