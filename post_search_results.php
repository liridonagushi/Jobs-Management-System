<?php
// Including functions
include('admin/assets/include/functions.php');

// Request filename
$filename=$_POST['filename'];

$_SESSION[$filename] = array(
  'sorting' => $_POST['sorting'],
  'orderby' => $_POST['orderby'],
  'job_title' => $_POST['job_title'],
  'publish_date' => $_POST['publish_date'],
  'job_sn' => $_POST['job_sn'],
  'company_name' => $_POST['company_name'],
  'id_category' => $_POST['id_category'],
  'id_expertise' => $_POST['id_expertise'],
  'id_level_education' => $_POST['id_level_education'],
  'id_level_experience' => $_POST['id_level_experience'],
  'id_salary' => $_POST['id_salary']
);

switch ($_SESSION[$filename]['publish_date']) {

    case 'today':
    $_SESSION[$filename]['job_pubdate_query'] = ' AND (job_offers.publish_date >= "'.date('Y-m-d').'")';
    break;
  
    case 'yesterday':
    $_SESSION[$filename]['job_pubdate_query'] = ' AND (job_offers.publish_date >= "'.date('Y-m-d',strtotime("-1 days")).'")';
    break;
   
    case 'oneweek':
    $_SESSION[$filename]['job_pubdate_query'] = ' AND (job_offers.publish_date >= "'.date('Y-m-d',strtotime("-7 days")).'")';
    break;

    case 'twoweeks':
    $_SESSION[$filename]['job_pubdate_query'] = ' AND (job_offers.publish_date >= "'.date('Y-m-d',strtotime("-14 days")).'")';
    break;
   
    case 'onemonth':
    $_SESSION[$filename]['job_pubdate_query'] = ' AND (job_offers.publish_date >= "'.date('Y-m-d',strtotime("-1 month")).'")';
    break;
}

// If it exist a search value we activate the conditions
if(!empty($_SESSION[$filename]['job_title'])){
  $_SESSION[$filename]['job_title_query'] = ' AND (job_offers.job_title like "%'.$_SESSION[$filename]['job_title'].'%")';
  }else{
  $_SESSION[$filename]['job_title_query']='';
};

// If it exist a search value we activate the conditions
if(!empty($_SESSION[$filename]['job_sn'])){
  $_SESSION[$filename]['job_sn_query'] = ' AND (job_offers.job_sn = "'.$_SESSION[$filename]['job_sn'].'")';
  }else{
  $_SESSION[$filename]['job_sn_query']='';
};

// If it exist a search value we activate the conditions
if(!empty($_SESSION[$filename]['company_name'])){
  $_SESSION[$filename]['job_company_query'] = ' AND (companies.company_name like "%'.$_SESSION[$filename]['company_name'].'%")';
  }else{
  $_SESSION[$filename]['job_company_query']='';
};
// If it exist a search value we activate the conditions
if(!empty($_SESSION[$filename]['id_category'])){
  $_SESSION[$filename]['job_cat_query'] = ' AND (expertises.id_category = "'.$_SESSION[$filename]['id_category'].'")';
  }else{
  $_SESSION[$filename]['job_cat_query']='';
};

// If it exist a search value we activate the conditions
if(!empty($_SESSION[$filename]['id_expertise'])){
  $_SESSION[$filename]['job_expertise_query'] = ' AND (expertises.id_expertise = "'.$_SESSION[$filename]['id_expertise'].'")';
  }else{
  $_SESSION[$filename]['job_expertise_query']='';
};

// If it exist a search value we activate the conditions
if(!empty($_SESSION[$filename]['id_level_education'])){
  $_SESSION[$filename]['job_levedu_query'] = ' AND (levels_education.id_level_education = "'.$_SESSION[$filename]['id_level_education'].'")';
  }else{
  $_SESSION[$filename]['job_levedu_query']='';
};

// If it exist a search value we activate the conditions
if(!empty($_SESSION[$filename]['id_level_experience'])){
  $_SESSION[$filename]['job_levexpertise_query'] = ' AND (levels_experience.id_level_experience = "'.$_SESSION[$filename]['id_level_experience'].'")';
  }else{
  $_SESSION[$filename]['job_levexpertise_query']='';
};

// If it exist a search value we activate the conditions
if(!empty($_SESSION[$filename]['id_salary'])){
  $_SESSION[$filename]['job_levsalary_query'] = ' AND (salary_ranges.id_salary = "'.$_SESSION[$filename]['id_salary'].'")';
  }else{
  $_SESSION[$filename]['job_levsalary_query']='';
};

// To reset the buffer memory of the queries
if(!empty($_POST['reset'])){
  $_SESSION[$filename]['search_query']='';
  $_SESSION[$filename]['job_title_query']='';
  $_SESSION[$filename]['job_title']='';
  $_SESSION[$filename]['job_cat_query']='';
  $_SESSION[$filename]['id_category']='';
  $_SESSION[$filename]['job_pubdate_query']='';
  $_SESSION[$filename]['publish_date']='';
  $_SESSION[$filename]['job_sn_query']='';
  $_SESSION[$filename]['job_sn']='';
  $_SESSION[$filename]['job_company_query']='';
  $_SESSION[$filename]['company_name']='';
  $_SESSION[$filename]['id_expertise']='';
  $_SESSION[$filename]['job_expertise_query']='';
  $_SESSION[$filename]['id_level_education']='';
  $_SESSION[$filename]['job_levedu_query']='';
  $_SESSION[$filename]['id_level_experience']='';
  $_SESSION[$filename]['job_levexpertise_query']='';
  $_SESSION[$filename]['id_salary']='';
  $_SESSION[$filename]['job_levsalary_query']='';
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

  $_SESSION[$filename]['search_query']=$_SESSION[$filename]['job_title_query'].$_SESSION[$filename]['job_cat_query'].$_SESSION[$filename]['job_pubdate_query'].$_SESSION[$filename]['job_sn_query'].$_SESSION[$filename]['job_company_query'].$_SESSION[$filename]['job_expertise_query'].$_SESSION[$filename]['job_levedu_query'].$_SESSION[$filename]['job_levexpertise_query'].$_SESSION[$filename]['job_levsalary_query'];

// End Sorting
// // Redirection of the page
header('Location: '.$_POST['module'].'');
?>