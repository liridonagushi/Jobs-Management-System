<?php
// Including functions
require_once('assets/include/functions.php');

// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('assets/include/variables.php');


// Function to check logged in user
login_oneadmin();

// Query of the database
$count_exp = $dbj->query('SELECT levels_experience.id_level_experience, levels_experience.'.$_SESSION['jbms_front']['lang_code'].'_level_experience AS level_experience FROM levels_experience WHERE 1=1 '.$_SESSION[$filename]['search_query'].' '.$_SESSION[$filename]['orderby'].'');

$total = $count_exp->rowCount();

// Label and number of users
$title_total_results=$total.' Levels';

// Including pagination elements through the file construct_paination.php
include('construct_pagination.php');

// Including header content
require_once('assets/css_header.php');
?>
<body>

<!-- Including menu -->
<?php include('left_menu.php'); ?>

<!-- Content side content -->
<div class="content">

<!-- Module to insert -->
<section id="insButton">
  <a class="fancybox fancybox.iframe btn btn-dark" href="ins_explevel.php">Insert an Experience <i class="fa fa-plus-square fa-1x"></i></a>
</section>

<!-- Search -->
<div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <h4 class="padding10"><b><i class="fa fa-file-o"></i> Experience Levels</b></h4>
       <hr class="divider-menu">
    </div>
  </div>
</div>

<!-- Module Search -->
<section id="adminheader">
  <div class="container">
    <form name="name" method="post" action="post_search_explevels.php">
    <input type="hidden" name="filename" value="<?php echo $filename;?>">

      <div class="form-group col-md-4">
        <input type="text" name="title"  value="<?php echo $_SESSION[$filename]['title'];?>" class="form-control" placeholder="Search Level">
      </div>

      <div class="form-group col-md-4">
        <input type="submit" name="name" class="form-control btn-default" value="SEARCH">
      </div>

      <div class="form-group col-md-4">
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

    <?php $exp_level=$dbj->query('SELECT levels_experience.id_level_experience, levels_experience.'.$_SESSION['jbms_front']['lang_code'].'_level_experience AS level_experience, levels_experience.years_experience, levels_experience.active FROM levels_experience WHERE 1=1 '.$_SESSION[$filename]['search_query'].' '.$_SESSION[$filename]['orderby'].' LIMIT '.$start.', '.$_SESSION['epp'].'');
    ?>
    <script type="text/javascript">
    function confirm_delete(id_level_experience, level_experience){
      if(confirm('You are removing level '+level_experience+' ?')){
         window.location.href='post_del_explevel.php?id_level_experience='+id_level_experience+'&level_experience='+level_experience+'';
     }
    }
    </script>
    <!-- MODULE rows -->
    <?php if($exp_level->rowCount()>0){
          while($row_exp=$exp_level->fetch(PDO::FETCH_ASSOC)){ 
    ?>

    <div class="wizard-card row border padding30">

      <div class="col-md-4">
      <h4 class="iconbox-header">Experience Level</h4>
        <fieldset>
          <?php echo $row_exp['level_experience'];?>
        </fieldset>
      </div>

      <div class="col-md-4">
      <h4 class="iconbox-header">Years Experience</h4>
        <fieldset>
          <?php echo $row_exp['years_experience'];?>
        </fieldset>
      </div>

      <div class="col-md-2">
        <h4 class="iconbox-header">Active</h4>
        <fieldset>
          <?php echo getState($row_exp['active']);?>
        </fieldset>
      </div>


     <div class="col-md-2 text-center">
     <div class="button-group">
      <!-- Group buttons -->
       <a class="btn-optionsmenu button-dropdown" href="#" data-toggle="dropdown">Options <i class="fa fa-arrow-down fa-1x"></i></a>
        <ul class="dropdown-menu optionsmenu" role="menu">
              <li><a class="fancybox fancybox.iframe" href="upd_explevel.php?id_level_experience=<?php echo $row_exp['id_level_experience'];?>"><i class="fa fa-edit fa-1x"></i> Update Level</a></li>
              <li><a href="javascript:confirm_delete('<?php echo $row_exp['id_level_experience'];?>','<?php echo $row_exp['level_experience'];?>')"><i class="fa fa-remove fa-1x"></i> Remove</a></li>
            </ul>
      </div>
      </div>
    </div>

    <?php } }else{ ?>
      <div class="row border">
        <div class="form-group col-md-12 text-center">
        <fieldset class="padding30">No data found</fieldset>
        </div>
      </div>
    <?php } ?>
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
<!-- Including JS Content -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>