<?php
// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

// Including functions
require_once('admin/assets/include/functions.php');

//Including Variables
require_once('admin/assets/include/variables.php');

$total = count_recentjoboffers($_SESSION[$filename]['search_query']);

// Label and number of Jobs
$title_total_results=$total.' Jobs Available';

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
                    <?php $exp=$dbj->query('SELECT * FROM category_expertises WHERE active=1 ORDER BY id_cat_expertise');
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

    <?php $jobs=$dbj->query('SELECT DISTINCT job_offers.id_job, job_offers.job_sn, job_offers.job_title,  job_offers.publish_date, companies.active, companies.company_name, companies.company_sn, levels_experience.id_level_experience, levels_experience.'.$_SESSION['jbms_front']['lang_code'].'_level_experience AS level_experience, levels_experience.years_experience, levels_education.id_level_education, levels_education.'.$_SESSION['jbms_front']['lang_code'].'_level_education AS level_education, job_type.'.$_SESSION['jbms_front']['lang_code'].'_description AS description, job_offers.job_description, job_offers.closing_date, salary_ranges.salary_range, expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_area AS expertise_area, category_expertises.id_cat_expertise , category_expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_category AS expertise_category FROM job_offers LEFT JOIN job_type ON job_offers.job_type=job_type.id_job_type LEFT JOIN companies ON job_offers.id_company=companies.id_company LEFT JOIN salary_ranges ON job_offers.id_salary=salary_ranges.id_salary LEFT JOIN users AS employer ON (companies.id_employer=employer.id_user) LEFT JOIN expertises ON job_offers.id_expertise=expertises.id_expertise LEFT JOIN category_expertises ON expertises.id_category=category_expertises.id_cat_expertise LEFT JOIN levels_experience ON job_offers.id_level_experience=levels_experience.id_level_experience LEFT JOIN levels_education ON job_offers.id_level_education=levels_education.id_level_education WHERE companies.active="1" '.$_SESSION[$filename]['search_query'].' ORDER BY job_offers.id_job DESC LIMIT '.$start.', '.$_SESSION['epp'].'');   
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
      <td><?php echo $row_jobs['expertise_category'];?><br /> <?php echo $row_jobs['expertise_area'];?></td>
      <td><?php echo $row_jobs['job_title'];?></td>
      <td><?php echo $row_jobs['level_experience'];?> <br/> <?php echo $row_jobs['years_experience'];?> <?php echo languages($_SESSION['jbms_front']['lang_code'],55);//Years?></td>
      <td><?php echo date('d-m-Y',strtotime($row_jobs['publish_date']));?></td>
      <td>
        <div class="form-group col-md-2 text-center">
        <!-- Group buttons -->
        <a class="dropdown-toggle btn btn-sm btn-success" data-toggle="dropdown" href="#"> <?php echo languages($_SESSION['jbms_front']['lang_code'],56);//Options?><i class="fa fa-arrow-down fa-1x"></i></a>

        <ul class="dropdown-menu" role="menu">
          <?php if(!empty($_SESSION['jbms_front']['admin_level']) && $_SESSION['jbms_front']['admin_level']==3){ ?>
          <li><a href="view_job.php?id_job=<?php echo $row_jobs['id_job'];?>"><i class="fa fa-file fa-1x"></i> <?php echo languages($_SESSION['jbms_front']['lang_code'],57);//View?></a></li>
          <?php if($savedjobs->rowCount()>0){ ?>
          <li><a href="javascript:confirm_revoke('<?php echo $row_jobs['id_job'];?>','<?php echo $row_jobs['job_title'];?>','<?php echo $module;?>')"><i class="fa fa-reply-all fa-1x"></i> <?php echo languages($_SESSION['jbms_front']['lang_code'],59);//Revoke Saved Job?></a></li>
        <?php }else{ ?>
          <li><a href="javascript:confirm_save('<?php echo $row_jobs['id_job'];?>','<?php echo $row_jobs['job_title'];?>','<?php echo $module;?>')"><i class="fa fa-reply-all fa-1x"></i> <?php echo languages($_SESSION['jbms_front']['lang_code'],58);//Save Job?></a></li>
        <?php }}else{?>
        <li><a href="sign.php"><i class="fa fa-sign-in"></i> <?php echo languages($_SESSION['jbms_front']['lang_code'],57);//View?></a></li>
        <?php } ?>
        </ul>
        </div>
      </td>
    </tr>
    <?php } }else{ ?>
    <!-- If no results -->
    <tr>
      <td colspan="6">
        <fieldset class="padding30 text-center"><?php echo languages($_SESSION['jbms_front']['lang_code'],60);//No data found?></fieldset>
      </td>
    </tr>

    <?php } ?>

    <?php if ($nbPages>1) { ?>
    <tr>
      <td colspan="6">
        <div class="pagination">
          <?php echo paginate($module, '?p=', $nbPages, $current, ''); ?>
        </div>
      </td>
    </tr>
    <?php echo '</tbody>';?>

    <?php } ?>
  </table>
</div>
</div>
</section>
  <!-- Including Footer file -->
  <?php require_once('admin/footer.php');?>
<script type="text/javascript">
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