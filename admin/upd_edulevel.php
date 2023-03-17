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
$level=$dbj->query('SELECT * FROM levels_education WHERE id_level_education="'.$_GET['id_level_education'].'"');
$row_level=$level->fetch(PDO::FETCH_ASSOC);
login_twoadmin();

// Including header content
require_once('assets/css_header.php');?>
<body>

  <!-- PRELOADER -->
  <div class="page-loader">
    <div class="loader">Loading...</div>
  </div> 

    <!-- WRAPPER -->
    <div class="container">

    <div class="text-header">Update Education Level</div>
    <section class="module">
    <hr class="divider">

                <div class="row">

                <!-- Form inserting the details  -->
                 <form id="form-validation" action="post_upd_edulevel.php" method="post">
                 <input type="hidden" name="id_level_education" value="<?php echo $_GET['id_level_education'];?>">

                       <div class="form-group col-sm-12">
                          <label class="control-label">Education Level</label>
                          <input type="text"  name="level_education" id="level_education" value="<?php echo $row_level['level_education'];?>" class="form-control" placeholder="Job level_education*">
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
                
                  level_education: {
                  required: true,
                  minlength: 2,
                  maxlength: 80
                }
            },

            messages: {

                level_education: {
                    required: "Please enter a Category",
                    minlength: "Category must be at least 2 characters long",
                    maxlength: "Please enter no more than 80 characters."
                }
            }
        });
    });
</script>

<!-- Including Footer file -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>