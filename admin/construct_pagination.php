<?php
// Getting the values
if(empty($_SESSION['epp'])){ $_SESSION['epp']=5; } // Sessions by default

// Memory allocation of the results
// if(!empty($epp)){ $_SESSION['epp']=$epp;} // Results per page
// Getting the results on the current page with the get
$nbPages = ceil($total/$_SESSION['epp']); // Calculation of the results per page
// If it hasnt a value by default we go to the first page
$current = 1;

if(empty($_SESSION['epp'])){ $_SESSION['epp']=5; } // Sessions by default
if(!empty($_GET['p'])){ $_SESSION[''.$module.'']['p']=$_GET['p']; } // Sessions by default

if (isset($_SESSION[$module]['p']) && is_numeric($_SESSION[''.$module.'']['p'])) {
  $page = intval($_SESSION[''.$module.'']['p']);
  if ($page >= 1 && $page <= $nbPages) {
  // case normal
  $current=$page;
  } else if ($page < 1) {
  // the case where the number is less than 1, we use the first page
  $current=1;
  }else{
  //if the number is higher than 1, we go to the specified page
  $current = $nbPages;
  }
}

// $start is the value of the page
$start=($current * $_SESSION['epp'] - $_SESSION['epp']);
?>