<?php
// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('assets/include/variables.php');

// Including functions
include('assets/include/functions.php');

if (isset($_GET['logout'])&&$_GET['logout']=='user') {
// Message type and text
set_message(2,'You signed out !');
}

// Including header content
require_once('assets/css_header.php');
?>
<body>

  <div class="container">
  <div class="row ">
      <div class="col-md-12">
              <div class="fadeIn wow animated">
                <h4>Forgot Password !</h4>
              </div>
               <hr class="divider-msg">
      </div>
    </div>

      <div class="row">
            <form id="form-validation" name="form-validation" action="post_forgot_pass.php" method="post">

                <div class="col-sm-12">
                <div class="row">
                  <div class="col-sm-6">
                          <input type="text" class="form-control" id="email" placeholder="Email *" name="email">
                  </div>
                  </div>

                <div class="row">
                  <div class="col-sm-6">
                          <input type="text" class="form-control" id="birthday" placeholder="Birthday *" name="birthday">
                  </div>
                  </div>

                <div class="row">
                  <div class="col-sm-6">
                      <input type="submit" class="form-control btn btn-warning" value="Reset Password">
                  </div>
                  </div>
                </div>
            </form>
    
            </div>
    </div>

<!-- JS library and scripts-->
<!-- Showing alert messages -->
<!-- Alerts -->

<script type="text/javascript">
    $().ready(function() {
        // validate signup form on keyup and submit
        $("#form-validation").validate({
            rules: {
                email: {
                  required: true,
                  minlength: 5,
                  maxlength: 50,
                  email: true
                },

                birthday: {
                  required: true,
                  minlength: 5,
                  maxlength: 10
                }
            },

            messages: {

                email: {
                    required: "Please enter your email adress !",
                    minlength: "Email must be at least 5 characters long !",
                    maxlength: "Please enter no more than 50 characters !"
                },

                birthday: {
                    required: "Please enter your birthday !"
                }
            }
        });
    });

$(document).ready(function () {

    $("#birthday").datepicker({
        dateFormat: "yy-mm-dd",
        inline: true,
        maxDate:"-12 Years",
        changeYear: true,
        changeMonth: true,
        showButtonPanel: true
    });
});
</script>
<!-- Including Footer file -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>