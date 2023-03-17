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
$count_category = $dbj->query('SELECT category_expertises.id_cat_expertise FROM category_expertises WHERE 1=1 '.$_SESSION[$filename]['search_query'].'');

$total = $count_category->rowCount();

// Label and number of users
$title_total_results=$total.' Job Categories';

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
  <a class="fancybox fancybox.iframe btn btn-dark" href="ins_category.php">Insert a Category <i class="fa fa-plus-square fa-1x"></i></a>
</section>

<!-- Search -->
<div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <h4 class="padding10"><b><i class="fa fa-file-o"></i> Job Categories</b></h4>
       <hr class="divider-menu">
    </div>
  </div>
</div>

<!-- Module Search -->
<section id="adminheader">
  <div class="container">
    <form name="name" method="post" action="post_search_categories.php">
    <input type="hidden" name="filename" value="<?php echo $filename;?>">

      <div class="form-group col-lg-4 text-left">
        <select id="id_cat_expertise" name="id_cat_expertise" class="form-control">
        <option value="">Choose</option>
        <?php $exp=$dbj->query('SELECT * FROM category_expertises ORDER BY id_cat_expertise');
        while($row_exp=$exp->fetch(PDO::FETCH_ASSOC)){
        ?>
        <option value="<?php echo $row_exp['id_cat_expertise'];?>" <?php if($row_exp['id_cat_expertise']==$_SESSION[$filename]['id_cat_expertise']){ ?> selected <?php } ?>><?php echo $row_exp[''.$_SESSION['jbms_front']['lang_code'].'_expertise_category'];?></option>

        <?php } ?>
        </select>
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

    <?php $cat_exp=$dbj->query('SELECT category_expertises.id_cat_expertise, category_expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_category AS expertise_category, category_expertises.active FROM category_expertises WHERE 1=1 '.$_SESSION[$filename]['search_query'].' ORDER BY category_expertises.id_cat_expertise DESC LIMIT '.$start.', '.$_SESSION['epp'].'');
    ?>

    <script type="text/javascript">
    function confirm_delete(id_cat_expertise, expertise_category){
      if(confirm('You are removing '+expertise_category+' ?')){
         window.location.href='post_del_category.php?id_cat_expertise='+id_cat_expertise+'&expertise_category='+expertise_category+'';
     }
    }
    </script>
    <!-- MODULE rows -->
    <?php if($cat_exp->rowCount()>0){
          while($row_cat=$cat_exp->fetch(PDO::FETCH_ASSOC)){ 
    ?>

    <div class="wizard-card row border padding30">

      <div class="col-lg-8">
      <h4 class="iconbox-header">Category</h4>
        <fieldset>
          <?php echo $row_cat['expertise_category'];?>
        </fieldset>
      </div>

      <div class="col-lg-2">
        <h4 class="iconbox-header">Active</h4>
        <fieldset>
        <?php echo getState($row_cat['active']);?>
        </fieldset>
      </div>


       <div class="col-md-2 text-center">
       <div class="button-group">
        <!-- Group buttons -->
         <a class="btn-optionsmenu button-dropdown" href="#" data-toggle="dropdown">Options <i class="fa fa-arrow-down fa-1x"></i></a>
          <ul class="dropdown-menu optionsmenu" role="menu">
              <li><a class="fancybox fancybox.iframe" href="upd_category.php?id_cat_expertise=<?php echo $row_cat['id_cat_expertise'];?>"><i class="fa fa-edit fa-1x"></i> Update Category</a></li>
              <li><a href="javascript:confirm_delete('<?php echo $row_cat['id_cat_expertise'];?>','<?php echo $row_cat['expertise_category'];?>')"><i class="fa fa-remove fa-1x"></i> Remove</a></li>
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