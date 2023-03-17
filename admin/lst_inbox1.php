<?php
// Including functions
require_once('assets/include/functions.php');

// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('assets/include/variables.php');



// Query of the database
$job_offers = $dbj->query('SELECT DISTINCT from_user.id_user AS fromuser FROM emails LEFT JOIN users AS from_user ON(emails.id_from=from_user.id_user) LEFT JOIN users AS to_user ON(emails.id_to=to_user.id_user) WHERE emails.id_to="'.$_SESSION['jbms_back']['id_user'].'" AND emails.active_idfrom="1" '.$_SESSION['jbms_back_msg_inbox']['search_query'].'');

$total = $job_offers->rowCount();

// Label and number of users
$title_total_results=$total.' Candidates';

// Including pagination elements through the file construct_paination.php
include('construct_pagination.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php // include('assets/include/header.php'); ?>

<!-- Latest compiled and minified CSS -->

<!-- Bootstrap core CSS -->
<link href="assets/bootstrap/336/css/bootstrap.min.css" rel="stylesheet">

<!-- Icon Fonts -->
<link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- <link href="assets/css/font-awesome/font-awesome.min.css" rel="stylesheet"> -->

<!-- Template core CSS -->
<link href="assets/css/admin_style.css" rel="stylesheet">

<!-- Alerts styles-->
<link rel="stylesheet" href="assets/css/alerts/alertify.core.css" />
<link rel="stylesheet" href="assets/css/alerts/alertify.default.css" id="toggleCSS" />
<link rel="stylesheet" type="text/css" href="assets/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type="text/javascript" src="assets/js/jquery-ui-1.12.0/external/jquery/jquery.js"></script>

</head>
<body>

<!-- PRELOADER -->
 <div class="page-loader">
  <div class="loader">Loading...</div>
</div>

<!-- Including menu -->
<?php include('left_menu.php'); ?>

<!-- Content side wrapper -->
<div class="wrapper">

<!-- styled hr -->
<hr class="divider">

  <!-- Module TITLE -->
<section class="module bg-gray">
<div class="container-custom-grid">
  <div class="col-sm-12 text-right">
    <p><h4><?php echo $_SESSION['jbms_back']['name'].' '.$_SESSION['jbms_back']['surname'];?> </h4></p>
  </div>
  <div class="col-sm-12 text-right">
    <?php echo $_SESSION['jbms_back']['expertise_area']; ?>
  </div>
</div>
</section>

<!-- Button to insert a company -->
<section class="module">
  <a class="fancybox fancybox.iframe btn btn-dark" href="ins_job_offer.php">Insert a Job Offer <i class="fa fa-plus-square fa-1x"></i></a>
</section>


<!-- Module Search -->
<section class="module">
  <div class="row">
    <form name="name" method="post" action="post_search_offres.php">
    <input type="hidden" name="filename" value="<?php echo $filename;?>">
      <div class="form-group col-lg-3">
        <h4 class="iconbox-title font-alt">Job Title, SN </h4>
        <input type="text" name="search_comp"  value="<?php echo $_SESSION['jbms_back_msg_inbox']['search_comp']; ?>" class="form-control" placeholder="Search Company">
      </div>

      <div class="form-group col-lg-3 text-left">
        <h4 class="iconbox-title font-alt">Expertise Category</h4>
        <select id="id_cat_expertise" name="id_cat_expertise" class="form-control">
        <option value="">Choose</option>
        <?php $exp=$dbj->query('SELECT * FROM category_expertises');
        while($row_exp=$exp->fetch(PDO::FETCH_ASSOC)){
        ?>
        <option value="<?php echo $row_exp['id_cat_expertise'];?>" <?php if($row_exp['id_cat_expertise']==$_SESSION['jbms_back_msg_inbox']['id_cat_expertise']){ ?> selected <?php } ?>><?php echo $row_exp['expertise_category'];?></option>

        <?php } ?>
        </select>
      </div>

      <div class="form-group col-lg-3">
        <h4 class="iconbox-title font-alt">&nbsp;</h4>
        <input type="submit" name="name" class="form-control btn-info" value="FILTER">
      </div>

      <div class="form-group col-lg-3">
        <h4 class="iconbox-title font-alt">&nbsp;</h4>
        <input type="submit" name="reset" class="form-control btn-info" value="RESET">
      </div>

    </form>  
  </div>
</section>

<!-- Module showing results -->
<section class="module bg-gray">
  <div class="row">
    <div class="col-lg-12">
    <h4 class="padding30"><b><?php echo $total;?></b> Total Offers </h4>

    <div class="container-custom-grid">

    <?php $comp=$dbj->query('SELECT DISTINCT from_user.id_user AS fromuser, to_user.id_user AS touser, from_user.name AS fromname, from_user.surname AS fromsurname, from_user.email AS fromemail, to_user.email AS toemail, to_user.name AS toname, to_user.surname AS tosurname, emails.id_email, emails.object_title, emails.message, emails.time_message FROM emails LEFT JOIN users AS from_user ON(emails.id_from=from_user.id_user) LEFT JOIN users AS to_user ON(emails.id_to=to_user.id_user) WHERE emails.id_to="'.$_SESSION['jbms_back']['id_user'].'" AND emails.active_idfrom="1" '.$_SESSION['jbms_back_msg_inbox']['search_query'].' '.$_SESSION['jbms_back_msg_inbox']['orderby'].' LIMIT '.$start.', '.$_SESSION['epp'].'');
    ?>
    <script type="text/javascript">
    function confirm_delete(id_job, job_title){
      if(confirm('You are removing the job offer '+job_title+' ?')){
         window.location.href='post_del_offer.php?id_job='+id_job+'&job_title='+job_title+'';
     }
    }
    </script>
    <!-- MODULE rows -->
    <?php if($comp->rowCount()>0){
          while($row_comp=$comp->fetch(PDO::FETCH_ASSOC)){ 
    ?>

    <div class="wizard-card row border padding30">
      <div class="col-lg-2">
        <h4 class="iconbox-header">Job SN</h4>
        <fieldset>
        <?php echo $row_comp['job_sn'];?>
        </fieldset>
      </div>

      <div class="col-lg-2">
      <h4 class="iconbox-header">Expertise Area</h4>
        <fieldset>
          <?php echo $row_comp['expertise_category'];?>
          <?php echo $row_comp['expertise_area'];?>
        </fieldset>
        <fieldset>
         Experience years: <b>  <?php echo $row_comp['years_experience'];?></b>
        </fieldset>
        <fieldset>
          Required: <b> <?php echo $row_comp['level_education'];?></b>
        </fieldset>
      </div>

      <div class="col-lg-2">
        <h4 class="iconbox-header">Job Title</h4>
        <fieldset>
        <?php echo $row_comp['job_title'];?>
        </fieldset>
      </div>

      <div class="col-lg-2">
        <h4 class="iconbox-header">Dates Active</h4>
        <fieldset>
        <i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?php echo date("m.d.y", strtotime($row_comp["publish_date"]));?>
        </fieldset>
        <fieldset>
         <i class="fa fa-calendar-times-o" aria-hidden="true"></i> <?php echo date("m.d.y", strtotime($row_comp["closing_date"]));?>
        </fieldset>
      </div>
      <div class="col-lg-2">
        <h4 class="iconbox-header">Company</h4>
        <fieldset>
        <?php echo $row_comp['company_name'];?>
        </fieldset>
      </div>

      <div class="col-lg-2 text-center ">
          <!-- Group buttons -->
           <a class="dropdown-toggle btn btn-sm btn-default btn-round"  data-toggle="dropdown" href="#">Options <i class="fa fa-arrow-down fa-1x"></i></a>
              <?php $count=$dbj->query('SELECT id_job FROM job_candidatures WHERE id_job="'.$row_comp['id_job'].'"'); 
                    $countcand=$count->rowCount();
              ?>
            <ul class="dropdown-menu" role="menu">
              <li><a href="lst_candidates.php?id_job=<?php echo $row_comp['id_job'];?>"><i class="fa fa-group fa-1x"></i> Candidates <span class="view"><?php echo $countcand;?></span></a></li>
              <li><a class="fancybox fancybox.iframe" href="upd_job_offer.php?id_job=<?php echo $row_comp['id_job'];?>"><i class="fa fa-edit fa-1x"></i> Modify Job</a></li>
              <li><a href="javascript:confirm_delete('<?php echo $row_comp['id_job'];?>','<?php echo $row_comp['job_title'];?>')"><i class="fa fa-remove fa-1x"></i> Remove</a></li>
            </ul>
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
     <?php echo paginate('lst_job_offers.php', '?p=', $nbPages, $current); ?>
    </div>

    <?php } ?>
    </div>
  </div>
</section>

  <!-- Including Footer file -->
  <?php require_once('footer.php');?>
<!-- /WRAPPER -->
</div>
<!-- Showing alert messages -->
<?php echo log_message(); ?>
<!-- Alerts -->
<script type="text/javascript">
function reset () {
  $("#toggleCSS").attr("href", "assets/css/alerts/alertify.default.css");
  alertify.set({
    labels : {
      ok     : "OK",
      cancel : "Cancel"
    },
      delay : 20000,
      buttonReverse : false,
      buttonFocus   : "ok"
  });
}
// Fancy Box Script
$(document).ready(function() {

$(".fancybox").fancybox({
  autoSize : false,
  width    : "65%",
  height   : "90%",
  'afterClose':function () {
  window.location.reload();
  },
});
});
</script>

<script type="text/javascript">
$(document).ready(function(){
    $('#id_cat_expertise').on('change',function(){
        var id_cat_expertise = $(this).val();
        if(id_cat_expertise){
            $.ajax({
                type:'POST',
                url:'deroul_expertises.php',
                data:'id_cat_expertise='+id_cat_expertise,
                success:function(html){
                    $('#id_expertise').html(html);
                }
            }); 
        }else{
            $('#id_expertise').html('<option value="">Select category</option>');
        }
    });
});
</script>


<!--  Fancy Box libraries -->
<script type="text/javascript" src="assets/bootstrap/336/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/fancybox/jquery.fancybox.js?v=2.1.5"></script>
<script src="assets/js/alerts/alertify.min.js"></script>

<!-- JAVASCRIPT libraries -->
<script type="text/javascript" src="assets/js/gmap3.min.js"></script>
<script type="text/javascript" src="assets/js/smoothscroll.js"></script>
<script type="text/javascript" src="assets/js/submenu-fix.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
</body>
</html>