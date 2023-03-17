<?php
// Including functions
require_once('assets/include/functions.php');

switch ($_GET['destination']) {

case 'candidates':

  $_SESSION['jbms_back']['id_job']=$_GET['id_job'];

  // Redirection to the page
  header('Location: lst_candidates.php');

break;

case 'allcandidates':

  $_SESSION['jbms_back']['id_job']='';

  // Redirection to the page
  header('Location: lst_candidates.php');

break;


}
?>