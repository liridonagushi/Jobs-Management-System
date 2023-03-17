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

$total = count_diplomas($_SESSION[$filename]['search_query']);

// Label and number of users
$title_total_results=$total.' Diplomas';

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
  <a class="fancybox fancybox.iframe btn btn-dark" href="ins_diploma.php">Insert a diploma <i class="fa fa-plus-square fa-1x"></i></a>
</section>

<!-- Search -->
<div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <h4 class="padding10"><b><i class="fa fa-file-o"></i> Diploma Types</b></h4>
      <hr class="divider-menu">
    </div>
  </div>
</div>

<!-- Module Search -->
<section id="adminheader">
  <div class="container">
    <form name="name" method="post" action="post_search_diplomas.php">
    <input type="hidden" name="filename" value="<?php echo $filename;?>">
      <div class="form-group col-lg-4">
        <input type="text" name="title"  value="<?php echo $_SESSION[$filename]['title']; ?>" class="form-control" placeholder="Search Diploma">
      </div>

      <div class="form-group col-lg-4">
        <input type="submit" name="name" class="form-control btn-default" value="SEARCH">
      </div>

      <div class="form-group col-lg-4">
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

    <?php $typdipl=$dbj->query('SELECT diploma_types.id_type_diploma, diploma_types.type_diploma, diploma_types.active FROM diploma_types WHERE 1=1 '.$_SESSION[$filename]['search_query'].' ORDER BY diploma_types.id_type_diploma DESC LIMIT '.$start.', '.$_SESSION['epp'].'');
    ?>

    <script type="text/javascript">
    function confirm_delete(id_type_diploma, type_diploma){
      if(confirm('You are removing '+type_diploma+' diploma ?')){
        window.location.href='post_del_diploma.php?id_type_diploma='+id_type_diploma+'&type_diploma='+type_diploma+'';
      }
    }
    </script>

    <!-- Counting rows -->
    <?php if($typdipl->rowCount()>0){
    while($row_dipl=$typdipl->fetch(PDO::FETCH_ASSOC)){ 
    ?>

    <div class="wizard-card row border padding30">

    <div class="col-md-8">
      <h4 class="iconbox-header">Type Diploma</h4>
      <fieldset>
       <?php echo $row_dipl['type_diploma'];?>
      </fieldset>
    </div>

    <div class="col-md-2">
      <h4 class="iconbox-header">Active</h4>
      <fieldset>
        <?php echo getState($row_dipl['active']);?>
      </fieldset>
      </div>

    <div class="col-md-2 text-center">
      <div class="button-group">
      <!-- Group buttons -->
      <a class="btn-optionsmenu button-dropdown" href="#" data-toggle="dropdown">Options <i class="fa fa-arrow-down fa-1x"></i></a>
        <ul class="dropdown-menu optionsmenu" role="menu">
          <li><a class="fancybox fancybox.iframe" href="upd_diploma.php?id_type_diploma=<?php echo $row_dipl['id_type_diploma'];?>"><i class="fa fa-edit fa-1x"></i> Update Diploma</a></li>
          <li><a href="javascript:confirm_delete('<?php echo $row_dipl['id_type_diploma'];?>','<?php echo $row_dipl['type_diploma'];?>')"><i class="fa fa-remove fa-1x"></i> Remove</a></li>
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
</section>

  <!-- Including Footer file -->
  <?php require_once('footer.php');?>
<!-- /WRAPPER -->
</div>

<!-- Including JS Content -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>