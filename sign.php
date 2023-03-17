<?php
// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('admin/assets/include/variables.php');

// Including functions
include('admin/assets/include/functions.php');

if ((isset($_GET['logout'])) && ($_GET['logout']=='user')) {
// Message type and text
set_message(2,'You signed out !');
}

// Including header content
require_once('admin/assets/css_header_front.php');
?>
<body>
<?php echo include('top_menu.php');?>

<!--Top_content-->
<section id="index">
<div class="container">
 <div class="row">
    <div class="margintop100px">

    <div class="col-md-6 difbg">
      <div class="fadeIn wow animated margin-bottom">
        <h2><?php echo languages($_SESSION['jbms_front']['lang_code'],33); //Login?></h2>
        <hr class="divider-msg">
      </div>
        <form  id="form-validation" action="post_login.php" method="post">
          <input type="hidden" name="source" value="front">

          <div class="row">
            <div class="col-md-12">
             <input type="text" class="form-control" id="email" placeholder="Email" name="email">
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
             <input type="password" class="form-control" id="password" placeholder="Password" name="password">
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <input type="submit" class="form-control btn btn-info" value="Login">
              <a class="fancybox1 fancybox.iframe" href="forgot_pass.php"><span class="text-error"><?php echo languages($_SESSION['jbms_front']['lang_code'],36); //Forgot Pass !?></span></a>
            </div>
          </div>
        </form>
    </div>

    <div class="col-md-6 difbg2">
      <div class="fadeIn wow animated margin-bottom">
        <h2 style="color:white"><?php echo languages($_SESSION['jbms_front']['lang_code'],131); //Register as Employee ! !?></h2>
        <hr class="divider-gray">
      </div>
      <form  id="register-validation" action="post_register.php" method="POST">
      <input type="hidden" name="source" value="front">

      <div class="row">
        <div class="col-sm-6">
          <input type="text" class="form-control" id="name" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],86); //Name ! !?> *" name="name">
        </div>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="surname" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],87); //Surname !?> *" name="surname">
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
        <input type="text" class="form-control" id="birthday" name="birthday" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],92); //Birthday !?> *" readonly="readonly" />
        </div>
      </div>


      <div class="row">
        <div class="col-sm-12">
        <input type="text" class="form-control" id="email" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],135); //Email !?> *" name="email">
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
        <input type="password" class="form-control" id="password" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],88); //Password !?> *" name="password">
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <input type="submit" class="form-control btn btn-default" value="<?php echo languages($_SESSION['jbms_front']['lang_code'],136); //Agree & Register !?>">
        </div>
      </div>
      </form>
      </div>

      </div>
    </div>

</section>

<!--Top_content--> 
<!--Service-->

<!-- Including Footer -->
<?php require_once('admin/footer.php');?>


<!-- JS library and scripts-->
<!-- Showing alert messages -->
<!-- Alerts -->

<script>
    $(document).ready(function () {
        // validate signup form on keyup and submit
        $("#form-validation").validate({
            rules: {
                  email: {
                  required: true,
                  minlength: 5,
                  maxlength: 50,
                  email: true
                },
                  password: {
                  required: true,
                  minlength: 5,
                  maxlength: 10
                }
            },

            messages: {

                email: {
                    required: "Please enter an email adress",
                    minlength: "Email must be at least 5 characters long",
                    maxlength: "Please enter no more than 50 characters."
                },

                password: {
                    required: "Please enter a password",
                    minlength: "Password must be at least 5 characters long",
                    maxlength: "Please enter no more than 10 characters."
                }
            }
        });

        // validate signup form on keyup and submit
        $("#register-validation").validate({
            rules: {
                 name: {
                  required: true,
                  minlength: 2,
                  maxlength: 20
                },    
                 surname: {
                  required: true,
                  minlength: 2,
                  maxlength: 20
                },
                 birthday: {
                  required: true,
                  minlength: 2,
                  maxlength: 10
                },
                  email: {
                  required: true,
                  minlength: 5,
                  maxlength: 50,
                  email: true
                },
                  password: {
                  required: true,
                  minlength: 5,
                  maxlength: 10
                }
            },

            messages: {

                  name: {
                    required: "Please enter your name",
                    minlength: "Name must be at least 2 characters long",
                    maxlength: "Please enter no more than 20 characters."
                  },
                  surname: {
                    required: "Please enter your surname",
                    minlength: "Name must be at least 2 characters long",
                    maxlength: "Please enter no more than 20 characters."
                  },

                birthday: {
                    required: "Please enter your birthday ",
                    minlength: "Birthday must be at least 5 characters long",
                    maxlength: "Please enter no more than 10 characters."
                },

                email: {
                    required: "Please enter your email adress",
                    minlength: "Email must be at least 5 characters long",
                    maxlength: "Please enter no more than 50 characters."
                },
                password: {
                    required: "Please enter a password",
                    minlength: "Password must be at least 5 characters long",
                    maxlength: "Please enter no more than 10 characters."
                }
            }
        });
  
   $("#birthday").datepicker({
        dateFormat: 'yy-mm-dd',
        inline: true,
        changeMonth: true,
        changeYear: true,
        maxDate:0,
        yearRange: "-50:+0", // last 120 years
        showButtonPanel: true
  });
});

</script>
<!-- Including JS Content -->
<?php echo file_get_contents('admin/assets/js_bottom_front.php');?>

</body>
</html>