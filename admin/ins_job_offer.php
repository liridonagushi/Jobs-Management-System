<?php
// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

// Including functions
require_once('assets/include/functions.php');

//Including Variables
require_once('assets/include/variables.php');

// Including header content
require_once('assets/css_header.php');
?>

<body>

  <!-- PRELOADER -->
  <div class="page-loader">
    <div class="loader">Loading...</div>
  </div> 

    <!-- WRAPPER -->
    <div class="container">

    <div class="text-header">Insert a Job Offer</div>
    <section class="module">
    <hr class="divider">


                <!-- Form inserting the details  -->
                 <form id="form-validation" action="post_ins_job_offer.php" method="post">

                 <div class="form-group col-sm-12">
                    <label class="control-label">Job Title</label>
                    <input type="text"  name="job_title" id="job_title" value="" class="form-control" placeholder="Job Title*">
                  </div> 

                  <div class="form-group col-sm-4 ">
                    <label class="control-label">Company</label>
                        <select id="id_company" name="id_company" class="form-control">
                            <option value="">Choose</option>
                        <?php $comp=$dbj->query('SELECT * FROM companies WHERE id_employer="'.$_SESSION['jbms_back']['id_user'].'" ORDER BY id_company');
                              if($comp->rowCount()>0){
                              while($row_comp=$comp->fetch(PDO::FETCH_ASSOC)){
                        ?>
                           <option value="<?php echo $row_comp['id_company'];?>"><?php echo $row_comp['company_name'];?></option>
                        <?php }} ?>
                        </select>
                    </div>

                    <div class="form-group col-sm-4 text-left">
                      <label class="control-label">Category</label>
                       <select name="id_cat_expertise" id="id_cat_expertise" class="form-control">
                      <option value="">Select Category</option>
                      <?php $exp_cat=$dbj->query('SELECT * FROM category_expertises WHERE active=1 ORDER BY id_cat_expertise');
                        while($row_exp_cat=$exp_cat->fetch(PDO::FETCH_ASSOC)){
                      ?>
                       <option value="<?php echo $row_exp_cat['id_cat_expertise'];?>"><?php echo $row_exp_cat[''.$_SESSION['jbms_front']['lang_code'].'_expertise_category'];?></option>

                      <?php } ?>
                      </select>
                    </div>

                    <div class="form-group col-sm-4">
                        <?php $exp=$dbj->query('SELECT * FROM expertises WHERE active=1 order by id_expertise')?>
                        <label class="control-label">Area</label>
                        <select name="id_expertise" id="id_expertise" class="form-control">
                            <option value="">Choosing Category</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-6 text-left">
                        <label class="control-label">Diploma Required</label>
                         <select name="id_level_education" id="id_level_education" class="form-control">
                        <option value="">No diploma required</option>
                        <?php $exp_cat=$dbj->query('SELECT * FROM levels_education  WHERE active=1 ORDER BY id_level_education');
                          while($row_exp_cat=$exp_cat->fetch(PDO::FETCH_ASSOC)){
                        ?>
                         <option value="<?php echo $row_exp_cat['id_level_education'];?>"><?php echo $row_exp_cat[''.$_SESSION['jbms_front']['lang_code'].'_level_education'];?></option>

                        <?php } ?>
                        </select>
                      </div>

                      <div class="form-group col-sm-6 text-left">
                        <label class="control-label">Salary Offered</label>
                         <select name="id_salary" id="id_salary" class="form-control">
                        <option value="">Not indicated</option>
                        <?php $salary=$dbj->query('SELECT * FROM salary_ranges  WHERE active=1 ORDER BY id_salary');
                          while($row_salary=$salary->fetch(PDO::FETCH_ASSOC)){
                        ?>
                         <option value="<?php echo $row_salary['id_salary'];?>"><?php echo $row_salary['salary_range'];?> <?php echo $_SESSION['jbms_back']['currency'];?></option>

                        <?php } ?>
                        </select>
                      </div>

                      <div class="form-group col-sm-12 text-left">
                        <label class="control-label">Years Experience</label>
                         <select name="id_level_experience" id="id_level_experience" class="form-control">
                        <?php $exp_cat=$dbj->query('SELECT * FROM levels_experience  WHERE active=1 ORDER BY id_level_experience');
                          while($row_exp_cat=$exp_cat->fetch(PDO::FETCH_ASSOC)){
                        ?>
                         <option value="<?php echo $row_exp_cat['id_level_experience'];?>"><?php echo $row_exp_cat['years_experience'];?> - <?php echo $row_exp_cat[''.$_SESSION['jbms_front']['lang_code'].'_level_experience'];?></option>

                        <?php } ?>
                        </select>
                      </div>

                    <div class="form-group col-sm-12 ">
                        <label class="control-label">Job Description</label>
                        <textarea maxlength="800" id="field" onkeyup="countChar(this)" id="job_description" name="job_description" class="form-control classy-editor" rows="5" cols="180" placeholder="Motivation Words"></textarea>
                        <div id="charNum"></div>
                    </div>

                    <div class="form-group col-sm-12">
                      <input class="form-control btn-default" type="submit" value="Insert">
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

<script type="text/javascript">
    $().ready(function() {
        // validate signup form on keyup and submit
        $("#form-validation").validate({
            rules: {
                  job_title: {
                  required: true,
                  minlength: 2,
                  maxlength: 80
                },
                 id_level_experience: {
                  required: true
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

                job_description: {
                    required: true,
                    minlength: 20,
                    maxlength: 800
                },

                id_country: {
                    required: true
                }
            },

            messages: {

                job_title: {
                    required: "Please provide a job title",
                    minlength: "Title must be at least 2 characters long",
                    maxlength: "Please enter no more than 80 characters."
                },
                id_level_experience: {
                    required: "Please select experience level"
                },

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

                job_description: {
                    required: "Please write a description for the position",
                    minlength: "Description must be at least 20 characters long",
                    maxlength: "Please enter no more than 800 characters"
                },

                id_country: {
                    required: "Please select a country"
                }
            }
        });
    });
</script>

<!-- Including Footer file -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>