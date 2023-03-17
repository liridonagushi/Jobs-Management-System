<?php
// Including functions
require_once('assets/include/functions.php');

// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('assets/include/variables.php');

$total = count_favourite_candidates($_SESSION[$filename]['search_query']);

// Label and number of users
$title_total_results=$total.' Candidates';

// Including pagination elements through the file construct_paination.php
include('construct_pagination.php');

// Including header content
require_once('assets/css_header.php');
?>

<body>
<!-- PRELOADER -->
<div class="page-loader">
  <div class="loader">Loading...</div>
</div> 
<!-- Including menu -->
<?php include('left_menu.php'); ?>

<!-- Content side content -->
<div class="content">

<!-- Search -->
<div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <h4 class="margintop40px"><b><i class="fa fa-file-o"></i> Favourite Candidates</b></h4>
      <hr class="divider-menu">
    </div>
  </div>
</div>

<section id="adminheader">
  <div class="container">

    <form name="name" method="post" action="post_search_employees.php">
    <input type="hidden" name="filename" value="<?php echo $filename;?>">
      <div class="form-group col-md-3">
        <input type="text" name="id_employee"  value="<?php echo $_SESSION[$filename]['id_employee']; ?>" class="form-control" placeholder="Employee SN">
      </div>

      <div class="form-group col-md-3">
        <input type="text" name="emp_name"  value="<?php echo $_SESSION[$filename]['emp_name']; ?>" class="form-control" placeholder="Employee Name">
      </div>

      <div class="form-group col-md-3">
        <input type="submit" name="name" class="form-control btn-default" value="SEARCH">
      </div>

      <div class="form-group col-md-3">
        <input type="submit" name="reset" class="form-control btn-default" value="RESET">
      </div>
    </form>
    
  </div>
</section>

<!-- Module showing results -->
<section id="module" class="bg-gray">
  <h5 class="padding30"><b><?php echo $title_total_results;?></b></h5>
  <div class="container-custom-grid">
   <div class="row">
    <div class="col-md-12">

    <?php 
    $comp=$dbj->query('SELECT DISTINCT profile_favourites.id_favourite, employees.id_user AS id_employee, employees.name,  employees.surname,  employees.email AS employee_email, employees.phone_number, profile_favourites.id_employer, adresses.adress, adresses.city,  adresses.postal_code, countries.country_code, countries.country_name, cv_lm.cv_code, cv_lm.lm_code FROM profile_favourites LEFT JOIN users as employees ON (profile_favourites.id_employee=employees.id_user) LEFT JOIN users as employers ON (profile_favourites.id_employer=employers.id_user AND employers.admin_level=2) LEFT JOIN adresses ON employees.id_adress=adresses.id_adress LEFT JOIN countries ON adresses.id_country=countries.id_country  LEFT JOIN cv_lm ON employees.id_user=cv_lm.id_user WHERE profile_favourites.id_employer="'.$_SESSION['jbms_back']['id_user'].'" '.$_SESSION[$filename]['search_query'].' '.$_SESSION[$filename]['orderby'].' LIMIT '.$start.', '.$_SESSION['epp'].'');
    ?>
    <!-- MODULE rows -->
    <?php if($comp->rowCount()>0){
          while($row_comp=$comp->fetch(PDO::FETCH_ASSOC)){ 
    ?>

    <div class="wizard-card row border padding30">

      <div class="form-group col-lg-2">
      <h4 class="iconbox-header">Employee <i class="fa fa-user fa-1x"></i></h4>
        <fieldset>
        ID: <?php echo $row_comp['id_employee'];?>
        </fieldset>
        <fieldset>
        <?php echo $row_comp['name'];?>
        <?php echo $row_comp['surname'];?>
        </fieldset>

      </div>

      <div class="form-group col-lg-2">
        <h4 class="iconbox-header">Email <i class="fa fa-envelope fa-1x"></i></h4>
        <fieldset>
        <?php echo $row_comp['employee_email'];?>
        </fieldset>
      </div>

      <div class="form-group col-lg-2">
        <h4 class="iconbox-header">Phone <i class="fa fa-phone fa-1x"></i></h4>
        <fieldset>
        <?php echo $row_comp['phone_number'];?>
        </fieldset>
      </div>

      <div class="form-group col-lg-2">
        <h4 class="iconbox-header">Country <i class="fa fa-map-marker fa-1x"></i></h4>
        <fieldset>
        <?php echo $row_comp['country_code'];?>
        <?php echo $row_comp['country_name'];?>
        </fieldset>
        <fieldset>
        <?php echo $row_comp['city'];?>
        <?php echo $row_comp['postal_code'];?>
        <?php echo $row_comp['adress'];?>
        </fieldset>
      </div>
      <div class="form-group col-lg-2">
        <h4 class="iconbox-header">Joints <i class="fa fa-file-pdf-o fa-1x"></i></h4>
         <fieldset>
          <a href="download_attachments.php?id_employee=<?php echo $row_comp['id_employee'];?>&target=cv" target="new"><?php echo $row_comp['cv_code'];?></a>
        </fieldset>
          <fieldset>
          <a href="download_attachments.php?id_employee=<?php echo $row_comp['id_employee'];?>&target=lm" target="new"><?php echo $row_comp['lm_code'];?></a>
        </fieldset>
      </div>

    <script type="text/javascript">
      function confirm_remove(id_user, name, surname, id_favourite){
      if(confirm('You are removing '+name+' '+surname+' from your favourite candidates ?')){
         window.location.href='post_process_favourites.php?id_user='+id_user+'&name='+name+'&surname='+surname+'&target=remove_from_page';
     }
    }
    </script>

       <div class="col-md-2 text-center">
       <div class="button-group">
        <!-- Group buttons -->
         <a class="btn-optionsmenu button-dropdown" href="#" data-toggle="dropdown">Options <i class="fa fa-arrow-down fa-1x"></i></a>
          <ul class="dropdown-menu optionsmenu" role="menu">
            <li><a class="fancybox fancybox.iframe" href="view_emp_profile.php?id_user=<?php echo $row_comp['id_employee'];?>"><i class="fa fa-user fa-1x"></i> View Profile</a></li>
          <li><a href="javascript:confirm_remove('<?php echo $row_comp['id_employee'];?>','<?php echo $row_comp['name'];?>','<?php echo $row_comp['surname'];?>','<?php echo $module;?>')"><i class="fa fa-remove fa-1x"></i> Remove from Favourites</a></li>
   
            <li><a class="fancybox fancybox.iframe" href="send_email.php?id_user=<?php echo $row_comp['id_employee'];?>"><i class="fa fa-envelope fa-1x"></i> Send en email</a></li>
          </ul>
      </div>
      </div>

    </div>

    <?php } }else{ ?>
      <div class="row border">
        <div class="form-group col-lg-12 text-center">
        <fieldset class="padding30">No data found</fieldset>
        </div>
      </div>
    <?php }?>
    <?php if ($nbPages>1) {?>

    <div class="pagination">
     <?php echo paginate($module, '?p=', $nbPages, $current, '#module'); ?>
    </div>

    <?php } ?>
    </div>
  </div>
</section>

  <!-- Including Footer file -->
  <?php require_once('footer.php');?>
<!-- /WRAPPER -->
</div>

<!-- Including Footer file -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>