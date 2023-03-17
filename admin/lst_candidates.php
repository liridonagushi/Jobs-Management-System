<?php
// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

// Including functions
require_once('assets/include/functions.php');

// Function to check logged in user
login_twoadmin();

//Including Variables
require_once('assets/include/variables.php');

$id_job='';

if($_SESSION['jbms_back']['id_job']){ $id_job=' AND job_offers.id_job="'.$_SESSION['jbms_back']['id_job'].'"';}else{$id_job='';}

$total = count_all_candidates($_SESSION[$filename]['search_query'], $id_job);

// Label and number of users
$title_total_results=$total.' Candidates';

// Including pagination elements through the file construct_paination.php
include('construct_pagination.php');

// Including header content
require_once('assets/css_header.php');
$accrand=rand(999, 9999999);
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
      <h4 class="margintop40px"><b><i class="fa fa-file-o"></i> Candidatures</b></h4>
      <hr class="divider-menu">
    </div>
  </div>
</div>

<section id="adminheader">
  <div class="container">
    <form name="name" method="post" action="post_search_candidates.php">
    <input type="hidden" name="filename" value="<?php echo $filename;?>">
    <input type="hidden" name="link" value="<?php echo $module;?>">

      <div class="form-group col-md-4">
        <input type="text" name="emp_name"  value="<?php echo $_SESSION[$filename]['emp_name']; ?>" class="form-control" placeholder="Search Employee">
      </div>

      <?php if(empty($_SESSION['jbms_back']['id_job'])){ ?>
      <div class="form-group col-md-2">
        <select id="id_company" name="id_company" class="form-control">
        <option value="">Select Company</option>
        <?php $comp=$dbj->query('SELECT * FROM companies WHERE active="1" AND id_employer="'.$_SESSION['jbms_back']['id_user'].'"');
        while($row_comp=$comp->fetch(PDO::FETCH_ASSOC)){
        ?>
        <option value="<?php echo $row_comp['id_company'];?>" <?php if($row_comp['id_company']==$_SESSION[$filename]['id_company']){ ?> selected <?php } ?>><?php echo $row_comp['company_name'];?></option>
        <?php } ?>
        </select>
      </div>

      <div class="form-group col-md-2">
      <?php if(!empty($_SESSION[$filename]['id_company'])){?>
        <select id="id_job" name="id_job" class="form-control">
        <option value="">Select job offer</option>
        <?php $offer=$dbj->query('SELECT DISTINCT job_offers.id_job, job_offers.job_title, companies.id_company FROM job_offers LEFT JOIN companies ON companies.id_company=job_offers.id_company WHERE companies.active="1" AND companies.id_employer="'.$_SESSION['jbms_back']['id_user'].'" AND companies.id_company="'.$_SESSION[$filename]['id_company'].'"');
          while($row_offer=$offer->fetch(PDO::FETCH_ASSOC)){
        ?>
        <option value="<?php echo $row_offer['id_job'];?>" <?php if($row_offer['id_job']==$_SESSION[$filename]['id_job']){ ?> selected <?php } ?>><?php echo $row_offer['job_title'];?></option>
        <?php } ?>
        </select>
        <?php }else{ ?>
         <select id="id_job" name="id_job" class="form-control">
          <option value="">Choose company</option>
        </select>
        <?php } ?>
      </div>
    <?php } ?>

      <div class="form-group col-md-2">
        <input type="submit" name="name" class="form-control btn-default" value="SEARCH">
      </div>

      <div class="form-group col-md-2">
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
  <?php
    $job_cand=$dbj->query('SELECT DISTINCT job_candidatures.id_candidature, job_candidatures.motivation_words, job_offers.id_job, job_offers.job_sn, job_candidatures.id_employee AS id_user, users.profile_img, users.name, users.surname, users.birthday, users.email, users.phone_number, job_offers.job_title, job_offers.job_description, adresses.adress, adresses.city, adresses.postal_code, countries.country_code, countries.country_name, cv_lm.cv_code, cv_lm.lm_code, job_candidatures.time_application FROM job_candidatures LEFT JOIN job_offers ON job_candidatures.id_job=job_offers.id_job LEFT JOIN users ON job_candidatures.id_employee=users.id_user LEFT JOIN companies ON job_candidatures.id_company=companies.id_company LEFT JOIN cv_lm ON users.id_user=cv_lm.id_user LEFT JOIN adresses ON users.id_adress=adresses.id_adress LEFT JOIN countries ON adresses.id_country=countries.id_country WHERE companies.id_employer="'.$_SESSION['jbms_back']['id_user'].'" '.$id_job.' '.$_SESSION[$filename]['search_query'].' '.$_SESSION[$filename]['orderby'].' LIMIT '.$start.', '.$_SESSION['epp'].'');
     if($job_cand->rowCount()>0){
          while($row_cand=$job_cand->fetch(PDO::FETCH_ASSOC)){
     ?>

    <div class="wizard-card row border padding30">
      <div class="form-group col-md-2">
       <h7>
        <fieldset>
        <i class="fa fa-user fa-1x"></i> <?php echo $row_cand['surname'];?> <?php echo $row_cand['name'];?>
        </fieldset>
        <fieldset>
         JOB SN # <?php echo $row_cand['id_job'];?>
        </fieldset>
        </h7>

        <fieldset>
          <div class="image-upload">
            <label for="file-input">
              <?php if(!empty($row_cand['profile_img'])){ ?>
              <img src="<?php echo $_SESSION['jbms_back']['directory_profile_img'].$row_cand['profile_img'];?>" alt="client">
              <?php }else{ ?>
              <img src="<?php echo $_SESSION['jbms_back']['directory_profile_img'];?>no_photo.jpg" class="borderstyle" width="80" alt="client">
              <?php } ?>
            </label>
          </div>
        </fieldset>

         <h4 class="iconbox-header">Joints <i class="fa fa-file-pdf-o fa-1x"></i></h4>
         <fieldset>
          <a href="<?php echo $_SESSION['jbms_back']['directory_pdf'];?><?php echo $row_cand['cv_code'];?>" target="new">CV - <?php echo $row_cand['cv_code'];?></a>
        </fieldset>
        <fieldset>
          <a href="<?php echo $_SESSION['jbms_back']['directory_pdf'];?><?php echo $row_cand['cv_code'];?>" target="new">LM - <?php echo $row_cand['lm_code'];?></a>
        </fieldset>
        <fieldset>
         <i class="fa fa-clock-o fa-1x"></i> <?php echo timetodate($row_cand['time_application']).' at '.date('h.i A',strtotime($row_cand['time_application']));?>
        </fieldset>
        <fieldset><a href="#" data-toggle="tooltip" data-placement="right" data-html="true" title="<?php echo  $row_cand['motivation_words'];?>"> <i class="fa fa-external-link"></i> <?php echo $row_cand['job_title'];?></a>
        </fieldset>
      </div>

      <div class="form-group col-md-3">
        <?php $diploma=$dbj->query('SELECT DISTINCT diploma_users.id_diploma_user, diploma_users.title_diploma, levels_education.'.$_SESSION['jbms_front']['lang_code'].'_level_education AS level_education, diploma_types.'.$_SESSION['jbms_front']['lang_code'].'_type_diploma AS type_diploma, diploma_users.date_started, diploma_users.date_finished, diploma_users.on_load FROM diploma_users LEFT JOIN users ON diploma_users.id_user=users.id_user LEFT JOIN diploma_types ON diploma_users.id_type_diploma=diploma_types.id_type_diploma LEFT JOIN levels_education ON diploma_users.id_level_education=levels_education.id_level_education WHERE diploma_users.id_user="'.$row_cand['id_user'].'" ORDER BY diploma_users.id_diploma_user DESC LIMIT 10');
          $autonumber=rand(111,20000);
        ?>
        <div id="accordion<?php echo $autonumber;?>" class="panel-group">
        <?php
        $max_diploma=$diploma->rowCount();
        for ($i = 1; $i <= $max_diploma; $i++) {
        while($diploma_user=$diploma->fetch(PDO::FETCH_ASSOC)){
        
        if($i!=$max_diploma){$classcollapsed='class="collapsed"';}else{$classcollapsed='';}
        if($i==$max_diploma){$collapse_edu='in';}else{$collapse_edu='';}
        $rand_edu=rand(111,999);
        $title='<i class="fa fa-graduation-cap fa-1x"></i> Diploma '.getRomanNumerals($i++).'';
        ?>
            <!-- ACCORDIONS -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion<?php echo $autonumber;?>" href="#<?php echo $rand_edu;?>" <?php echo $classcollapsed;?>><?php echo $title;?></a></h4>
                </div>
                <div id="<?php echo $rand_edu;?>" class="panel-collapse collapse <?php echo $collapse_edu;?>">
                  <div class="panel-body">
                      <?php if($diploma_user['title_diploma']){
                         echo '<fieldset>';
                         echo '<b>Title Diploma</b>: ';
                         echo  $diploma_user['title_diploma'];
                         echo '</fieldset>';

                        }if($diploma_user['level_education']){
                         echo '<fieldset>';
                         echo '<b>Education Level</b>: ';
                         echo  $diploma_user['level_education'];
                         echo '</fieldset>';

                        }if($diploma_user['type_diploma']){
                         echo '<fieldset>';
                         echo '<b>Type Diploma</b>: ';
                         echo  $diploma_user['type_diploma'];
                         echo '</fieldset>';

                        }if($diploma_user['date_started']){
                         echo '<fieldset>';
                         echo '<b>Date Started</b>: ';
                         echo date('d-m-Y',strtotime($diploma_user['date_started']));
                         echo '</fieldset>';


                        }if($diploma_user['date_finished']){
                         echo '<fieldset>';
                         echo '<b>Date Completed</b>: ';
                         echo date('d-m-Y',strtotime($diploma_user['date_finished']));
                         echo '</fieldset>';

                        }if($diploma_user['on_load']){
                         echo '<fieldset>';
                         echo '<h4><span class="label label-warning">Attending !</span></h4>';
                         echo '</fieldset>';
                         }
                     echo '<br/>'; ?>
                  </div>
                </div>
              </div>
          <?php }} ?>
           </div>
          </div>

      <div class="form-group col-md-3">
        
        <?php $portfolio=$dbj->query('SELECT working_experiences.id_experience, working_experiences.id_user, working_experiences.start_date, working_experiences.end_date, working_experiences.on_load, working_experiences.description , category_expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_category AS expertise_category, expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_area AS expertise_area FROM working_experiences LEFT JOIN expertises ON working_experiences.id_expertise=expertises.id_expertise LEFT JOIN category_expertises ON expertises.id_category=category_expertises.id_cat_expertise WHERE working_experiences.id_user="'.$row_cand['id_user'].'" ORDER BY working_experiences.id_experience DESC LIMIT 10'); 
          $autonumber=rand(111,999);
        ?>
        <div id="accordion<?php echo $autonumber;?>" class="panel-group">
        <?php
        $max_portfolio=$portfolio->rowCount();
        for ($i = 1; $i <= $max_portfolio; $i++) {
        while($row_portfolio=$portfolio->fetch(PDO::FETCH_ASSOC)){
        if($i!=$max_portfolio){$classcollapsed='class="collapsed"';}else{$classcollapsed='';}
        if($i==$max_portfolio){$collapse='in';}else{$collapse='';}
        $rand_exp=rand(10000,9999990);

        $title='<i class="fa fa-tasks fa-1x"></i> Experience '.getRomanNumerals($i++).'';
        ?>
            <!-- ACCORDIONS -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion<?php echo $autonumber;?>" href="#<?php echo $rand_exp;?>" <?php echo $classcollapsed;?>><?php echo $title;?></a></h4>
                </div>
                <div id="<?php echo $rand_exp;?>" class="panel-collapse collapse <?php echo $collapse;?>">
                  <div class="panel-body">

                      <?php if($row_portfolio['expertise_category']){
                         echo '<fieldset>';
                         echo '<b>Title Diploma</b>: ';
                         echo  $row_portfolio['expertise_category'];
                         echo '</fieldset>';

                        }if($row_portfolio['expertise_area']){
                         echo '<fieldset>';
                         echo '<b>Education Level</b>: ';
                         echo  $row_portfolio['expertise_area'];
                         echo '</fieldset>';

                        }if($row_portfolio['start_date']){
                         echo '<fieldset>';
                         echo '<b>Date Started</b>: ';
                         echo date('d-m-Y',strtotime($row_portfolio['start_date']));
                         echo '</fieldset>';

                         }if($row_portfolio['end_date']){
                         echo '<fieldset>';
                         echo '<b>Date Depart</b>: ';
                         echo date('d-m-Y',strtotime($row_portfolio['end_date']));
                         echo '</fieldset>';

                        }if($row_portfolio['on_load']){
                         echo '<fieldset>';
                         echo '<h4><span class="label label-warning">Attending !</span></h4>';
                         echo '</fieldset>';
                        }

                     echo '<br/>'; ?>
                  </div>
                </div>
              </div>
          <?php }} ?>
           </div>
        </div>

      <div class="form-group col-md-2">
        <h4 class="iconbox-header"><i class="fa fa-street-view fa-1x"></i> Contact</h4>
        <fieldset>
        <i class="fa fa-phone fa-1x"></i> <?php echo $row_cand['phone_number'];?>
        </fieldset>

        <fieldset>
        <i class="fa fa-map-marker fa-1x"></i>
        <?php echo $row_cand['country_code'];?>
        <?php echo $row_cand['country_name'];?>
        </fieldset>

        <fieldset>
        <?php echo $row_cand['city'];?>
        <?php echo $row_cand['postal_code'];?>
        <?php echo $row_cand['adress'];?>
        </fieldset>
      </div>

      <script type="text/javascript">
      function confirm_insert(id_user, id_job, name, surname, link){
        if(confirm('You are adding '+name+' '+surname+' to your favourite candidates ?')){
           window.location.href='post_process_favourites.php?id_user='+id_user+'&id_job='+id_job+'&name='+name+'&surname='+surname+'&target=insert&link='+link+'';
       }
      }

      function confirm_remove(id_user, id_job, name, surname, link){
        if(confirm('You are removing '+name+' '+surname+' from your favourite candidates ?')){
           window.location.href='post_process_favourites.php?id_user='+id_user+'&id_job='+id_job+'&name='+name+'&surname='+surname+'&target=remove&link='+link+'';
       }
      }
      </script>
      <?php $fav=$dbj->query('SELECT * FROM profile_favourites WHERE id_employee="'.$row_cand['id_user'].'" AND id_employer="'.$_SESSION['jbms_back']['id_user'].'"'); ?>

       <div class="col-md-2 text-center">
       <div class="button-group">
        <!-- Group buttons -->
         <a class="btn-optionsmenu button-dropdown" href="#" data-toggle="dropdown">Options <i class="fa fa-arrow-down fa-1x"></i></a>
          <ul class="dropdown-menu optionsmenu" role="menu">
          <?php if($fav->rowCount()>0){ ?>
          <li><a href="javascript:confirm_remove('<?php echo $row_cand['id_user'];?>','<?php echo $row_cand['id_job'];?>','<?php echo $row_cand['name'];?>','<?php echo $row_cand['surname'];?>','<?php echo $module;?>')"><i class="fa fa-remove fa-1x"></i> Remove from Favourites</a></li>
          <?php }else{ ?>
          <li><a href="javascript:confirm_insert('<?php echo $row_cand['id_user'];?>','<?php echo $row_cand['id_job'];?>','<?php echo $row_cand['name'];?>','<?php echo $row_cand['surname'];?>','<?php echo $module;?>')"><i class="fa fa-reply fa-1x"></i> Add to Favourites</a></li>
          <?php
          }
          ?>
            <li><a class="fancybox fancybox.iframe" href="send_email.php?id_user=<?php echo $row_cand['id_user'];?>&job_sn=<?php echo $row_cand['job_sn'];?>"><i class="fa fa-envelope fa-1x"></i> Send en email</a></li>
          </ul>
      </div>
      </div>
    </div>

    <?php } }else{ ?>
      <div class="row border">
        <div class="form-group col-md-12 text-center">
        <fieldset class="padding30">No results found</fieldset>
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
    <!-- /section -->
<script type="text/javascript">
$(document).ready(function(){
    $('#id_company').on('change',function(){
        var id_company = $(this).val();
        if(id_company){
            $.ajax({
                type:'POST',
                url:'deroul_jobs.php',
                data:'id_company='+id_company,
                success:function(html){
                    $('#id_job').html(html);
                }
            }); 
        }else{
            $('#id_job').html('<option value="">Choose Company</option>');
        }
    });
});
</script>
<!-- Including JS Content -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>