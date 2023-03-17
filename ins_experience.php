<?php
include('admin/assets/include/functions.php');

// Function to check logged in user
login_front();

// Including header content
require_once('admin/assets/css_header_front.php');?>
<body>

<!-- PRELOADER -->
<div class="page-loader">
  <div class="loader">Loading...</div>
</div> 

  <!-- container -->
  <div class="container">

    <div class="text-header"><?php echo languages($_SESSION['jbms_front']['lang_code'],122); //Insert a Job Experience?></div>
      <hr class="divider">
                <div class="row">

                <!-- Form inserting the details  -->
                 <form id="form-validation" action="post_ins_experience.php" method="post">

                      <div class="form-group col-xs-12">
                        <input type="text"  name="job_title" id="job_title" value="" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],10); //Job Title?>*">
                      </div> 

                      <div class="form-group col-xs-6">
                        <input type="text"  name="company_name" id="company_name" value="" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],38); //Company Name?>*">
                      </div> 

                      <div class="form-group col-xs-6">
                       <input type="text"  name="company_website" id="company_website" value="" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],96); //Company Overview?>">
                      </div>

                      <div class="form-group col-xs-12">
                       <input type="text"  name="company_city" id="company_city" value="" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],123); //company_city?>">
                      </div>

                      <div class="form-group col-xs-12">
                        <input type="text"  name="company_state" id="company_state" value="" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],124); //Company State?>">
                      </div>

                      <div class="form-group col-xs-6 text-left">
                         <select name="id_cat_expertise" id="id_cat_expertise" class="form-control">
                        <option value=""><?php echo languages($_SESSION['jbms_front']['lang_code'],47); //Select category?></option>
                        <?php $exp_cat=$dbj->query('SELECT * FROM category_expertises');
                          while($row_exp_cat=$exp_cat->fetch(PDO::FETCH_ASSOC)){
                        ?>
                         <option value="<?php echo $row_exp_cat['id_cat_expertise'];?>"><?php echo $row_exp_cat['expertise_category'];?></option>

                        <?php } ?>
                        </select>
                      </div>

                    <div class="form-group col-xs-6">
                        <?php $exp=$dbj->query('SELECT * FROM expertises')?>
                        <select name="id_expertise" id="id_expertise" class="form-control">
                            <option value=""><?php echo languages($_SESSION['jbms_front']['lang_code'],125); //Choosing Category?></option>
                        </select>
                    </div>

                    <div class="form-group col-xs-6 ">
                        <input type="text" name="start_date" id="date1" value="" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],37); //Starting Date?> *">
                    </div>

                    <div id="dvDate" style="display: none;"  class="form-group col-xs-6">
                      <input type="text" name="end_date" id="date2"  value="" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],46); //Finishing Date?>">
                    </div>

                    <div class="form-group col-xs-6  text-left">
                      <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],126); //Leaving Job ??></label>
                      <input type="checkbox" id="chkDate" />
                    </div>
                    <div class="form-group col-xs-12 ">
                            <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],101); //Job Description ??></label>
                        <textarea id="description" name="description" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],101); //Job Description?>"></textarea>
                    </div>

                    <div class="form-group col-xs-12">
                      <input class="form-control btn-default" type="submit" value="<?php echo languages($_SESSION['jbms_front']['lang_code'],127); //Insert?>">
                    </div>

                  </form>
          </div>
    </div>
    
    <!-- /section -->
<script type="text/javascript">
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

// JS library and scripts
//  Showing alert messages
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
                    required: true
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
  <!-- Including Footer file -->
  <?php echo file_get_contents('admin/assets/js_bottom_front.php');?>

</body>
</html>