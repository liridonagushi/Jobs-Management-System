<?php
include('admin/assets/include/functions.php');

// Function to check logged in user
login_front();

$experience=$dbj->query('SELECT DISTINCT working_experiences.id_experience, working_experiences.job_title, working_experiences.company_name, working_experiences.id_expertise, working_experiences.description, working_experiences.start_date, working_experiences.end_date, working_experiences.on_load, working_experiences.company_website, working_experiences.company_city, working_experiences.company_state, working_experiences.id_expertise, expertises.id_category, working_experiences.active FROM working_experiences LEFT JOIN expertises ON working_experiences.id_expertise=expertises.id_expertise LEFT JOIN category_expertises ON expertises.id_category=category_expertises.id_cat_expertise WHERE working_experiences.id_experience="'.$_GET['id_experience'].'" AND working_experiences.active="1"');
$row_experience=$experience->fetch(PDO::FETCH_ASSOC);

// Including header content
require_once('admin/assets/css_header_front.php');
?>

<body>
    <!-- container -->
    <div class="container">

    <div class="text-header"><?php echo languages($_SESSION['jbms_front']['lang_code'],71); //Update?> - <?php echo $row_experience['job_title'];?></div>
      <hr class="divider">
                <div class="row">

                <!-- Form inserting the details  -->
                 <form id="form-validation" action="post_upd_experience.php" method="post">
                    <input type="hidden" name="id_experience" value="<?php echo $_GET['id_experience'];?>">
                    
                      <div class="form-group col-xs-12">
                        <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],10); //Job Title?></label>
                        <input type="text"  name="job_title" id="job_title" value="<?php echo $row_experience['job_title'];?>" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],10); //Job Title?>*">
                      </div> 

                      <div class="form-group col-xs-6">
                        <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],38); //Company Name?></label>
                        <input type="text"  name="company_name" id="company_name" value="<?php echo $row_experience['company_name'];?>" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],38); //Company Name?>*">
                      </div> 

                      <div class="form-group col-xs-6">
                        <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],96); //Company Overview?></label>
                       <input type="text"  name="company_website" id="company_website" value="<?php echo $row_experience['company_website'];?>" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],96); //Company Overview?>*">
                      </div>

                      <div class="form-group col-xs-6">
                        <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],123); //company_city?></label>
                       <input type="text"  name="company_city" id="company_city" value="<?php echo $row_experience['company_city'];?>" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],123); //company_city?>*">
                      </div>

                      <div class="form-group col-xs-6">
                        <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],124); //Company State?></label>
                        <input type="text"  name="company_state" id="company_state" value="<?php echo $row_experience['company_state'];?>" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],124); //Company State?>*">
                      </div>

                      <div class="form-group col-xs-6 text-left">
                        <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],47); //Select category?></label>
                         <select name="id_cat_expertise" id="id_cat_expertise" class="form-control">
                        <option value=""><?php echo languages($_SESSION['jbms_front']['lang_code'],47); //Select category?></option>
                        <?php $exp_cat=$dbj->query('SELECT * FROM category_expertises');
                          while($row_exp_cat=$exp_cat->fetch(PDO::FETCH_ASSOC)){
                        ?>
                         <option value="<?php echo $row_exp_cat['id_cat_expertise'];?>" <?php if($row_exp_cat['id_cat_expertise']==$row_experience['id_category']){ ?> selected <?php } ?>><?php echo $row_exp_cat[''.$_SESSION['jbms_front']['lang_code'].'_expertise_category'];?></option>

                        <?php } ?>
                        </select>
                      </div>

                    <div class="form-group col-xs-6">
                        <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],48); //Expertises?></label>
                        <select name="id_expertise" id="id_expertise" class="form-control">
                            <option value=""><?php echo languages($_SESSION['jbms_front']['lang_code'],125); //Choosing Category?></option>
                        <?php $expertise=$dbj->query('SELECT * FROM expertises WHERE id_category="'.$row_experience['id_category'].'"')?>
                            <?php if($expertise->rowCount()>0){
                            while($row_exp=$expertise->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <option value="<?php echo $row_exp['id_expertise'];?>" <?php if($row_exp['id_expertise']==$row_experience['id_expertise']){ ?> selected <?php } ?>><?php echo $row_exp[''.$_SESSION['jbms_front']['lang_code'].'_expertise_area'];?></option>
                            <?php } } ?>
                        </select>
                    </div>


                    <div class="form-group col-xs-6 ">
                      <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],37); //Starting Date?></label>
                        <input type="text" name="start_date" id="date1" value="<?php echo date('Y-m-d',strtotime($row_experience['start_date']));?>" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],37); //Starting Date?>*">
                    </div>

                    <?php if($row_experience['end_date']){ ?>
                    
                    <div class="form-group col-xs-6">
                      <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],126); //Leaving Job ??></label>
                      <input type="text" name="end_date" id="date2"  value="<?php echo date('Y-m-d',strtotime($row_experience['end_date']));?>" class="form-control" placeholder="Graduation Date">
                    </div>

                    <?php }else{ ?>

                    <div id="dvDate" style="display: none;"  class="form-group col-xs-6">
                      <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],128); //Graduation Date?></label>
                      <input type="text" name="end_date" id="date2"  value="" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],128); //Graduation Date?>" />
                    </div>

                    <div class="form-group col-xs-6  text-left">
                    <div class="paddingtop5px">
                     <br /> <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],126); //Leaving Job ??></label>
                      <input type="checkbox" id="chkDate"  />
                    </div>
                    </div>
                    <?php } ?>

                    <div class="form-group col-xs-12 ">
                            <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],101); //Job Description?></label>
                        <textarea id="description" name="description" class="form-control" placeholder="Job Description"><?php echo $row_experience['description'];?></textarea>
                    </div>

                    <div class="form-group col-xs-12">
                      <input class="form-control btn-default" type="submit" value="UPDATE">
                    </div>

                  </form>
                </div>
    </div>
<script>
$(document).ready(function(){
    $('#id_cat_expertise').on('change',function(){
        var id_cat_expertise = $(this).val();
        if(id_cat_expertise){
            $.ajax({
                type:'POST',
                url:'admin/deroul_expertises.php',
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
    $().ready(function() {
        // validate signup form on keyup and submit
        $("#form-validation").validate({
            rules: {
                job_title: {
                  required: true,
                  minlength: 2,
                  maxlength: 80
                },
                  id_level_education: {
                  required: true
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

                company_name: {
                  required: true,
                  minlength: 2,
                  maxlength: 50
                },

                start_date: {
                    required: true,
                    date:true
                },

                 end_date: {
                    required: true,
                    date:true
                },

                description: {
                    required: true,
                    minlength: 12,
                    maxlength: 800
                }
            },

            messages: {

              
                id_level_education: {
                required: "Please select education level !"
                },

               id_level_experience: {
                    required: "Please select experience level !"
                },

               id_cat_expertise: {
                    required: "Please select a category !"
                },

                id_expertise: {
                    required: "Please select an expertise area !"
                },

                company_name: {
                    required: "Please provide a company name !",
                    minlength: "Company name must be at least 2 characters long !",
                    maxlength: "Please enter no more than 50 characters !"
                },

                start_date: {
                    required: "Please provide the starting date for the job !"
                },

                end_date: {
                    required: "Please provide the closing date for the job !"
                },

                description: {
                    required: "Please write a description for this position !",
                    minlength: "Description must be at least 12 characters long !",
                    maxlength: "Please enter no more than 800 characters !"
                }
            }
        });
    });

    $(function () {
        $("#chkDate").click(function () {
            if ($(this).is(":checked")) {
                $("#dvDate").show();
            } else {
                $("#dvDate").hide();
            }
        });
    });

    $(document).ready(function () {
        $("#date1").datepicker({
            dateFormat: "yy-mm-dd",
            inline: true,
            maxDate:0,
            changeYear: true,
            showButtonPanel: true
        });

        $('#date2').datepicker({
            dateFormat: "yy-mm-dd",
            maxDate:0,
            changeYear: true
        });
    });
</script>

<!-- Including JS file -->
<?php echo file_get_contents('admin/assets/js_bottom_front.php');?>

</body>
</html>