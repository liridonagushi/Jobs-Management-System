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
?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- Latest compiled and minified JavaScript -->
<link href="assets/bootstrap/336/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/js/jquery-ui-1.12.0/jquery-ui.css" rel="stylesheet">
  
<!-- Icon Fonts -->
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<link href="assets/css/et-line-font.min.css" rel="stylesheet">
  <!-- Alerts -->
      <!-- Template core CSS -->
<link href="assets/css/style.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css" />
<link rel="stylesheet" href="assets/css/template.css" />
<link rel="stylesheet" href="assets/css/alerts/alertify.core.css" />
<link rel="stylesheet" href="assets/css/alerts/alertify.default.css" id="toggleCSS" />
<link href="assets/bootstrap-switchery/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet">

<script type="text/javascript" src="assets/js/jquery-ui-1.12.0/external/jquery/jquery.js"></script>
<script type="text/javascript" src="assets/js/jquery-ui-1.12.0/jquery-ui.js"></script>


<!-- Showing alerts -->
<?php echo log_message(); ?>

</head>
<body>

  <!-- PRELOADER -->
  <div class="page-loader">
    <div class="loader">Loading</div>
  </div> 

    <!-- WRAPPER -->
    <div class="container">

    <div class="text-header">Insert an Experience Level</div>
    <section class="module">
    <hr class="divider">

                <div class="row">

                <!-- Form inserting the details  -->
                 <form id="form-validation" action="post_ins_explevel.php" method="post">

                   <div class="form-group col-lg-12">
                      <label class="control-label">Experience Level</label>
                      <input type="text"  name="level_experience" id="level_experience" value="" class="form-control" placeholder="ex.: Medium *">
                    </div>

                   <div class="form-group col-lg-12">
                      <label class="control-label">Years Experience</label>
                      <input type="text"  name="years_experience" id="years_experience" value="" class="form-control" placeholder="ex.: 2-5 *">
                    </div>

                    <div class="form-group col-lg-12">
                      <input class="form-control btn-default" type="submit" value="Insert">
                    </div>
                  </form>

                </div>
        </section>
    </div>

<!-- JS library and scripts-->
<!-- Showing alert messages -->
<!-- Alerts -->
<script type="text/javascript">
function reset () {
  $("#toggleCSS").attr("href", "assets/css/alerts/alertify.default.css");
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
                    required: "Please enter a years range experience ex.: 2-5 !",
                    maxlength: "Please enter a standard years experience !"
                }
            }
        });
    });
</script>

<!-- /JS scripts -->
<script src="assets/js/alerts/alertify.min.js"></script>
<script src="assets/js/validation/jquery.validate.js"></script>
<script src="assets/js/validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>

</body>
</html>