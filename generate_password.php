<?php
include('admin/assets/include/functions.php');
$controller=$dbj->query('SELECT id_user, generate_pass_key, active FROM users WHERE id_user="'.$_GET['id_user'].'" AND generate_pass_key="'.$_GET['generate_pass_key'].'" AND active="0"');
if(!($controller->rowCount()>0)){return;}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Latest compiled and minified JavaScript -->
    <link href="admin/assets/css/bootstrap-3.3.7/css/bootstrap.css" rel="stylesheet">
    <link href="admin/assets/css/jquery-ui-1.12.0/jquery-ui.css" rel="stylesheet">
      
    <!-- Icon Fonts -->
    <link href="admin/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="admin/assets/css/et-line-font.min.css" rel="stylesheet">
      <!-- Alerts -->
          <!-- Template core CSS -->
    <!-- <link rel="stylesheet" href="admin/assets/css/style.css" /> -->
    <link rel="stylesheet" href="admin/assets/css/admin_style.css" />
    <link rel="stylesheet" href="admin/assets/css/alerts/alertify.core.css" />
    <link rel="stylesheet" href="admin/assets/css/alerts/alertify.default.css" id="toggleCSS" />

    <script type="text/javascript" src="admin/assets/css/jquery-ui-1.12.0/external/jquery/jquery.js"></script>
    <script type="text/javascript" src="admin/assets/js/jquery-ui-1.12.0/jquery-ui.js"></script>

    <!-- Showing alerts -->
    <?php echo log_message(); ?>
  </head>
<body>

<!--Top_content-->
<section id="index">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 top_left_cont dispbl">
                        <a class="hyperlink focused">Forgot Password !</a> 
                        <a href="sign.php"  class="hyperlink">Login !</a> 
                        <a href="register.php" class="hyperlink">New User !</a> 
                       <hr class="divider-menu">
            </div>
        </div>

        <div class="row dispbl">
            <form action="post_upd_settings.php" id="form-validation" name="form-validation" method="POST">
                  <input type="hidden" name="target" value="password" />

                 <div class="row">
                    <div class="col-xs-4">
                       <input type="text" name="password" id="password" value="" class="form-control" placeholder="New Password">
                    </div>
                  </div>

                 <div class="row">
                    <div class="col-xs-4">
                       <input type="text" name="new_password" id="new_password" value="" class="form-control" placeholder="Confirm New Password">
                    </div>
                  </div>

                 <div class="row">
                    <div class="col-xs-4 text-center">
                       <input type="submit" class="form-control btn btn-info" value="Update Password">
                    </div>
                  </div>

              </form>
        </div>
    </div>
</section>

<!--Footer-->
<?php require_once('admin/footer.php');?>

</footer>
<!-- JS library and scripts-->
<!-- Showing alert messages -->
<!-- Alerts -->
<script type="text/javascript">
function reset () {
  $("#toggleCSS").attr("href", "admin/assets/css/alerts/alertify.default.css");
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
<script type="text/javascript">

$(document).ready(function () {

    $("#birthday").datepicker({
        dateFormat: "yy-mm-dd",
        inline: true,
        maxDate:0,
        changeYear: true,
        showButtonPanel: true
    });
});

</script>

<script>
    $().ready(function() {
        // validate signup form on keyup and submit
        $("#form-validation").validate({
            rules: {
                  password: {
                  required: true,
                  minlength: 5,
                  maxlength: 10
                },
                  new_password: {
                  required: true,
                  minlength: 5,
                  maxlength: 10,
                  equalTo: "#password"
                },
            },

            messages: {

                password: {
                    required: "Please enter a new password",
                    minlength: "Password must be between 5 and 10 characters",
                    maxlength: "Please enter no more than 10 characters."
                },
                new_password: {
                    required: "Please enter the same password"
                }
            }
        });
    });
</script>
<!-- /JS scripts -->
<script src="admin/assets/js/alerts/alertify.min.js"></script>
<script src="admin/assets/js/validation/jquery.validate.js"></script>
<script src="admin/assets/js/validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="admin/assets/js/custom.js"></script>

</body>
</html>
