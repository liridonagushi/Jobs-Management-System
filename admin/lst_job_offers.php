<?php
// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

// Including functions
require_once('assets/include/functions.php');

//Including Variables
require_once('assets/include/variables.php');

// Function to check logged in user
login_twoadmin();

// Calculate job offers
$total = count_joboffers($_SESSION[$filename]['search_query']);

// Companies
$companies=$dbj->query('SELECT * FROM companies WHERE id_employer="'.$_SESSION['jbms_back']['id_user'].'"');

// Label and number of users
$title_total_results=$total.' Offers';

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
  <?php if($companies->rowCount()==0){ 
echo '<script type="text/javascript">
      function myFunction() {
      alert("You must insert a company first !");
      }
      </script>
      ';
      echo ' <a onclick="myFunction()" class="btn btn-dark">Insert a Job Offer <i class="fa fa-plus-square fa-1x"></i> </a>';
     }else{ ?>
    
         <a class="fancybox fancybox.iframe btn btn-dark" href="ins_job_offer.php">Insert a Job Offer <i class="fa fa-plus-square fa-1x"></i></a>
        <?php if(count_joboffers('')==0){  ?><img src="assets/images/arrow-left.gif" height="30" /><?php } ?>
      <?php } ?>
</section>

<!-- Search -->
<div class="container">
  <div class="row ">
    <div class="col-md-12 text-center">
      <h4 class="padding10"><b><i class="fa fa-file-o"></i> Job Offers</b></h4>
      <hr class="divider-menu">
    </div>
  </div>
</div>

<section id="adminheader">
  <div class="container">
    <form name="name" method="post" action="post_search_offres.php">
    <input type="hidden" name="filename" value="<?php echo $filename;?>">
      <div class="form-group col-lg-3">
        <input type="text" name="search_comp"  value="<?php echo $_SESSION[$filename]['search_comp']; ?>" class="form-control" placeholder="Job Title, SN">
      </div>

      <div class="form-group col-lg-3 text-left">
        <select id="id_cat_expertise" name="id_cat_expertise" class="form-control">
        <option value="">Choose</option>
        <?php $exp=$dbj->query('SELECT * FROM category_expertises');
        while($row_exp=$exp->fetch(PDO::FETCH_ASSOC)){
        ?>
        <option value="<?php echo $row_exp['id_cat_expertise'];?>" <?php if($row_exp['id_cat_expertise']==$_SESSION[$filename]['id_cat_expertise']){ ?> selected <?php } ?>><?php echo $row_exp[''.$_SESSION['jbms_front']['lang_code'].'_expertise_category'];?></option>
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

<!-- Module showing results -->
<section id="module" class="bg-gray">
  <h5 class="padding30"><b><?php echo $title_total_results;?></b></h5>
  <div class="container-custom-grid">
   <div class="row">
    <div class="col-md-12">

    <?php $comp=$dbj->query('SELECT DISTINCT job_offers.id_job, job_offers.job_sn, users.id_user, job_offers.id_expertise, companies.company_name, job_offers.job_title, job_offers.job_description, job_offers.publish_date, job_offers.closing_date, category_expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_category AS expertise_category, category_expertises.id_cat_expertise, expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_area AS expertise_area, levels_experience.'.$_SESSION['jbms_front']['lang_code'].'_level_experience AS level_experience, levels_experience.years_experience, levels_education.'.$_SESSION['jbms_front']['lang_code'].'_level_education AS level_education FROM job_offers LEFT JOIN expertises ON job_offers.id_expertise=expertises.id_expertise LEFT JOIN category_expertises ON expertises.id_category=category_expertises.id_cat_expertise LEFT JOIN companies ON job_offers.id_company=companies.id_company JOIN users ON companies.id_employer=users.id_user LEFT JOIN levels_education ON job_offers.id_level_education=levels_education.id_level_education LEFT JOIN levels_experience ON job_offers.id_level_experience=levels_experience.id_level_experience WHERE users.id_user="'.$_SESSION['jbms_back']['id_user'].'" '.$_SESSION[$filename]['search_query'].' GROUP BY job_offers.id_job '.$_SESSION[$filename]['orderby'].' LIMIT '.$start.', '.$_SESSION['epp'].'');
    ?>
    <script type="text/javascript">
    function confirm_delete(id_job, job_title){
      if(confirm('You are removing the job offer '+job_title+' ?')){
         window.location.href='post_del_offer.php?id_job='+id_job+'&job_title='+job_title+'';
       }
      }
    </script>

    <!-- MODULE rows -->
    <?php
         if($comp->rowCount()>0){
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

       <div class="col-md-2 text-center">
       <div class="button-group">
          <!-- Group buttons -->
          <a class="btn-optionsmenu button-dropdown" href="#" data-toggle="dropdown">Options <i class="fa fa-arrow-down fa-1x"></i></a>
              <?php $count=$dbj->query('SELECT id_job FROM job_candidatures WHERE id_job="'.$row_comp['id_job'].'"'); 
                    $countcand=$count->rowCount();
              ?>
           <ul class="dropdown-menu optionsmenu" role="menu">
              <li><a href="post_link.php?id_job=<?php echo $row_comp['id_job'];?>&destination=candidates"><i class="fa fa-group fa-1x"></i> Candidates <span class="badge"> <?php echo $countcand;?></span></a></li>
              <li><a class="fancybox fancybox.iframe" href="upd_job_offer.php?id_job=<?php echo $row_comp['id_job'];?>"><i class="fa fa-edit fa-1x"></i> Update Job</a></li>
              <li><a href="javascript:confirm_delete('<?php echo $row_comp['id_job'];?>','<?php echo $row_comp['job_title'];?>')"><i class="fa fa-remove fa-1x"></i> Remove</a></li>
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

<!-- Including Footer file -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>