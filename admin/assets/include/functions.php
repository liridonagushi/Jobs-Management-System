<?php
include('connection.php');

function languages($lang=null, $id){
  global $dbj;

  if(!(isset($lang)) && empty($lang)){ $lang='en'; }
  
  $exp=$dbj->query('SELECT '.$lang.'_expressions AS word FROM language_expressions WHERE id_lang="'.$id.'"');
  $row_exp=$exp->fetch(PDO::FETCH_ASSOC);

 //trim and lowercase email
  $word =  trim($row_exp['word']);
  
  //sanitize email
  $word_val = filter_var($word, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
 
  echo ' '.$word_val.' ';
}

function title_module() {
  global $dbj;
  if(!empty($_SESSION['jbms_front']['title'])){
    return $_SESSION['jbms_front']['title'];
  }else{
    $_SESSION['jbms_front']['title']='Jobs Management System';
  }
}

function title_back_module() {
  global $dbj;
  if(isset($_SESSION['jbms_back']['title'])){
    echo $_SESSION['jbms_back']['title'];
  }else{
    echo 'Jobs Management System';
  }
}

function initials($str) {
  $ret = '';
  foreach (explode(' ', $str) as $word)
      $ret .= strtoupper($word[0]);
  return $ret;
}

function timetodate($sql_date){

$dbdate=date('d/m/Y',strtotime($sql_date));
$yesterday=date('d/m/Y',strtotime("-1 days"));
$today=date('d/m/Y');


  if ($dbdate==$today){
    
    $new_dbdate='Today';
  }else if (($dbdate<=$yesterday) AND ($dbdate>=$yesterday)){
    
    $new_dbdate='Yesterday';
  }else{
    $new_dbdate=$dbdate;
  }
  return $new_dbdate;
}

function verify_profile($link){
  global $dbj;

  $verify=$dbj->query('SELECT users.email_verification, users.email, users.birthday, cv_lm.cv_code, cv_lm.lm_code FROM users LEFT JOIN cv_lm ON users.id_user=cv_lm.id_user WHERE users.id_user="'.$_SESSION['jbms_front']['id_user'].'"');

  $verify_account=$verify->fetch(PDO::FETCH_ASSOC);
  switch ($link) {
    case 'profile':

      if($verify_account['email_verification']!=1){

      echo '<script type="text/javascript">
      function myFunction() {
      alert("Once you\'ve verified your account, you will be able to apply for the jobs !");
      }
      </script>
      ';

      echo ' <a onclick="myFunction()"> <i class="fa fa-info-circle fa-1x text-error" aria-hidden="true" style="cursor:pointer;"></i> <h7 style="color:red; background:#eeeeee; border:1px solid #D3D3D3; padding:2px; cursor:pointer; margin:8px; width:820px; text-transform: none; font-size:11px;">Please check your email we sent a message to fully activate your account, or resend the verification message link !</h7></a> <a href="post_forgot_pass.php?email='.$verify_account['email'].'&birthday='.$verify_account['birthday'].'&destination=profile.php" class="btn btn-info"> Resend email</a>';

      }else if((empty($verify_account['cv_code'])) || (empty($verify_account['lm_code']))){
      echo '<script type="text/javascript">
      function myFunction() {
      alert("Once you\'ve upload your attachments, you will be able to apply for the jobs !");
      }
      </script>
      ';
      echo ' <a onclick="myFunction()"> <i class="fa fa-info-circle fa-1x text-error" aria-hidden="true" style="cursor:pointer;"></i> <h7 style="color:red; background:#eeeeee; border:1px solid #D3D3D3; padding:2px; cursor:pointer; margin:8px; width:820px; text-transform: none; font-size:11px;">Please upload your CV or Letter Motivation to continue applications !</h7></a>';
      }else{
      return false;
      }

      break;
    
    case 'menu':
        if((empty($verify_account['cv_code'])) || (empty($verify_account['lm_code']))|| ($verify_account['email_verification']!=1)){
        echo ' <i class="fa fa-exclamation fa-1x text-error" aria-hidden="true"></i>';
        }else{
        return false;
        }
      break;
  }
}

function variable_exists($variable1, $variable2=null){
  if ((empty($variable1)) || (empty($variable2))) {
    echo '<i class="fa fa-exclamation fa-1x text-error" aria-hidden="true"></i>';
  }else{
    echo '<i class="fa fa-check fa-1x text-success" aria-hidden="true"></i>';
  }
}

function variable_exists_profile($variable1, $variable2=null){
  if ((empty($variable1)) || (empty($variable2))) {
    echo '<i class="fa fa-exclamation fa-1x text-error" aria-hidden="true"></i>';
  }
}

function login_front(){
  if(($_SESSION['jbms_front']['id_user']==0) || ($_SESSION['jbms_front']['admin_level']!=3)){

    header('Location: post_logout.php');
  }
}

function login_admin(){
  if(($_SESSION['jbms_back']['id_user']==0) && ($_SESSION['jbms_back']['admin_level']!=2)){
    header('Location: post_logout.php');
  }
}

function login_twoadmin(){
  if(($_SESSION['jbms_back']['id_user']==0) && (($_SESSION['jbms_back']['admin_level']!=1) || ($_SESSION['jbms_back']['admin_level']!=2))){
    header('Location: post_logout.php');
  }
}


function login_oneadmin(){
  if(($_SESSION['jbms_back']['id_user']==0) && ($_SESSION['jbms_back']['admin_level']!=1)){
    header('Location: post_logout.php');
  }
}
// Front
function count_jobcandidatures($searchkey=null) {
  global $dbj;
  $candis=$dbj->query('SELECT job_offers.id_job FROM job_offers LEFT JOIN job_type ON job_offers.job_type=job_type.id_job_type INNER JOIN companies ON job_offers.id_company=companies.id_company LEFT JOIN levels_experience ON job_offers.id_level_experience=levels_experience.id_level_experience INNER JOIN levels_education ON job_offers.id_level_education=levels_education.id_level_education INNER JOIN salary_ranges ON job_offers.id_salary=salary_ranges.id_salary INNER JOIN job_candidatures ON job_offers.id_job=job_candidatures.id_job LEFT JOIN users AS employer ON (companies.id_employer=employer.id_user AND employer.admin_level="2") LEFT JOIN users AS employees ON (job_candidatures.id_employee=employees.id_user) INNER JOIN expertises ON job_offers.id_expertise=expertises.id_expertise INNER JOIN category_expertises ON expertises.id_category=category_expertises.id_cat_expertise WHERE job_candidatures.id_employee="'.$_SESSION['jbms_front']['id_user'].'" '.$searchkey.'');
  if(!empty($candis)){
    return $candis->rowCount();
  }
}

// Front
function saved_jobs($searchkey=null) {
  global $dbj;
  $savedjobs=$dbj->query('SELECT saved_jobs.id_employee FROM job_offers LEFT JOIN expertises ON job_offers.id_expertise=expertises.id_expertise LEFT JOIN category_expertises ON expertises.id_category=category_expertises.id_cat_expertise LEFT JOIN levels_education ON job_offers.id_level_experience=levels_education.id_level_education LEFT JOIN levels_experience ON job_offers.id_level_experience=levels_experience.id_level_experience LEFT JOIN companies ON job_offers.id_company=companies.id_company LEFT JOIN users ON companies.id_employer=users.id_user LEFT JOIN salary_ranges ON job_offers.id_salary=salary_ranges.id_salary LEFT JOIN saved_jobs ON job_offers.id_job=saved_jobs.id_job WHERE saved_jobs.id_employee="'.$_SESSION['jbms_front']['id_user'].'" '.$searchkey.'');
  if(!empty($savedjobs)){
  return $savedjobs->rowCount();
  }
}

// Admin
function count_joboffers($searchkey=null) {
  global $dbj;
  $joboffers=$dbj->query('SELECT id_job FROM job_offers LEFT JOIN expertises ON job_offers.id_expertise=expertises.id_expertise LEFT JOIN category_expertises ON expertises.id_category=category_expertises.id_cat_expertise LEFT JOIN companies ON job_offers.id_company=companies.id_company JOIN users ON companies.id_employer=users.id_user LEFT JOIN levels_education ON job_offers.id_level_education=levels_education.id_level_education LEFT JOIN levels_experience ON job_offers.id_level_experience=levels_experience.id_level_experience WHERE users.id_user="'.$_SESSION['jbms_back']['id_user'].'" '.$searchkey.'');
  if(!empty($joboffers)){
    return $joboffers->rowCount();
  }
}

function count_recentjoboffers($searchkey=null) {
  global $dbj;
  $joboffers=$dbj->query('SELECT id_job FROM job_offers LEFT JOIN job_type ON job_offers.job_type=job_type.id_job_type LEFT JOIN companies ON job_offers.id_company=companies.id_company LEFT JOIN salary_ranges ON job_offers.id_salary=salary_ranges.id_salary LEFT JOIN users AS employer ON (companies.id_employer=employer.id_user) LEFT JOIN expertises ON job_offers.id_expertise=expertises.id_expertise LEFT JOIN category_expertises ON expertises.id_category=category_expertises.id_cat_expertise LEFT JOIN levels_experience ON job_offers.id_level_experience=levels_experience.id_level_experience LEFT JOIN levels_education ON job_offers.id_level_education=levels_education.id_level_education WHERE companies.active="1" '.$searchkey.'');
  if(!empty($joboffers)){
    return $joboffers->rowCount();
  }
}

function count_exp_levels() {
  global $dbj;
  $expertise=$dbj->query('SELECT id_level_experience FROM levels_experience');
  if(!empty($expertise)){
    return $expertise->rowCount();
  }
}

function count_edu_levels() {
  global $dbj;
  $levedu=$dbj->query('SELECT id_level_education FROM levels_education');
  if(!empty($levedu)){
    return $levedu->rowCount();
  }
}

function count_exp_area() {
  global $dbj;
  $expertise=$dbj->query('SELECT id_expertise FROM expertises');
  if(!empty($expertise)){
    return $expertise->rowCount();
  }
}

function count_cat_exp() {
  global $dbj;
  $catexp=$dbj->query('SELECT id_cat_expertise FROM category_expertises');
  if(!empty($catexp)){
   return $catexp->rowCount();
  }
}

function count_diplomas($searchkey=null) {
  global $dbj;
  $dipl=$dbj->query('SELECT id_type_diploma FROM diploma_types '.$searchkey.'');
  if(!empty($dipl)){
    return $dipl->rowCount();
  }
}

function count_companies($searchkey=null, $my_companies=null) {
  global $dbj;
  $query='';
  if($my_companies==true){
    $query='AND companies.id_employer="'.$_SESSION['jbms_back']['id_user'].'"';
  }
  $comp=$dbj->query('SELECT companies.id_company, companies.company_name, companies.company_sn, category_expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_category AS exp_field, adresses.adress, adresses.city, adresses.postal_code, countries.country_code, countries.country_name, companies.active FROM companies LEFT JOIN adresses ON companies.id_adress=adresses.id_adress LEFT JOIN category_expertises ON companies.id_cat_expertise=category_expertises.id_cat_expertise LEFT JOIN countries ON adresses.id_country=countries.id_country LEFT JOIN users ON (companies.id_employer=users.id_user AND users.admin_level="2") WHERE 1=1 '.$query.' '.$searchkey.'');
  if(!empty($comp)){
    return $comp->rowCount();
  }
}

function count_job_offers() {
  global $dbj;
  $jobs=$dbj->query('SELECT job_offers.id_job FROM job_offers LEFT JOIN companies ON job_offers.id_company=companies.id_company LEFT JOIN users ON companies.id_employer=users.id_user WHERE companies.id_employer="'.$_SESSION['jbms_back']['id_user'].'"');
  return $jobs->rowCount();
}

function count_my_candidatures($searchkey=null) {
  global $dbj;
  $cand=$dbj->query('SELECT job_candidatures.id_employee FROM job_offers LEFT JOIN job_type ON job_offers.job_type=job_type.id_job_type INNER JOIN companies ON job_offers.id_company=companies.id_company LEFT JOIN levels_experience ON job_offers.id_level_experience=levels_experience.id_level_experience INNER JOIN levels_education ON job_offers.id_level_education=levels_education.id_level_education INNER JOIN salary_ranges ON job_offers.id_salary=salary_ranges.id_salary INNER JOIN job_candidatures ON job_offers.id_job=job_candidatures.id_job LEFT JOIN users AS employer ON (companies.id_employer=employer.id_user AND employer.admin_level="2") LEFT JOIN users AS employees ON (job_candidatures.id_employee=employees.id_user) INNER JOIN expertises ON job_offers.id_expertise=expertises.id_expertise INNER JOIN category_expertises ON expertises.id_category=category_expertises.id_cat_expertise WHERE job_candidatures.id_employee="'.$_SESSION['jbms_front']['id_user'].'" '.$searchkey.'');
  if(!empty($cand)){
    return $cand->rowCount();
  }
}

function count_all_candidates($searchkey=null, $id_job=null) {
  global $dbj;
  $cand=$dbj->query('SELECT * FROM job_candidatures LEFT JOIN job_offers ON job_candidatures.id_job=job_offers.id_job LEFT JOIN users ON job_candidatures.id_employee=users.id_user LEFT JOIN companies ON job_candidatures.id_company=companies.id_company LEFT JOIN cv_lm ON users.id_user=cv_lm.id_user LEFT JOIN adresses ON users.id_adress=adresses.id_adress LEFT JOIN countries ON adresses.id_country=countries.id_country WHERE companies.id_employer="'.$_SESSION['jbms_back']['id_user'].'" '.$searchkey.' '.$id_job.'');
  if(!empty($cand)){
    return $cand->rowCount();
  }
}

function count_users($searchkey=null) {
  global $dbj;
  $usrs=$dbj->query('SELECT * FROM users WHERE id_user<>"'.$_SESSION['jbms_back']['id_user'].'" '.$searchkey.'');
  if(!empty($usrs)){
    return $usrs->rowCount();
  }
}

function count_favourite_candidates($searchkey=null) {
  global $dbj;
  $fav=$dbj->query('SELECT * FROM profile_favourites LEFT JOIN users ON profile_favourites.id_employer=users.id_user WHERE profile_favourites.id_employer="'.$_SESSION['jbms_back']['id_user'].'" '.$searchkey.'');
  if(!empty($fav)){
   return $fav->rowCount();
  }
}

function count_received_msg() {
  global $dbj;
  $emails=$dbj->query('SELECT DISTINCT emails.id_from FROM emails LEFT JOIN users ON emails.id_to=users.id_user WHERE emails.id_to="'.$_SESSION['jbms_back']['id_user'].'"');
  if(!empty($emails)){
   return $emails->rowCount();
  }
}

function count_sent_msg() {
  global $dbj;
  $emails=$dbj->query('SELECT DISTINCT emails.id_to FROM emails LEFT JOIN users ON emails.id_from=users.id_user WHERE emails.id_from="'.$_SESSION['jbms_back']['id_user'].'"');
  if(!empty($emails)){
   return $emails->rowCount();
  }
}

function get_extension($file_name) {
  return substr(strrchr($file_name,'.'),1);
}

// Function to check strings
function image_upload($image_id, $image_name,  $image_temp, $directory, $image_size, $type, $max_size, $max_height, $max_width, $old_file=null){
    
    $error=0;

    list($width, $height) = getimagesize($image_temp);

    $image_name_only = $image_id.''.rand(100,1000);
    //Get file extension and name to construct new file name 
    $file_info = strtolower($image_name); //image extension
    $file_extension = get_extension($file_info);

    switch ($type) {
    case 'document':
       if (($file_extension!='pdf') && ($file_extension!='doc') && ($file_extension!='docx')){$error=11;}
      break;

      case 'image':
       if (($file_extension!='jpeg') && ($file_extension!='jpg') && ($file_extension!='png') && ($file_extension!='gif')){$error=5;}
        
        if($width>$max_width){$error=7;}
        else if($height>$max_height){$error=8;}
        
        if($image_size>$max_size){$error=6;}

      break;
    }
   

    if ($error==0) {

      if(strlen($old_file)>0){unlink($directory.''.$old_file);}

      //create a random name for new image (Eg: fileName_293749.jpg) ;
     $new_file_name = $image_name_only.'.'.$file_extension;

     if (move_uploaded_file($image_temp, $directory.''.$new_file_name.'')) {
          $error=0;
          $_SESSION['temp_img_name']=$new_file_name;
      }else{
          $error=9;
      }
    }
    return $error;
}

function check_date_format($date){
  $format = "Y-m-d";
  if(date($format, strtotime($date)) == date($date)) {
      $error=0;
  }else{
      $error=0;
  }
}

// Function to check strings
function check_string_length($string_val, $min, $max){
$string=strlen($string_val);

if (empty($string_val) && ($min>0)) {
  $error=1;
}else if($string<$min){
  $error=3;
}else if ($string>$max){
  $error=4;
}else{
  $error=0;
}
  return $error;
}

// Function to check strings
function check_email_length($string_val, $min, $max){
$string=strlen($string_val);
if (empty($string_val)) {
  $error=1;
}else if(!filter_var($string_val, FILTER_VALIDATE_EMAIL)){
  $error=18;
}else if ($string<$min){
  $error=3;
}else if ($string>$max){
  $error=4;
}else{
  $error=0;
}
  return $error;
}

function check_email($string_val, $min, $max){
$string=strlen($string_val);
if (empty($string_val)) {
  $error=1;
}else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
  $error=2;
}else if ($string<$min){
  $error=3;
}else if ($string>$max){
  $error=4;
}else{
  $error=0;
}
  return $error;
}


// Function to check errors
function check_error($error_number=null){
$txt_error='';
  switch ($error_number) {
      case 1:
      $txt_error='Empty values not allowed !';
      break;
    
      case 2:
      $txt_error='Special characters not allowed !';
      break;

      case 3:
      $txt_error='Your text should not be less than the characters specified !';
      break;

      case 4:
      $txt_error='Your text should not be greater than the characters specified !';
      break;

      case 5:
      $txt_error='Extensions allowed: PNG, JPEG, GIF !';
      break;
      
      case 6:
      $txt_error='Please choose a file up to 200 KB !';
      break;
      
      case 7:
      $txt_error='Width must be up to 500 px !';
      break;
      
      case 8:
      $txt_error='Height must be up to 500 px !';
      break;

      case 9:
      $txt_error='Please Retry. Your photo was not uploaded !';
      break;

      case 10:
      $txt_error='Value already exists in the database !';
      break;

      case 11:
      $txt_error='Extensions allowed: PDF, DOC, DOCS !';
      break;

      case 12:
      $txt_error='You didn\'t upload any attachment !';
      break;

      case 13:
      $txt_error='You already applied for this job position !';
      break;

      case 14:
      $txt_error='Your email and birthday do not match in database !';
      break;

      case 15:
      $txt_error='Verification email was sent successfully. Please check your inbox !';
      break;

      case 16:
      $txt_error='Some problem occurred sending email, please try again. !';
      break;

      case 17:
      $txt_error='Date format is incorrect !';
      break;

      case 18:
      $txt_error='Email format is incorrect !';
      break;

      case 19:
      $txt_error='This email is already useed !';
      break;

      case 20:
      $txt_error='SN for the company already exists !';
      break;

      case 21:
      $txt_error='Name for the company already exists !';
      break;

      case 22:
      $txt_error=' can not be deleted, it is used in the database !';
      break;
  }
  return $txt_error;
}

// Function Pagination
function paginate($url, $link, $total, $current, $sectionID, $adj=3) {
  // Initialisation des variables
  $prev = $current - 1; // numéro de la page précédente
  $next = $current + 1; // numéro de la page suivante
  $penultimate = $total - 1; // numéro de l'avant-dernière page
  $pagination = ''; // variable retour de la fonction : vide tant qu'il n'y a pas au moins 2 pages

  if ($total > 1) {
    // Remplissage de la chaîne de caractères à retourner
    $pagination .= "<ul class=\"pagination\">";

    /* =================================
     *  Affichage du bouton [précédent]
     * ================================= */
    if (($current == 3) OR ($current > 3)) {
      // la page courante est la 2, le bouton renvoie donc sur la page 1, remarquez qu'il est inutile de mettre $url{$link}1
      $pagination .= "<li><a href=\"{$url}{$link}1{$sectionID}\"><i class=\"fa fa-angle-double-left\"></i></a></li>";
      $pagination .= "<li><a href=\"{$url}{$link}{$prev}{$sectionID}\"><i class=\"fa fa-angle-left\"></i></a></li>";
   
    } else {
      // dans tous les autres, cas la page est 1 : désactivation du bouton [précédent]
      $pagination .= "<li class=\"page-item disabled\"><a><i class=\"fa fa-angle-left\"></i></a></li>";
    }

    /**
     * Début affichage des pages, l'exemple reprend le cas de 3 numéros de pages adjacents (par défaut) de chaque côté du numéro courant
     * - CAS 1 : il y a au plus 12 pages, insuffisant pour faire une troncature
     * - CAS 2 : il y a au moins 13 pages, on effectue la troncature pour afficher 11 numéros de pages au total
     */

    /* ===============================================
     *  CAS 1 : au plus 12 pages -> pas de troncature
     * =============================================== */
    if ($total < 7 + ($adj * 2)) {
      // Ajout de la page 1 : on la traite en dehors de la boucle pour n'avoir que index.php au lieu de index.php?p=1 et ainsi éviter le duplicate content
      $pagination .= ($current == 1) ? "<li class='active'><a>1</a></li>" : "<li><a href=\"{$url}{$link}1{$sectionID}\">1</a></li>"; // Opérateur ternaire : (condition) ? 'valeur si vrai' : 'valeur si fausse'

      // Pour les pages restantes on utilise itère
      for ($i=2; $i<=$total; $i++) {
        if ($i == $current) {
          // Le numéro de la page courante est mis en évidence (cf. CSS)
          $pagination .= "<li class=\"active\"><a>{$i}</a></li>";
        } else {
          // Les autres sont affichées normalement
          $pagination .= "<li><a href=\"{$url}{$link}{$i}{$sectionID}\">{$i}</a></li>";
        }
      }
    }
    /* =========================================
     *  CAS 2 : au moins 13 pages -> troncature
     * ========================================= */
    else {
      /**
       * Troncature 1 : on se situe dans la partie proche des premières pages, on tronque donc la fin de la pagination.
       * l'affichage sera de neuf numéros de pages à gauche ... deux à droite
       * 1 2 3 4 5 6 7 8 9 … 16 17
       */
      if ($current < 2 + ($adj * 2)) {
        // Affichage du numéro de page 1
        // $pagination .= ($current == 1) ? "<li class=\"active\"><a>1</a></li>" : "<li><a href=\"{$url}{$sectionID}\">1</a></li>";

        // puis des huit autres suivants
        for ($i = 1; $i < 4 + ($adj * 2); $i++) {
          if ($i == $current) {
            $pagination .= "<li class=\"active\"><a>{$i}</a></li>";
          } else {
            $pagination .= "<li><a href=\"{$url}{$link}{$i}{$sectionID}\">{$i}</a></li>";
          }
        }

        // ... pour marquer la troncature

        // et enfin les deux derniers numéros
        $pagination .= '<li><a>&hellip;</a></li>';
        $pagination .= "<li><a href=\"{$url}{$link}{$penultimate}{$sectionID}\">{$penultimate}</a></li>";
        $pagination .= "<li><a href=\"{$url}{$link}{$total}{$sectionID}\">{$total}</a></li>";
      }
      /**
       * Troncature 2 : on se situe dans la partie centrale de notre pagination, on tronque donc le début et la fin de la pagination.
       * l'affichage sera deux numéros de pages à gauche ... sept au centre ... deux à droite
       * 1 2 … 5 6 7 8 9 10 11 … 16 17
       */
      elseif ( (($adj * 2) + 1 < $current) && ($current < $total - ($adj * 2)) ) {
        // Affichage des numéros 1 et 2
        $pagination .= "<li><a href=\"{$url}{$link}1{$sectionID}\">1</a></li>";
        $pagination .= "<li><a href=\"{$url}{$link}2{$sectionID}\">2</a></li>";

        // les pages du milieu : les trois précédant la page courante, la page courante, puis les trois lui succédant
        for ($i = $current - $adj; $i <= $current + $adj; $i++) {
          if ($i == $current) {
            $pagination .= "<li class=\"active\"><a>{$i}</a></li>";
          } else {
            $pagination .= "<li><a href=\"{$url}{$link}{$i}{$sectionID}\">{$i}</a></li>";
          }
        }

        // et les deux derniers numéros
        $pagination .= '<li><a>&hellip;</a></li>';
        $pagination .= "<li><a href=\"{$url}{$link}{$penultimate}{$sectionID}\">{$penultimate}</a></li>";
        $pagination .= "<li><a href=\"{$url}{$link}{$total}{$sectionID}\">{$total}</a></li>";
      }
      /**
       * Troncature 3 : on se situe dans la partie de droite, on tronque donc le début de la pagination.
       * l'affichage sera deux numéros de pages à gauche ... neuf à droite
       * 1 2 … 9 10 11 12 13 14 15 16 17
       */
      else {
        // Affichage des numéros 1 et 2
        $pagination .= "<li><a href=\"{$url}{$link}1{$sectionID}\">1</a></li>";
        $pagination .= "<li><a href=\"{$url}{$link}2{$sectionID}\">2</a></li>";
        $pagination .= '<li><a>&hellip;</a></li>';

        // puis des neuf derniers numéros
        for ($i = $total - (2 + ($adj * 2)); $i <= $total; $i++) {
          if ($i == $current){
            $pagination .= "<li class=\"active\"><a>{$i}</a></li>";
          }else{
            $pagination .= "<li><a href=\"{$url}{$link}{$i}{$sectionID}\">{$i}</a></li>";
          }
        }
      }
    }

    /* ===============================
     *  Affichage du bouton [suivant]
     * =============================== */

    /* =================================
     *  Affichage du bouton [précédent]
     * ================================= */
    if (($total == 3) OR ($total < 3) OR ($total-1 == $current) OR ($total == $current)) {
      // la page courante est la 2, le bouton renvoie donc sur la page 1, remarquez qu'il est inutile de mettre $url{$link}1
      $pagination .= "<li class=\"page-item disabled\"><a><i class='fa fa-angle-right'></i></a></li>";
   
    } else {
      // dans tous les autres, cas la page est 1 : désactivation du bouton [précédent]
      $pagination .= "<li><a href=\"{$url}{$link}{$next}{$sectionID}\"><i class='fa fa-angle-right'></i></a></li>";
      $pagination .= "<li><a href=\"{$url}{$link}{$total}{$sectionID}\"><i class='fa fa-angle-double-right'></i></a></li>";
    }






  //   if ($current == $total){
  //     $pagination .= "<li class=\"page-item disabled\"><a><i class='fa fa-angle-right'></i></a></li>";
  //   }
  //   else{
  //     $pagination .= "<li><a href=\"{$url}{$link}{$next}{$sectionID}\"><i class='fa fa-angle-right'></i></a></li>";
  //     $pagination .= "<li><a href=\"{$url}{$link}{$total}{$sectionID}\"><i class='fa fa-angle-double-right'></i></a></li>";

  //   // Fermeture de la <ul> d'affichage
  //   $pagination .= "</ul>";
  // }
  }
  return ($pagination);
}


// Returning Colors
function getState($state) {

    $color = '';
    switch ($state) {
        case '1': $color = '#4682B4'; 
          $infoactive='<i class="fa fa-check-square-o fa-2x"></i>';
        break; // Blue
        case '0': $color = '#FF0000'; 
         $infoactive='<i class="fa fa-minus-square-o fa-2x"></i>';
        break; // Red
        case '': $color = '#FF0000'; 
         $infoactive='<i class="fa fa-minus-square-o fa-2x"></i>';
        break; // Red
    }

    echo '<span style="color: '.$color.';">'.$infoactive.'</span>';
}

// Returning Colors
function checkOnline($state) {
    $color = '';
    switch ($state) {
        case '1': $color .= '#008000'; break; // Green
        case '0': $color .= '#FF0000'; break; // Red
    }

    if ($state==1) {
      $infoactive=$_SESSION['label_online'];
    }else {
      $infoactive=$_SESSION['label_offline'];
    }
    
    echo '<span style="color: '.$color.';">'.$infoactive.'</span>';
}


// Checking icon of the checkbox
function checkbox($status=null, $value) {
    $val = '';
    switch ($value) {
        case '1': $val .= 'checked'; break; // Green
        case '0': $val .= ''; break; // Red
        default: $val .= ''; break; // Red
    }
  echo '<input type="checkbox" name="'.$status.'" class="js-switch" '.$val.'>';
}

// Checking icon of the checkbox
function checkbox_autosubmit($status=null, $value) {
    $val = '';
    switch ($value) {
        case '1': $val .= 'checked'; break; // Green
        case '0': $val .= ''; break; // Red
        default: $val .= ''; break; // Red
    }
  echo '<input type="checkbox" name="'.$status.'" class="js-switch" '.$val.' onchange="this.form.submit()">';
}

// Checking icon of the money_icon
function money_icon($value=null) {

    $money = '';
    switch ($value) {
        case 'dollar': $money .= $_SESSION['label_dollar']; break; // Dollar
        case 'euro': $money .= $_SESSION['label_euro']; break; // Euro
        default: $money .= $_SESSION['label_dollar']; break; // Dollar
    }
  echo $money;
}


##### Saves image resource to file ##### 
function save_image($source, $destination, $image_type, $quality){
  switch(strtolower($image_type)){//determine mime type
    case 'image/png':
      imagepng($source, $destination); return true; //save png file
      break;
    case 'image/gif':
      imagegif($source, $destination); return true; //save gif file
      break;          
    case 'image/jpeg':
    echo 'jpg';return;
      imagejpeg($source, $destination, $quality); return true; //save jpeg file
      break;
    default: return false;
  }
}

#####  This function will proportionally resize image ##### 
function normal_resize_image($source, $destination, $image_type, $max_size, $image_width, $image_height, $quality){

  if($image_width <= 0 || $image_height <= 0){return false;} //return false if nothing to resize
  
  //do not resize if image is smaller than max size
  if($image_width <= $max_size && $image_height <= $max_size){
    if(save_image($source, $destination, $image_type, $quality)){
      return true;
    }
  }
  
  //Construct a proportional size of new image
  $image_scale  = min($max_size/$image_width, $max_size/$image_height);
  $new_width    = ceil($image_scale * $image_width);
  $new_height   = ceil($image_scale * $image_height);
  
  $new_canvas   = imagecreatetruecolor( $new_width, $new_height ); //Create a new true color image
  
  //Copy and resize part of an image with resampling
  if(imagecopyresampled($new_canvas, $source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height)){
    save_image($new_canvas, $destination, $image_type, $quality); //save resized image
  }

  return true;
}

##### This function corps image to create exact square, no matter what its original size! ######
function crop_image_square($source, $destination, $image_type, $square_size, $image_width, $image_height, $quality){

  if($image_width <= 0 || $image_height <= 0){return false;} //return false if nothing to resize
  
  if( $image_width > $image_height )
  {
    $y_offset = 0;
    $x_offset = ($image_width - $image_height) / 2;
    $s_size   = $image_width - ($x_offset * 2);
  }else{
    $x_offset = 0;
    $y_offset = ($image_height - $image_width) / 2;
    $s_size = $image_height - ($y_offset * 2);
  }
  $new_canvas = imagecreatetruecolor( $square_size, $square_size); //Create a new true color image
  
  //Copy and resize part of an image with resampling
  if(imagecopyresampled($new_canvas, $source, 0, 0, $x_offset, $y_offset, $square_size, $square_size, $s_size, $s_size)){
    save_image($new_canvas, $destination, $image_type, $quality);
  }
  return true;
}

// Cookies function to destroy sessions, if one hour without page refreshing
function startSession($time = 0.1) {
    session_set_cookie_params($time);
    session_name($_SESSION['back']['id_user']);
    session_start();

    // Reset the expiration time upon page load
    if (isset($_COOKIE[$_SESSION['back']['id_user']]))
      setcookie($_SESSION['back']['id_user'], $_COOKIE[$_SESSION['back']['id_user']], time() + $time, "/");
}

// Jquery status controler
function var_status($status=null){
  if ($status=="on") {
     $status=1;
    }else{
     $status=0;
  }
  return $status;
}

// update, insert, delete actions auditor
function actions_auditor($action_type, $table_name, $id_value){

  global $dbj;

  $create_auditor=$dbj->exec('INSERT INTO auditor_admin (id_user, action_type, table_name, id_value) VALUES ('.$_SESSION['back']['id_user'].','.$action_type.', "'.$table_name.'", '.$id_value.')');
}

function nbr_img($value){

  $result=$_SESSION['max_photo_room']-$value;
  return $result;
}

function set_message($id_notification, $text){
  if (!empty($id_notification) && !empty($text)) {
    $_SESSION['id_notification']=$id_notification;
    $_SESSION['txt_msg']=$text;
  }
}

function clear_notification(){
  $_SESSION['id_notification']="";
  $_SESSION['text']="";
}

function log_message(){

    global $dbj;

    if(!empty($_SESSION['id_notification'])){$id_notification=$_SESSION['id_notification'];}else{$id_notification='';}

    if(!empty($_SESSION['txt_msg'])){$txt_msg=$_SESSION['txt_msg'];}else{$txt_msg='';}

    $msg=$dbj->query('SELECT * FROM notifications WHERE id_notification="'.$id_notification.'"');
    $count_msg=$msg->rowCount();
    $row_msg=$msg->fetch(PDO::FETCH_ASSOC);

  if ($count_msg>0) {
    $result_txt='<script type="text/javascript">
        $(window).load(function(){
            reset();
            alertify.'.$row_msg['msg_type'].'("'.$txt_msg.'");
    });

    </script>';
    echo $result_txt;
  }
    clear_notification();
}

function getRealIPAddr()
{
  if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
  {
    $ip=$_SERVER['HTTP_CLIENT_IP'];
  }
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
  {
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  else
  {
    $ip=$_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}

function getRomanNumerals($decimalInteger) 
{
 $n = intval($decimalInteger);
 $res = '';

 $roman_numerals = array(
    'M'  => 1000,
    'CM' => 900,
    'D'  => 500,
    'CD' => 400,
    'C'  => 100,
    'XC' => 90,
    'L'  => 50,
    'XL' => 40,
    'X'  => 10,
    'IX'  => 9,
    'VIII'  => 8,
    'VII'  => 7,
    'VI'  => 6,
    'V'  => 5,
    'IV' => 4,
    'III' => 3,
    'II' => 2,
    'I'  => 1);

 foreach ($roman_numerals as $roman => $numeral) 
 {
  $matches = intval($n / $numeral);
  $res .= str_repeat($roman, $matches);
  $n = $n % $numeral;
 }

 return $res;
}

?>