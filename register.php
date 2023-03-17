<?php
// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('admin/assets/include/variables.php');

// Including functions
include('admin/assets/include/functions.php');

if ($_GET['logout']=='user') {
// Message type and text
set_message(2,'You signed out !');
}

if(!empty($_SESSION['jbms_front']['id_user'])){
  // Redirection to the page
  header('Location: index.php');
}

// Including header content
require_once('admin/assets/css_header_front.php');
?>
<body>
<?php echo include('top_menu.php');?>

<!--Top_content-->
<section id="index">

  <div class="row ">
      <div class="col-lg-12">
          <div class="margintop100px">
              <div class="fadeIn wow animated">
                <h2>Browse your career</h2>
              </div>
               <hr class="divider-msg">
          </div>
      </div>
    </div>

  <div class="container">
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

                <div class="col-sm-8">
                  <div class="row">
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="name" placeholder="Name *" name="name">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="surname" placeholder="Surname *" name="surname">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                    <select id="id_offer" name="id_offer" class="form-control">
                      <option value="">Choose Offer</option>
                      <?php if($_GET['id_offer']==1){?><option value="1" selected>6 Months - 6 Euros</option><?php }else{ ?><option value="1">6 Months - 6 Euros</option><?php } ?>
                      <?php if($_GET['id_offer']==2){?><option value="2" selected>12 Months - 10 Euros</option><?php }else{ ?><option value="2">12 Months - 10 Euros</option><?php } ?>
                      </select>
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

<!--Top_content--> 
<!--Service-->

<!-- Including Footer -->
<?php require_once('admin/footer.php');?>

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
                  id_offer: {
                  required: true
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

                id_offer: {
                    required: "Please choose an offer"
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
<?php echo file_get_contents('admin/assets/js_bottom_front.php');?>

</body>
</html>