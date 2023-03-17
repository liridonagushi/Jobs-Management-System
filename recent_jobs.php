<?php
include('admin/assets/include/functions.php');
login_front();

$jobs=$dbj->query('SELECT job_offers.job_sn, users.name, users.surname, users.email, job_offers.job_title, companies.company_name, companies.company_sn, job_offers.job_description, job_offers.job_description, job_offers.start_date, job_offers.closing_date, salary_ranges.salary_range, levels_experience.'.$_SESSION['jbms_front']['lang_code'].'_level_experience, levels_experience.years_experience, levels_education.level_education, expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_area AS expertise_area, category_expertises.expertise_category FROM job_offers LEFT JOIN expertises ON job_offers.id_expertise=expertises.id_expertise LEFT JOIN category_expertises ON expertises.id_category=category_expertises.id_cat_expertise LEFT JOIN levels_education ON job_offers.id_level_experience=levels_education.id_level_education LEFT JOIN levels_experience ON job_offers.id_level_experience=levels_experience.id_level_experience LEFT JOIN companies ON job_offers.id_company=companies.id_company LEFT JOIN users ON companies.id_employer=users.id_user LEFT JOIN salary_ranges ON job_offers.id_salary=salary_ranges.id_salary AND users.id_user="'.$_SESSION['jbms_front']['id_user'].'"'.$_SESSION[$filename]['search_query'].' '.$_SESSION[$filename]['orderby'].'');

  $total = $jobs->rowCount();

// Label and number of users
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
    <form name="name" method="post" action="post_search_categories.php">

      <div class="form-group col-lg-3 text-left">
        <select id="id_cat_expertise" name="id_cat_expertise" class="form-control">
        <option value="">Categories</option>
        <?php $exp=$dbj->query('SELECT * FROM category_expertises');
        while($row_exp=$exp->fetch(PDO::FETCH_ASSOC)){
        ?>
        <option value="<?php echo $row_exp['id_cat_expertise'];?>" <?php if($row_exp['id_cat_expertise']==$_SESSION[$filename]['id_cat_expertise']){ ?> selected <?php } ?>><?php echo $row_exp['expertise_category'];?></option>

        <?php } ?>
        </select>
      </div>

      <div class="form-group col-lg-3">
        <input type="submit" name="name" class="form-control btn-default" value="FILTER">
      </div>

      <div class="form-group col-lg-3">
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
        Job Title
        </th>
        <th width="150px">
        Expertise
        </th>
        <th width="150px">
        Experience
        </th>
        <th width="150px">
        Starting Date
        </th>
        <th width="150px">
        </th>
      </tr>
    </thead>

    <?php $jobs=$dbj->query('SELECT job_offers.id_job, job_offers.job_sn, users.name, users.surname, users.email, job_offers.job_title, companies.company_name, companies.company_sn, job_offers.job_title, job_offers.job_description, job_offers.start_date, job_offers.closing_date, salary_ranges.salary_range, levels_experience.'.$_SESSION['jbms_front']['lang_code'].'_level_experience AS level_experience, levels_experience.years_experience, levels_education.'.$_SESSION['jbms_front']['lang_code'].'_level_education AS level_education, expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_area AS expertise_area, category_expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_category AS expertise_category FROM job_offers LEFT JOIN expertises ON job_offers.id_expertise=expertises.id_expertise LEFT JOIN category_expertises ON expertises.id_category=category_expertises.id_cat_expertise LEFT JOIN levels_education ON job_offers.id_level_experience=levels_education.id_level_education LEFT JOIN levels_experience ON job_offers.id_level_experience=levels_experience.id_level_experience LEFT JOIN companies ON job_offers.id_company=companies.id_company LEFT JOIN users ON companies.id_employer=users.id_user LEFT JOIN salary_ranges ON job_offers.id_salary=salary_ranges.id_salary AND users.id_user="'.$_SESSION['jbms_front']['id_user'].'" '.$_SESSION[$filename]['search_query'].' '.$_SESSION[$filename]['orderby'].' LIMIT '.$start.', '.$_SESSION['epp'].'');
    ?>

    <script type="text/javascript">
    function confirm_delete(id_cat_expertise, expertise_category){
    if(confirm('You are removing '+expertise_category+' ?')){
    window.location.href='post_del_category.php?id_cat_expertise='+id_cat_expertise+'&expertise_category='+expertise_category+'';
    }
    }
    </script>
    <!-- MODULE rows -->
    <?php if($jobs->rowCount()>0){
    echo'<tbody>';
    while($row_jobs=$jobs->fetch(PDO::FETCH_ASSOC)){ 
    
      ?>
      <script type="text/javascript">
     function confirm_insert(id_job, job_sn, job_title){
        if(confirm('You are saving '+job_title+' to your favourite jobs ?')){
           window.location.href='post_save_job.php?id_job='+id_job+'&job_sn='+job_sn+'';
       }
      }
       </script>
    <tr class="td-inverse">
      <td><?php echo $row_jobs['job_title'];?></td>
      <td><?php echo $row_jobs['expertise_category'];?> <?php echo $row_jobs['expertise_area'];?></td>
      <td><?php echo $row_jobs['level_experience'];?> <br/> <?php echo $row_jobs['years_experience'];?> Years</td>
      <td><?php echo $row_jobs['start_date'];?></td>
      <td>
        <div class="form-group col-lg-2 text-center">
        <!-- Group buttons -->
        <a class="dropdown-toggle btn btn-sm btn-success" data-toggle="dropdown" href="#">Options <i class="fa fa-arrow-down fa-1x"></i></a>

        <ul class="dropdown-menu" role="menu">

          <li><a href="view_job.php"><i class="fa fa-file fa-1x"></i> View</a></li>

          <li><a href="javascript:confirm_insert('<?php echo $row_jobs['id_job'];?>','<?php echo $row_jobs['job_sn'];?>','<?php echo $row_jobs['job_title'];?>')"><i class="fa fa-reply-all fa-1x"></i> Save Job</a></li>

        </ul>
        </div>
      </td>
    </tr>
    <?php } }else{ ?>

    <tr>
      <td colspan="6">
        <fieldset class="padding30">No data found</fieldset>
      </td>
    </tr>

    <?php } ?>

    <?php if ($nbPages>1) { ?>
    <tr>
    <td colspan="6">
    <div class="pagination">
    <?php echo paginate('recent_jobs.php', '?p=', $nbPages, $current); ?>
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
<!-- Alerts -->
<script type="text/javascript">
function reset () {
  $("#toggleCSS").attr("href", "admin/assets/css/alerts/alertify.default.css");
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
  height   : "75%",
  'afterClose':function () {
  window.location.reload();
  },
});
});

</script>

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

<!-- Including JS Content -->
<?php echo file_get_contents('admin/assets/js_bottom_front.php');?>

</body>
</html>