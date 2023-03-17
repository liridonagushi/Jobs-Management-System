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

<script type="text/javascript" src="assets/js/jquery-ui-1.12.0/external/jquery/jquery.js"></script>
<script type="text/javascript" src="assets/js/jquery-ui-1.12.0/jquery-ui.js"></script>


<!-- Showing alerts -->
<?php echo log_message(); ?>

</head>
<body>

  <!-- PRELOADER -->
  <div class="page-loader">
    <div class="loader">Loading...</div>
  </div> 

    <!-- WRAPPER -->
    <div class="container">

    <div class="text-header">Insert an Expertise Area</div>
    <section class="module">
    <hr class="divider">

                <div class="row">
                <!-- Form inserting the details  -->
                 <form id="form-validation" action="post_ins_expertise.php" method="post">

                        <div class="form-group col-sm-12 ">
                            <label class="control-label">Expertises Category</label>
                            <select id="id_cat_expertise" name="id_cat_expertise" class="form-control">
                                <option value="">Choose</option>
                            <?php $exp=$dbj->query('SELECT * FROM category_expertises WHERE active="1" ORDER BY id_cat_expertise');
                                  while($row_exp=$exp->fetch(PDO::FETCH_ASSOC)){
                            ?>
                              <option value="<?php echo $row_exp['id_cat_expertise'];?>"><?php echo $row_exp[''.$_SESSION['jbms_front']['lang_code'].'_expertise_category'];?></option>
                            <?php } ?>
                            </select>
                        </div>


                       <div class="form-group col-sm-12">
                          <label class="control-label">Expertises Area</label>
                          <input type="text"  name="expertise_area" id="expertise_area" value="" class="form-control" placeholder="ex: Developpeur*">
                        </div>
      
                    <div class="form-group col-sm-12">
                      <input class="form-control btn-default" type="submit" value="INSERT">
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
                
                  id_cat_expertise: {
                  required: true,
                  minlength: 1
                },
                  expertise_area: {
                  required: true,
                  minlength: 2,
                  maxlength: 80
                }
            },

            messages: {

                id_cat_expertise: {
                  required: "Please select a Category"
                },
                  expertise_area: {
                  required: "Please enter Title",
                  minlength: "Expertise Title must be at least 2 characters long",
                  maxlength: "Please enter no more than 80 characters."
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