<?php
include('admin/assets/include/functions.php');
// Function to check logged in user

login_front();

// Including header content
require_once('admin/assets/css_header_front.php');?>
<body>

<!-- PRELOADER -->
<!-- <div class="page-loader">
  <div class="loader">Loading...</div>
</div>  -->

  <!-- container -->
  <div class="container">

    <div class="text-header">Insert a Diploma</div>
     <hr class="divider">
            <div class="row">
                <!-- Form inserting the details  -->
                 <form id="form-validation" action="post_ins_diploma.php" method="post">

                    <div class="form-group col-xs-6 text-left">
                      <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],73);//Education Level?></label>
                      <select name="id_level_education" id="id_level_education" class="form-control">
                      <option value=""><?php echo languages($_SESSION['jbms_front']['lang_code'],65);//Choose?></option>
                      <?php $lev_edu=$dbj->query('SELECT * FROM levels_education WHERE active="1" ORDER BY id_level_education');
                      while($row_edu=$lev_edu->fetch(PDO::FETCH_ASSOC)){
                      ?>
                      <option value="<?php echo $row_edu['id_level_education'];?>"><?php echo $row_edu[''.$_SESSION['jbms_front']['lang_code'].'_level_education'];?></option>
                      <?php } ?>
                      </select>
                    </div>

                    <div class="form-group col-xs-6 text-left">
                      <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],74);//Diploma Type?></label>
                      <select name="id_type_diploma" id="id_type_diploma" class="form-control">
                      <option value=""><?php echo languages($_SESSION['jbms_front']['lang_code'],65);//Choose?></option>
                      <?php $exp_cat=$dbj->query('SELECT * FROM diploma_types WHERE active="1"');
                      while($row_exp_cat=$exp_cat->fetch(PDO::FETCH_ASSOC)){
                      ?>
                      <option value="<?php echo $row_exp_cat['id_type_diploma'];?>"><?php echo $row_exp_cat[''.$_SESSION['jbms_front']['lang_code'].'_type_diploma'];?></option>
                      <?php } ?>
                      </select>
                    </div>

                    <div class="form-group col-xs-12">
                      <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],75);//Diploma Title?></label>
                      <input type="text"  name="title_diploma" id="title_diploma" value="" class="form-control" placeholder="ex. Engineer *">
                    </div>

                    <div class="form-group col-xs-6 ">
                        <input type="text" name="date_started" id="date1" value="" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],37);//Starting Date?>*">
                    </div>

                    <div id="dvDate" style="display: none;"  class="form-group col-xs-6">
                      <input type="text" name="date_finished" id="date2"  value="" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],128);//Date Graduated?>">
                    </div>

                    <div class="form-group col-xs-6  text-left">
                      <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],130);//Graduated ??></label>
                      <input type="checkbox" id="chkDate" />
                    </div>

                    <div class="form-group col-xs-12">
                      <input class="form-control btn-default" type="submit" value="INSERT">
                    </div>

                </form>
              </div>
    </div>

<!-- JS library and scripts-->
<!-- Showing alert messages -->
<script type="text/javascript">

    $().ready(function() {
        // validate signup form on keyup and submit
        $("#form-validation").validate({
            rules: {
                  id_type_diploma: {
                  required: true
                },
                  title_diploma: {
                  required: true,
                  minlength: 2,
                  maxlength: 50
                },
                  date_started: {
                  required: true,
                  minlength: 2,
                  maxlength: 50
                },
                  date_finished: {
                  required: true,
                  minlength: 2,
                  maxlength: 50
                },
                 id_level_education: {
                  required: true,
                  minlength: 1,
                  maxlength: 8
                }
            },

            messages: {

                id_type_diploma: {
                    required: "Please enter a diploma type !"
                },

                title_diploma: {
                    required: "Please enter a diploma title !",
                    minlength: "Title must be at least 2 characters long",
                    maxlength: "Please enter no more than 80 characters."
                },

                date_started: {
                    required: "Please enter starting date !",
                    minlength: "Type must be at least 2 characters long",
                    maxlength: "Please enter no more than 80 characters."
                },
                date_finished: {
                    required: "Please enter graduation date !",
                    minlength: "Type must be at least 2 characters long",
                    maxlength: "Please enter no more than 80 characters."
                },
               id_level_education: {
                    required: "Please select an education level !"
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