<?php

// Including functions
require_once('assets/include/functions.php');

// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);
//Including Variables

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('assets/include/variables.php');

// Query of the database
$job_offre = $dbj->query('SELECT DISTINCT job_offers.id_job, job_offers.id_salary, job_offers.job_sn, users.id_user, category_expertises.id_cat_expertise, job_offers.id_expertise, companies.company_name, job_offers.job_title, job_offers.job_description, job_offers.publish_date, job_offers.closing_date, levels_education.id_level_education, levels_education.'.$_SESSION['jbms_front']['lang_code'].'_level_education AS level_education, levels_experience.id_level_experience, levels_experience.'.$_SESSION['jbms_front']['lang_code'].'_level_experience AS level_experience, levels_experience.years_experience, category_expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_category AS expertise_category, expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_area AS expertise_area, companies.id_company FROM job_offers LEFT JOIN expertises ON job_offers.id_expertise=expertises.id_expertise LEFT JOIN category_expertises ON expertises.id_category=category_expertises.id_cat_expertise LEFT JOIN companies ON job_offers.id_company=companies.id_company JOIN users ON companies.id_employer=users.id_user LEFT JOIN levels_education ON job_offers.id_level_education=levels_education.id_level_education LEFT JOIN levels_experience ON job_offers.id_level_experience=levels_experience.id_level_experience WHERE job_offers.id_job="'.$_GET['id_job'].'" AND users.id_user="'.$_SESSION['jbms_back']['id_user'].'"');
$row_job=$job_offre->fetch(PDO::FETCH_ASSOC);

// Including header content
require_once('assets/css_header.php');
?>

<body>

    <!-- WRAPPER -->
    <div class="container">

    <div class="text-header">Update Job Offer</div>
    <section class="module">
    <hr class="divider">

        <div class="row">
           <div class="form-group col-md-12">

                <!-- Form inserting the details  -->
                 <form id="form-validation" action="post_upd_job_offer.php" method="post">
                 <input type="hidden" name="id_job" value="<?php echo $_GET['id_job'];?>">
                 <input type="hidden" name="job_sn" value="<?php echo $row_job['job_sn'];?>">

                       <div class="form-group col-sm-12">
                          <label class="control-label">Job Title</label>
                          <input type="text"  name="job_title" id="job_title" value="<?php echo $row_job['job_title'];?>" class="form-control" placeholder="Company Name*">
                        </div> 

                      <div class="form-group col-sm-12 ">
                        <label class="control-label">Company</label>
                            <select id="id_company" name="id_company" class="form-control">
                                <option value="">Choose</option>
                            <?php $comp=$dbj->query('SELECT * FROM companies WHERE active=1 AND id_employer="'.$_SESSION['jbms_back']['id_user'].'" ORDER BY company_name');
                                  while($row_comp=$comp->fetch(PDO::FETCH_ASSOC)){
                            ?>
                               <option value="<?php echo $row_comp['id_company'];?>" <?php if($row_comp['id_company']==$row_job['id_company']){ ?> selected <?php } ?>> <?php echo $row_comp['company_name'];?></option>
                            <?php } ?>
                            </select>
                        </div>

                      <div class="form-group col-sm-6 text-left">
                        <label class="control-label">Category</label>
                         <select name="id_cat_expertise" id="id_cat_expertise" class="form-control">
                        <option value="">Select Category</option>
                        <?php $exp_cat=$dbj->query('SELECT * FROM category_expertises WHERE active=1 ORDER BY id_cat_expertise');
                          while($row_exp_cat=$exp_cat->fetch(PDO::FETCH_ASSOC)){
                        ?>
                         <option value="<?php echo $row_exp_cat['id_cat_expertise'];?>" <?php if($row_exp_cat['id_cat_expertise']==$row_job['id_cat_expertise']){ ?> selected <?php } ?>><?php echo $row_exp_cat[''.$_SESSION['jbms_front']['lang_code'].'_expertise_category'];?></option>

                        <?php } ?>
                        </select>
                      </div>

                    <div class="form-group col-sm-6">
                        <?php $exp=$dbj->query('SELECT * FROM expertises WHERE active=1 ORDER BY id_expertise');?>
                        <label class="control-label">Area</label>
                        <select name="id_expertise" id="id_expertise" class="form-control">
                            <option value="">Choosing Category</option>
                            <?php if($exp->rowCount()>0){ 
                            while($row_exp=$exp->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <option value="<?php echo $row_exp['id_expertise'];?>" <?php if($row_exp['id_expertise']==$row_job['id_expertise']){ ?> selected <?php } ?>><?php echo $row_exp[''.$_SESSION['jbms_front']['lang_code'].'_expertise_area'];?></option>
                            <?php } } ?>
                        </select>
                    </div>

                    <div class="form-group col-sm-6 ">
                        <label class="control-label">Publish Date</label>
                        <input type="text" value="<?php echo date('Y-m-d',strtotime($row_job['publish_date']));?>" class="form-control" placeholder="Publish Date*" disabled="true">
                    </div>

                    <div class="form-group col-sm-6 ">
                        <label class="control-label">Closing Date</label>
                        <input type="text" name="closing_date" id="closing_date"  value="<?php echo $row_job['closing_date'];?>" class="form-control" placeholder="Closing Date*">
                    </div>
                      <div class="form-group col-sm-4 text-left">
                        <label class="control-label">Diploma Required</label>
                         <select name="id_level_education" id="id_level_education" class="form-control">
                        <option value="">Select Diploma</option>
                        <?php $exp_cat=$dbj->query('SELECT * FROM levels_education ORDER BY id_level_education');
                          while($row_lev_ed=$exp_cat->fetch(PDO::FETCH_ASSOC)){
                        ?>
                            <option value="<?php echo $row_lev_ed['id_level_education'];?>" <?php if($row_lev_ed['id_level_education']==$row_job['id_level_education']){ ?> selected <?php } ?>><?php echo $row_lev_ed[''.$_SESSION['jbms_front']['lang_code'].'_level_education'];?></option>
                        <?php } ?>
                        </select>
                      </div>

                      <div class="form-group col-sm-4 text-left">
                        <label class="control-label">Years Experience</label>
                         <select name="id_level_experience" id="id_level_experience" class="form-control">
                        <option value="">Select Experience Years</option>
                        <?php $exp_cat=$dbj->query('SELECT * FROM levels_experience ORDER BY id_level_experience');
                          while($row_exp_cat=$exp_cat->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <option value="<?php echo $row_exp_cat['id_level_experience'];?>" <?php if($row_exp_cat['id_level_experience']==$row_job['id_level_experience']){ ?> selected <?php } ?>><?php echo $row_exp_cat['years_experience'];?> - <?php echo $row_exp_cat[''.$_SESSION['jbms_front']['lang_code'].'_level_experience'];?></option>

                        <?php } ?>
                        </select>
                      </div>
                       <div class="form-group col-sm-4 text-left">
                        <label class="control-label">Salary Range</label>
                         <select name="id_salary" id="id_salary" class="form-control">
                        <option value="">Select Salary</option>
                        <?php $salary=$dbj->query('SELECT * FROM salary_ranges ORDER BY id_salary');
                              while($row_salary=$salary->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <option value="<?php echo $row_salary['id_salary'];?>"<?php if($row_salary['id_salary']==$row_job['id_salary']){ ?> selected <?php } ?>><?php echo $row_salary['salary_range'];?> <?php echo $_SESSION['jbms_back']['currency'];?></option>
                        <?php } ?>
                        </select>
                      </div>
                          
                        <div class="form-group col-sm-12 ">
                            <label class="control-label">Job Description</label>
                            <textarea maxlength="800" id="field" onkeyup="countChar(this)" id="job_description" name="job_description" class="form-control classy-editor" rows="5" cols="180" placeholder="Motivation Words"><?php echo $row_job['job_description'];?></textarea>
                            <div id="charNum"></div>
                        </div>

                        <div class="form-group col-sm-12">
                          <input class="form-control btn-default" type="submit" value="UPDATE">
                        </div>

                  </form>
                </div>
                </div>
        </section>
    </div>

    <!-- /section -->
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

<script>
    $().ready(function() {
        // validate signup form on keyup and submit
        $("#form-validation").validate({
            rules: {
                  job_title: {
                  required: true,
                  minlength: 2,
                  maxlength: 80
                },
                 id_cat_expertise: {
                  required: true
                },

                id_expertise: {
                    required: true
                },

                id_company: {
                    required: true
                },

                 publish_date: {
                    required: true,
                    date:true
                },

                closing_date: {
                    required: true
                },


                id_country: {
                    required: true
                },

                id_salary: {
                    required: true
                },

                job_description: {
                    required: true,
                    minlength: 20,
                    maxlength: 800
                }
            },

            messages: {



               id_cat_expertise: {
                    required: "Please select a category"
                },

                id_expertise: {
                    required: "Please select an expertise area"
                },

                id_company: {
                    required: "Please select your company"
                },

                publish_date: {
                    required: "Please provide the publish date of the job"
                },

                closing_date: {
                    required: "Please provide the closing date of the job"
                },

                job_title: {
                    required: "Please provide a job title",
                    minlength: "Title must be at least 2 characters long",
                    maxlength: "Please enter no more than 80 characters."
                },

                id_country: {
                    required: "Please select a country"
                },

                id_salary: {
                    required: "Please select a salary range"
                },

                job_description: {
                    required: "Please write a description for the position",
                    minlength: "Description must be at least 20 characters long",
                    maxlength: "Please enter no more than 800 characters"
                }

            }
        });
    });
</script>

<script type="text/javascript">
$(document).ready(function () {
    $("#closing_date").datepicker({
        dateFormat: "yy-mm-dd",
        inline: true,
        minDate:0,
        changeYear: true,
        changeMonth: true,
        yearRange: "-0:+1", 
        showButtonPanel: true
    });
});
</script>

<!-- Including Footer file -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>