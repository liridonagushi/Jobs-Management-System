<?php
// Including functions
require_once('admin/assets/include/functions.php');

// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('admin/assets/include/variables.php');

$total = saved_jobs($_SESSION[$filename]['search_query']);

// Label and number of Jobs
$title_total_jobs=$total.' Jobs Available';

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
                    <option value="<?php echo $row_exp['id_cat_expertise'];?>" <?php if($row_exp['id_cat_expertise']==$_SESSION[$filename]['id_category']){ ?> selected="selected" <?php } ?>><?php echo $row_exp['expertise_category'];?></option>
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
    <div class="col-lg-12">
      <h4><?php echo $title_total_jobs;?></h4>
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

    <?php $jobs=$dbj->query('SELECT saved_jobs.id_saved_job, job_offers.id_job, job_offers.job_sn, users.name, users.surname, users.email, job_offers.job_title, companies.company_name, companies.company_sn,  job_offers.job_description, job_offers.publish_date, job_offers.closing_date, salary_ranges.salary_range, levels_experience.'.$_SESSION['jbms_front']['lang_code'].'_level_experience AS level_experience, levels_experience.years_experience, levels_education.'.$_SESSION['jbms_front']['lang_code'].'_level_education AS level_education, expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_area AS expertise_area, category_expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_category AS expertise_category FROM job_offers LEFT JOIN expertises ON job_offers.id_expertise=expertises.id_expertise LEFT JOIN category_expertises ON expertises.id_category=category_expertises.id_cat_expertise LEFT JOIN levels_education ON job_offers.id_level_experience=levels_education.id_level_education LEFT JOIN levels_experience ON job_offers.id_level_experience=levels_experience.id_level_experience LEFT JOIN companies ON job_offers.id_company=companies.id_company LEFT JOIN users ON companies.id_employer=users.id_user LEFT JOIN salary_ranges ON job_offers.id_salary=salary_ranges.id_salary LEFT JOIN saved_jobs ON job_offers.id_job=saved_jobs.id_job WHERE saved_jobs.id_employee="'.$_SESSION['jbms_front']['id_user'].'" '.$_SESSION['lst_saved_jobs']['search_query'].' '.$_SESSION['lst_saved_jobs']['orderby'].' LIMIT '.$start.', '.$_SESSION['epp'].'');
    ?>

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
    $savedjobs=$dbj->query('SELECT id_job, id_employee FROM saved_jobs WHERE id_job="'.$row_jobs['id_job'].'" AND id_employee="'.$_SESSION['jbms_front']['id_user'].'"');
    ?>
    <tr class="td-inverse">
      <td> <?php echo $row_jobs['job_sn'];?></td>
      <td><?php echo $row_jobs['job_title'];?></td>
      <td><?php echo $row_jobs['expertise_category'];?> <?php echo $row_jobs['expertise_area'];?></td>
      <td><?php echo $row_jobs['level_experience'];?> <br/> <?php echo $row_jobs['years_experience'];?> Years</td>
      <td><?php echo date('d-m-Y',strtotime($row_jobs['publish_date']));?></td>
      <td>
        <div class="form-group col-lg-2 text-center">
        <!-- Group buttons -->
        <a class="dropdown-toggle btn btn-sm btn-success" data-toggle="dropdown" href="#">Options <i class="fa fa-arrow-down fa-1x"></i></a>

        <ul class="dropdown-menu" role="menu">

          <li><a href="view_job.php?id_job=<?php echo $row_jobs['id_job'];?>"><i class="fa fa-file fa-1x"></i> View</a></li>
          <li><a href="javascript:confirm_revoke('<?php echo $row_jobs['id_job'];?>','<?php echo $row_jobs['job_title'];?>','<?php echo $module;?>')"><i class="fa fa-reply-all fa-1x"></i> Revoke Saved Job</a></li>
       
        </ul>
        </div>
      </td>
    </tr>
    <?php } }else{ ?>

    <tr>
      <td colspan="6">
        <fieldset class="padding30 text-center">No Saved Jobs Yet</fieldset>
      </td>
    </tr>

    <?php } ?>

    <?php if ($nbPages>1) { ?>
    <tr>
    <td colspan="6">
    <div class="pagination">
    <?php echo paginate($module, '?p=', $nbPages, $current, '#module'); ?>
    </div>
    </td>
    </tr>
    <?php echo '</tbody>';?>

    <?php } ?>
  </table>
</div>
</div>
</section>

<!-- Including Footer -->
<?php require_once('admin/footer.php');?>

<!-- JS library and scripts-->


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