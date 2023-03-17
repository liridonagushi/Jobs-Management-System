<?php
// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('assets/include/variables.php');

// Including functions
include('assets/include/functions.php');

if (isset($_GET['logout']) && $_GET['logout']=='user') {
// Message type and text
set_message(2,'You signed out !');
}

if(!empty($_SESSION['jbms_back']['id_user'])){
  // Redirection to the page
  header('Location: index.php');
}

// Including header content
require_once('assets/css_header.php');
?>

<body>

<!--Top_content-->
<section id="module" class="margintop120px">

    <div class="container">
        <div class="row">
          <form name="search" action="post_search_results.php" method="POST">
          <input type="hidden" name="filename" value="<?php echo $filename;?>">
              <div class="col-sm-3 margin10px">
                <a href="sign.php" class="hyperlink">Login !</a> 
              </div>

              <div class="col-sm-3 margin10px">
                 <a class="hyperlink focused">New User</a> 
              </div>

              <div class="col-sm-3 margin10px">
                  <a href="forgot_pass.php" class="hyperlink">Forgot Password !</a> 
              </div>

          </form>
          
       </div>
       <hr class="divider-msg">
    </div>

    <div class="container">
     <div class="difbg">
      <div class="row">
        <div class="margintop20px">
            <form  id="form-validation" action="post_register.php" method="post">
              <input type="hidden" name="source" value="front">

                <div class="col-sm-6">
                  <div class="row">
                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="name" placeholder="Name *" name="name">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="surname" placeholder="Surname *" name="surname">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="birthday" name="birthday" placeholder="Birthday *">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="email" placeholder="Email *" name="email">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="password" placeholder="Password *" name="password">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                         <input type="submit" class="form-control btn btn-info" value="Agree &  Register">
                    </div>
                   </div>
                </div>
            </form>
    
            </div>
            </div>
        </div>
    </div>

</section>

<!-- JS library and scripts-->
<!-- Showing alert messages -->
<!-- Alerts -->

<script>
    $().ready(function() {
        // validate signup form on keyup and submit
        $("#form-validation").validate({
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
    });
</script>
<script type="text/javascript">

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
<!-- Including JS Content -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>