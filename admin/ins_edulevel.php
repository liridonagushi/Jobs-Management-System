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
login_oneadmin();

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

  <div class="text-header">Insert a Qualification Level</div>
    <section class="module">
    <hr class="divider">

      <div class="row">

      <!-- Form inserting the details  -->
      <form id="form-validation" action="post_ins_edulevel.php" method="post">

        <div class="form-group col-lg-12">
          <label class="control-label">Qualification Level</label>
          <input type="text"  name="level_education" id="level_education" value="" class="form-control" placeholder="ex: High School Diploma*">
        </div> 

        <div class="form-group col-lg-12">
          <input class="form-control btn-default" type="submit" value="INSERT">
        </div>

      </form>
      </div>
    </section>
  </div>
</div>

<!-- JS library and scripts-->
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
                    required: "Please enter a Level",
                    minlength: "Level must be at least 2 characters long",
                    maxlength: "Please enter no more than 80 characters."
                }
            }
        });
    });
</script>

<!-- Including JS Content -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>