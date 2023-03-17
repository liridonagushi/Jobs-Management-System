<?php
// Including functions
require_once('admin/assets/include/functions.php');

// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('admin/assets/include/variables.php');

$total = count_my_candidatures($_SESSION[$filename]['search_query']);

// Label and number of Jobs
$title_total_results=$total.' Applied Jobs';

// Including pagination elements through the file construct_paination.php
include('admin/construct_pagination.php');

// Including header content
require_once('admin/assets/css_header_front.php');
?>

<body>
<?php echo include('top_menu.php');?>
<!-- Module showing results -->

<!-- Module Search -->
<section id="headerbuttons">
      <div class="row">
        <form name="search" action="post_search_results.php" method="POST">
        <input type="hidden" name="filename" value="<?php echo $filename;?>">
        <input type="hidden" name="module" value="<?php echo $module;?>">
            <div class="col-md-3">
              <input type="text" name="job_title" value="<?php echo $_SESSION[$filename]['job_title'];?>" class="form-control" placeholder="Job Title">
            </div>

            <div class="col-md-3">
                <select id="id_category" name="id_category" class="form-control">
                   <option value=""><?php echo languages($_SESSION['jbms_front']['lang_code'],34); //All?></option>
                    <?php $exp=$dbj->query('SELECT * FROM category_expertises WHERE active=1');
                    while($row_exp=$exp->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <option value="<?php echo $row_exp['id_cat_expertise'];?>" <?php if($row_exp['id_cat_expertise']==$_SESSION[$filename]['id_category']){ ?> selected="selected" <?php } ?>><?php echo $row_exp[''.$_SESSION['jbms_front']['lang_code'].'_expertise_category'];?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-3">
                <input type="submit" name="name" class="form-control btn-default" value="SEARCH">
            </div>
            <div class="col-md-3">
                <input type="submit" name="reset" class="form-control btn-default" value="RESET">
            </div>
        </form>
  </div>
</section>

<section id="searchresults">
  <div class="row">
    <div class="col-md-12">
      <h4><?php echo $title_total_results;?></h4>
      <div class="divider"></div>
    </div>
  </div>

<div class="container">
  <div class="row">
  <table class="table table-inverse">
    <thead class="thead-inverse">
      <tr class="active">
        <th width="150px">
        <?php echo languages($_SESSION['jbms_front']['lang_code'],39);//Job SN?>
        </th>
        <th width="150px">
        <?php echo languages($_SESSION['jbms_front']['lang_code'],10);//Job Title?>
        </th>
        <th width="150px">
        <?php echo languages($_SESSION['jbms_front']['lang_code'],48);//Expertise?>
        </th>
        <th width="150px">
        <?php echo languages($_SESSION['jbms_front']['lang_code'],43);//Experience Years?>
        </th>
        <th width="150px">
         <?php echo languages($_SESSION['jbms_front']['lang_code'],49);//Publish Date?>
        </th>
        <th width="150px">
        </th>
      </tr>
    </thead>

    <?php
    $jobs=$dbj->query('SELECT DISTINCT job_candidatures.id_candidature, job_offers.id_job, job_offers.job_sn, job_offers.job_title, companies.company_name, companies.company_sn, job_type.'.$_SESSION['jbms_front']['lang_code'].'_description, job_offers.job_description, job_offers.publish_date, job_offers.closing_date, salary_ranges.salary_range, levels_experience.'.$_SESSION['jbms_front']['lang_code'].'_level_experience, levels_experience.years_experience, levels_education.'.$_SESSION['jbms_front']['lang_code'].'_level_education AS level_education, expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_area, category_expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_category AS expertise_category FROM job_offers LEFT JOIN job_type ON job_offers.job_type=job_type.id_job_type INNER JOIN companies ON job_offers.id_company=companies.id_company LEFT JOIN levels_experience ON job_offers.id_level_experience=levels_experience.id_level_experience INNER JOIN levels_education ON job_offers.id_level_education=levels_education.id_level_education INNER JOIN salary_ranges ON job_offers.id_salary=salary_ranges.id_salary INNER JOIN job_candidatures ON job_offers.id_job=job_candidatures.id_job LEFT JOIN users AS employer ON (companies.id_employer=employer.id_user AND employer.admin_level="2") LEFT JOIN users AS employees ON (job_candidatures.id_employee=employees.id_user) INNER JOIN expertises ON job_offers.id_expertise=expertises.id_expertise INNER JOIN category_expertises ON expertises.id_category=category_expertises.id_cat_expertise WHERE job_candidatures.id_employee="'.$_SESSION['jbms_front']['id_user'].'" '.$_SESSION[$filename]['search_query'].' '.$_SESSION[$filename]['orderby'].' LIMIT '.$start.', '.$_SESSION['epp'].'');
    ?>

    <script type="text/javascript">
    function confirm_save(id_job, job_title, link){
      if(confirm('You are saving '+job_title+' job to your saved jobs ?')){
      window.location.href='post_upd_savejob.php?id_job='+id_job+'&link='+link+'';
     }
    }
    </script>

    <script type="text/javascript">
    function confirm_revoke(id_job, job_title, link){
       if(confirm('You are revoking '+job_title+' job from your saved jobs !')){
      window.location.href='post_upd_savejob.php?id_job='+id_job+'&link='+link+'';
     }
    }
    </script>

    <!-- MODULE rows -->
    <?php if($jobs->rowCount()>0){
    echo'<tbody>';
    while($row_jobs=$jobs->fetch(PDO::FETCH_ASSOC)){
    $savedjobs=$dbj->query('SELECT id_job FROM saved_jobs WHERE id_job="'.$row_jobs['id_job'].'" AND id_employee="'.$_SESSION['jbms_front']['id_user'].'"');
    ?>
    <tr class="td-inverse">
      <td> <?php echo $row_jobs['job_sn'];?></td>
      <td><?php echo $row_jobs['job_title'];?></td>
      <td><?php echo $row_jobs['expertise_category'];?> <?php echo $row_jobs[''.$_SESSION['jbms_front']['lang_code'].'_expertise_area'];?></td>
      <td><?php echo $row_jobs[''.$_SESSION['jbms_front']['lang_code'].'_level_experience'];?> <br/> <?php echo $row_jobs['years_experience'];?> Years</td>
      <td><?php echo date('d-m-Y',strtotime($row_jobs['publish_date']));?></td>
      <td>
        <div class="form-group col-lg-2 text-center">
        <!-- Group buttons -->
        <a class="dropdown-toggle btn btn-sm btn-success" data-toggle="dropdown" href="#">Options <i class="fa fa-arrow-down fa-1x"></i></a>

        <ul class="dropdown-menu" role="menu">

          <li><a href="view_job.php?id_job=<?php echo $row_jobs['id_job'];?>"><i class="fa fa-file fa-1x"></i> View</a></li>
          <?php if($savedjobs->rowCount()>0){ ?>
          <li><a href="javascript:confirm_revoke('<?php echo $row_jobs['id_job'];?>','<?php echo $row_jobs['job_title'];?>','<?php echo $module;?>')"><i class="fa fa-reply-all fa-1x"></i> Revoke Saved Job</a></li>
        <?php }else{ ?>
          <li><a href="javascript:confirm_save('<?php echo $row_jobs['id_job'];?>','<?php echo $row_jobs['job_title'];?>','<?php echo $module;?>')"><i class="fa fa-reply-all fa-1x"></i> Save Job</a></li>
        <?php } ?>
        </ul>
        </div>
      </td>
    </tr>
    <?php } }else{ ?>

    <tr>
      <td colspan="6">
        <fieldset class="padding30 text-center">No Candidatures Yet</fieldset>
      </td>
    </tr>

    <?php } ?>
    
    <?php if ($nbPages>1){ ?>
    <tr>
      <td colspan="6">
      <?php echo paginate($module, '?p=', $nbPages, $current, '#module'); ?>
      </td>
    </tr>
    <?php echo '</tbody>';?>

    <?php } ?>
  </table>
</div>
</div>
</section>
<!--Footer-->
<?php require_once('admin/footer.php');?>

<script>
    $().ready(function() {
        // validate signup form on keyup and submit
        $("#form-validation").validate({
            rules: {
                  email: {
                  required: true,
                  minlength: 5,
                  maxlength: 50,
                  email: true
                },
                  password: {
                  required: true,
                  minlength: 5,
                  maxlength: 50
                }
            },

            messages: {

                email: {
                    required: "Please enter an email adress",
                    minlength: "Email must be at least 5 characters long",
                    maxlength: "Please enter no more than 50 characters."
                },

                password: {
                    required: "Please enter a password",
                    minlength: "Password must be at least 5 characters long",
                    maxlength: "Please enter no more than 80 characters."
                }
            }
        });
    });
</script>

<!-- Including Footer file -->
<?php echo file_get_contents('admin/assets/js_bottom_front.php');?>
</body>
</html>