<?php
// Including functions
require_once('assets/include/functions.php');

// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('assets/include/variables.php');


// Function to check logged in user
login_twoadmin();

$level=$dbj->query('SELECT * FROM levels_experience WHERE id_level_experience='.$_GET['id_level_experience'].'');
$row_level=$level->fetch(PDO::FETCH_ASSOC);

// Including header content
require_once('assets/css_header.php');?>
<body>

  <!-- PRELOADER -->
  <div class="page-loader">
    <div class="loader">Loading...</div>
  </div> 

    <!-- WRAPPER -->
    <div class="container">

    <div class="text-header">Update Experience Level</div>
    <section class="module">
      <hr class="divider">

                <div class="row">
                <!-- Form inserting the details  -->
                 <form id="form-validation" action="post_upd_explevel.php" method="post">
                 <input type="hidden" name="id_level_experience" value="<?php echo $row_level['id_level_experience'];?>">

                    <div class="form-group col-lg-12">
                      <label class="control-label">Experience Level</label>
                      <input type="text"  name="level_experience" id="level_experience" value="<?php echo $row_level['level_experience'];?>" class="form-control" placeholder="ex.: Medium *">
                    </div>

                   <div class="form-group col-lg-12">
                      <label class="control-label">Years Experience</label>
                      <input type="text"  name="years_experience" id="years_experience" value="<?php echo $row_level['years_experience'];?>" class="form-control" placeholder="ex.: 2-5 *">
                    </div>

                        <div class="form-group col-sm-12 ">
                          <label class="control-label">Level Active ?</label>
                          <p><?php echo checkbox('active', $row_level['active']);// Checkbox: name and value?></p>
                       </div>

                    <div class="form-group col-sm-12">
                      <input class="form-control btn-default" type="submit" value="Update">
                    </div>
                    
                  </form>
                </div>
        </section>
    </div>

<!-- JS library and scripts-->
<!-- JS Slice Switching -->
<script>
$(function(argument) {
  $('[type="checkbox"]').bootstrapSwitch();
})
</script>

<script>
    $().ready(function() {
        // validate signup form on keyup and submit
        $("#form-validation").validate({
            rules: {
                  level_experience: {
                  required: true,
                  minlength: 2,
                  maxlength: 20
                },
                  years_experience: {
                  required: true,
                  maxlength: 8
                }
            },

            messages: {

                level_experience: {
                    required: "Please enter a level !",
                    minlength: "Level must be at least 2 characters long !",
                    maxlength: "Please enter no more than 20 characters !"
                },

                years_experience: {
                    required: "Please enter a diploma title",
                    maxlength: "Please enter a standard years experience !"
                }
            }
        });
    });
</script>

<!-- Including Footer file -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>