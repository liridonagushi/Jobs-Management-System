<?php
// Including functions
require_once('assets/include/functions.php');

// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('assets/include/variables.php');

  // Verify connected admin
  login_twoadmin();

  $user=$dbj->query('SELECT * FROM users WHERE id_user="'.$_SESSION['jbms_back']['id_user'].'"');
  $row_user=$user->fetch(PDO::FETCH_ASSOC);

  $expertise=$dbj->query('SELECT expertises.id_expertise, expertises.id_category FROM expertises LEFT JOIN category_expertises ON expertises.id_category=category_expertises.id_cat_expertise LEFT JOIN users ON expertises.id_expertise=users.id_expertise WHERE users.id_user="'.$_SESSION['jbms_back']['id_user'].'"');
  $row_expertise=$expertise->fetch(PDO::FETCH_ASSOC);

  $adress=$dbj->query('SELECT * FROM adresses WHERE id_adress="'.$row_user['id_adress'].'"');
  $row_adress=$adress->fetch(PDO::FETCH_ASSOC);

// Including header content
require_once('assets/css_header.php');

switch ($_GET['collapse']) {
case '1':
$collapse1='in';
$collapse2='';
$collapse3='';
$collapse4='';
$collapse5='';
$collapse6='';
break;
case '2':
$collapse2='in';
$collapse1='';
$collapse3='';
$collapse4='';
$collapse5='';
$collapse6='';
break;
case '3':
$collapse3='in';
$collapse1='';
$collapse2='';
$collapse4='';
$collapse5='';
$collapse6='';
break;
case '4':
$collapse4='in';
$collapse1='';
$collapse2='';
$collapse3='';
$collapse5='';
$collapse6='';
break;
case '5':
$collapse5='in';
$collapse2='';
$collapse3='';
$collapse4='';
$collapse1='';
$collapse6='';
break;
case '6':
$collapse6='in';
$collapse2='';
$collapse3='';
$collapse4='';
$collapse1='';
$collapse5='';
break;
default:
$collapse1='in';
$collapse2='';
$collapse3='';
$collapse4='';
$collapse5='';
$collapse6='';
break;
}
?>
<body>

<!-- Including menu -->
<?php   include('left_menu.php'); ?>

<!-- Content side wrapper -->
<div class="content">

<!-- Search -->
<div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <h4 class="margintop40px"><b><i class="fa fa-file-o"></i> Update Account Settings</b></h4>
    </div>
  </div>
</div>
      <hr class="divider-msg">

<section id="index">
    <div class="container">
      <div class="row">
      <div id="accordion" class="panel-group">


    <!-- ACCORDIONS -->
        <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
           <a data-toggle="collapse" data-parent="#accordion" href="#imglogo"><i class="fa fa-file-excel-o fa-1x"></i> Import Users</a>
          </h4>
        </div>
          <div id="imglogo" class="panel-collapse collapse <?php echo $collapse1;?>">
            <div class="panel-body">
            <a href="assets/attachments/structure_users.csv" class="difbg3 text-success" target="_new">File Structure <i class="fa fa-download"></i></a>
              <div class="form-group col-sm-12 text-center">
                <div class="row">
                  <div class="col-md-12">
                  <form name="import_users" action="post_import_data.php" method="post" enctype="multipart/form-data">
                   <input type="hidden" name="target" value="import_users">
                   <input type="hidden" name="destination" value="import_data">
                   <input type="hidden" name="collapse" value="1">
                    <div class="logo-upload margintop20px">
                      <label for="file-input">
                         <img src="<?php echo $_SESSION['jbms_back']['images'];?>import-file-icon.png" width="220" alt="client" />
                      </label>
                      <input id="file-input" type="file" name="import_users" onchange="this.form.submit();"/>
                      <fieldset class="text-header">Import CSV File</fieldset>
                    </div>
                   </form>
                   </div>
                 </div>
              </div>
            </div>
          </div>
        </div>

      <!-- ACCORDIONS -->
        <div class="panel panel-default">
          <div class="panel-heading">
          <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#info" class="collapsed"><i class="fa fa-file-excel-o fa-1x"></i> Import Companies</a></h4>
          </div>
          <div id="info" class="panel-collapse collapse <?php echo $collapse2;?>">
            <div class="panel-body">
            <a href="assets/attachments/structure_companies.csv" class="difbg3 text-success" target="_new">File Structure <i class="fa fa-download"></i></a>
               <div class="form-group col-sm-12 text-center">
                <div class="row">
                  <form name="import_companies" action="post_import_data.php" method="post" enctype="multipart/form-data">
                  <div class="col-md-12">
                   <input type="hidden" name="target" value="import_companies">
                   <input type="hidden" name="destination" value="import_data">
                   <input type="hidden" name="collapse" value="1">
                    <div class="logo-upload margintop20px">
                      <label for="file-input">
                         <img src="<?php echo $_SESSION['jbms_back']['images'];?>import-file-icon.png" width="220" alt="client" />
                      </label>
                      <input id="file-input" type="file" name="import_companies" onchange="this.form.submit();"/>
                      <fieldset class="text-header">Import CSV File</fieldset>
                    </div>
                   </form>
                   </div>
                 </div>
               </div>
              </div>
           </div>
        </div>
  </section>
  </div>

  <!-- Including Footer file -->
  <?php require_once('footer.php');?>
<!-- /WRAPPER -->
</div>
<!-- JS library and scripts-->
<!-- JS Slice Switching -->
<script type="text/javascript">
    $().ready(function() {
      $("#birthday").datepicker({
      dateFormat: "yy-mm-dd",
      inline: true,
      maxDate:"-12 Years",
      changeYear: true,
      changeMonth: true,
      showButtonPanel: true
    });
        // validate signup form on keyup and submit
        $("#info-validation").validate({
            rules: {
                 birthday: {
                  required: true,
                  minlength: 2,
                  maxlength: 10
                },
                 phone_number: {
                  required: true,
                  minlength: 2,
                  maxlength: 10
                },
                 adress: {
                  required: true,
                  minlength: 5,
                  maxlength: 80
                },
                 postal_code: {
                  required: true,
                  minlength: 3,
                  maxlength: 8
                },
                 city: {
                  required: true,
                  minlength: 3,
                  maxlength: 20
                },
                id_country: {
                  required: true
                },
                id_gender: {
                  required: true
                }
            },

            messages: {

                birthday: {
                    required: "Please enter your birthday ",
                    minlength: "Birthday must be at least 5 characters long",
                    maxlength: "Please enter no more than 10 characters."
                },
                phone_number: {
                    required: "Please enter your phone number",
                    minlength: "Phone number must be at least 5 characters long",
                    maxlength: "Please enter no more than 80 characters."
                },
               adress: {
                    required: "Please enter your phone number",
                    minlength: "Phone number must be at least 5 characters long",
                    maxlength: "Please enter no more than 10 characters."
                },
               postal_code: {
                  required: "Please enter your postal code",
                  minlength: "Postal Code must be at least 3 characters long",
                  maxlength: "Please enter no more than 8 characters."
                },
               city: {
                  required: "Please enter your city",
                  minlength: "City must be at least 3 characters long",
                  maxlength: "Please enter no more than 20 characters."
                },
               id_country: {
                  required: "Please choose your country",
                },
                id_gender: {
                    required: "Please choose your gender"
                }
            }
        });
    });

    $().ready(function() {
        // validate signup form on keyup and submit
        $("#email-validation").validate({
            rules: {
                  email: {
                  required: true,
                  minlength: 5,
                  maxlength: 50,
                  remote: "check_email.php"
                  // email: true
                }
            },

            messages: {

                email: {
                    required: "Please enter an email adress",
                    minlength: "Email must be at least 5 characters long",
                    maxlength: "Please enter no more than 50 characters.",
                    remote: "This email already exists !"
                }
            }
        });

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
                }
            },

            messages: {

                password: {
                    required: "Please enter a password",
                    minlength: "Password must be between 5 and 10 characters",
                    maxlength: "Please enter no more than 10 characters."
                },
                new_password: {
                    required: "Please enter the same password"
                }
            }
        });
    
        // validate signup form on keyup and submit
        $("#fanpage-insert").validate({
            rules: {
                  id_fanpage: {
                  required: true
                },
                  http_direction: {
                  required: true,
                  minlength: 2,
                  maxlength: 10
                }
            },

            messages: {
                id_fanpage: {
                    required: "Please enter a password"
                },

                http_direction: {
                    required: "Please enter the link of your fanpage",
                    minlength: "Password must be between 2 and 10 characters",
                    maxlength: "Please enter no more than 10 characters."
                }
            }
        });
    });

    </script>

<!-- Including Footer file -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>