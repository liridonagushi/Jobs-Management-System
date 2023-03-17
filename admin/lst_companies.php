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
login_twoadmin();

// Total companies
$total = count_companies($_SESSION[$filename]['search_query'], $my_companies=true);

// Label and number of companies
$title_total_results=$total.' Companies';

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
  <a class="fancybox fancybox.iframe btn btn-dark" href="ins_company.php">Insert a Company <i class="fa fa-plus-square fa-1x"></i></a>
  <?php if(count_companies('', $my_companies=true)==0){ ?><img src="assets/images/arrow-left.gif" height="30" /><?php } ?>
</section>

<!-- Search -->
<div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <h4 class="padding10"><b><i class="fa fa-file-o"></i> My Companies</b></h4>
      <hr class="divider-menu">
    </div>
  </div>
</div>

<section id="adminheader">
  <div class="container">
    <form name="name" method="post" action="post_search_companies.php">
    <input type="hidden" name="filename" value="<?php echo $filename;?>">
    <input type="hidden" name="module" value="<?php echo $module;?>">
      <div class="form-group col-lg-3">
        <input type="text" name="search_comp"  value="<?php echo $_SESSION[$filename]['search_comp'];?>" class="form-control" placeholder="Company SN, Name">
      </div>

      <div class="form-group col-lg-3 text-left">
        <select id="id_cat_expertise" name="id_cat_expertise" class="form-control">
        <option value="">Expertise Categories</option>
        <?php $exp=$dbj->query('SELECT * FROM category_expertises');
        while($row_exp=$exp->fetch(PDO::FETCH_ASSOC)){
        ?>
        <option value="<?php echo $row_exp['id_cat_expertise'];?>" <?php if($row_exp['id_cat_expertise']==$_SESSION[$filename]['id_cat_expertise']){ ?> selected="selected" <?php } ?>><?php echo $row_exp[''.$_SESSION['jbms_front']['lang_code'].'_expertise_category'];?></option>

        <?php } ?>
        </select>
      </div>
      <div class="form-group col-lg-3">
        <input type="submit" name="name" class="form-control btn-default" value="SEARCH">
      </div>

      <div class="form-group col-lg-3">
        <input type="submit" name="reset" class="form-control btn-default" value="RESET">
      </div>
    </form>  
  </div>
</section>

<!-- Showing results -->
<section id="module" class="bg-gray">
  <h5 class="padding30"><b><?php echo $title_total_results;?></b></h5>
  <div class="container-custom-grid">
   <div class="row">
    <div class="col-md-12">

    <?php $comp=$dbj->query('SELECT companies.id_company, companies.company_name, companies.company_sn, category_expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_category AS exp_field, adresses.adress, adresses.city, adresses.postal_code, countries.country_code, countries.country_name, companies.active FROM companies LEFT JOIN adresses ON companies.id_adress=adresses.id_adress LEFT JOIN category_expertises ON companies.id_cat_expertise=category_expertises.id_cat_expertise LEFT JOIN countries ON adresses.id_country=countries.id_country LEFT JOIN users ON (companies.id_employer=users.id_user AND users.admin_level="2") WHERE companies.id_employer="'.$_SESSION['jbms_back']['id_user'].'" '.$_SESSION[$filename]['search_query'].' '.$_SESSION[$filename]['orderby'].' LIMIT '.$start.', '.$_SESSION['epp'].'');
    ?>
    <script type="text/javascript">
    function confirm_delete(id, value){
      if(confirm('Are you sure to delete '+value+' and it\'s job offers ?')){
         window.location.href='post_del_company.php?id_company='+id+'&company_name='+value+'';
     }
    }
    </script>
    <!-- MODULE rows -->
    <?php if($comp->rowCount()>0){
          while($row_comp=$comp->fetch(PDO::FETCH_ASSOC)){ 
    ?>

    <div class="wizard-card row border padding30">

      <div class="form-group col-lg-2">
      <h4 class="iconbox-header">Company Name</h4>
        <fieldset>
        <?php echo $row_comp['company_name'];?>
        </fieldset>
      </div>

      <div class="form-group col-lg-2">
        <h4 class="iconbox-header">SN</h4>
        <fieldset>
        <?php echo $row_comp['company_sn'];?>
        </fieldset>
      </div>

      <div class="form-group col-lg-2">
        <h4 class="iconbox-header">Expertise Category</h4>
        <fieldset>
        <?php echo $row_comp['exp_field'];?>
        </fieldset>
      </div>

      <div class="form-group col-lg-2">
        <h4 class="iconbox-header">City, Country</h4>
        <fieldset>
        <?php echo $row_comp['postal_code'];?>
        <?php echo $row_comp['city'];?>
        <?php echo $row_comp['country_name'];?>
        </fieldset>
      </div>
      
      <div class="form-group col-lg-2">
        <h4 class="iconbox-header">Active</h4>
        <fieldset>
          <?php echo getState($row_comp['active']);?>
        </fieldset>
      </div>

       <div class="col-md-2 text-center">
       <div class="button-group">
        <!-- Group buttons -->
         <a class="btn-optionsmenu button-dropdown" href="#" data-toggle="dropdown">Options <i class="fa fa-arrow-down fa-1x"></i></a>
          <ul class="dropdown-menu optionsmenu" role="menu">
              <li><a class="fancybox fancybox.iframe" href="upd_company.php?id_company=<?php echo $row_comp['id_company'];?>"><i class="fa fa-edit fa-1x"></i> Update</a></li>
              <li><a href="file_company.php?id_company=<?php echo $row_comp['id_company'];?>" target="_New"><i class="fa fa-file-pdf-o fa-1x"></i> PDF File</a></li>
              <li><a href="javascript:confirm_delete('<?php echo $row_comp['id_company'];?>','<?php echo $row_comp['company_name'];?>')"><i class="fa fa-remove fa-1x"></i> Remove</a></li>
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
<script type="text/javascript">
// Fancy Box Script
$(document).ready(function() {
$(".comp").fancybox({
   padding : 0,
   width : "1050",
  'afterClose':function () {
  window.location.reload();
  },
});
});
</script>
<!-- Including Footer file -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>