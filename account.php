<?php
// Including functions
require_once('admin/assets/include/functions.php');

// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('admin/assets/include/variables.php');

login_front();

$user=$dbj->query('SELECT * FROM users WHERE id_user="'.$_SESSION['jbms_front']['id_user'].'"');
$row_user=$user->fetch(PDO::FETCH_ASSOC);

switch ($_GET['collapse']) {
  case '1':
  $collapse1='in';
  $collapse2='';
  $collapse3='';
  $collapse4='';
  $collapse5='';
  break;
  case '2':
  $collapse2='in';
  $collapse1='';
  $collapse3='';
  $collapse4='';
  $collapse5='';
  break;
  case '3':
  $collapse3='in';
  $collapse1='';
  $collapse2='';
  $collapse4='';
  $collapse5='';
  break;
  case '4':
  $collapse4='in';
  $collapse1='';
  $collapse2='';
  $collapse3='';
  $collapse5='';
  break;
  case '5':
  $collapse5='in';
  $collapse1='';
  $collapse2='';
  $collapse3='';
  $collapse4='';
  break;

  default:
  $collapse1='in';
  $collapse2='';
  $collapse3='';
  $collapse4='';
  $collapse5='';
  break;
}
// Including header content
require_once('admin/assets/css_header_front.php');
?>

<body>

<?php echo include('top_menu.php');?>
<!-- Module showing results -->

<!--Top_content-->
<section id="index">
        <div class="row ">
            <div class="col-md-12">
                <div class="margintop100px">
                    <div class="fadeIn wow animated">
                      <h2>Account Settings </h2>
                      <hr class="divider-menu">
                    </div>
                </div>
            </div>
         </div>

    <div class="container">
        <div class="row">
            <h2><?php echo verify_profile($txt=true);?></h2>
        </div>
      <div class="row">
      <div id="accordion" class="panel-group">


      <!-- ACCORDIONS -->
        <div class="panel panel-default">

          <div class="panel-heading">
          <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#info"><i class="fa fa-info-circle fa-1x"></i> <?php echo languages($_SESSION['jbms_front']['lang_code'],91);//Details !?></a></h4>
          </div>

          <div id="info" class="panel-collapse collapse <?php echo $collapse1;?>">

            <div class="panel-body">

                <div class="form-group col-sm-12 ">
                <div class="row">
                   <form action="post_upd_settings.php" id="info-validation" name="form-email" method="POST">
                    <input type="hidden" name="target" value="info" />
                     <div class="row">
                      <div class="col-sm-4">
                        <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],86);//Name !?></label>
                        <input type="text" name="name" id="name" maxlength="80" value="<?php echo $row_user['name'];?>" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],86);//Name !?> *">
                      </div>
                      </div>
                     <div class="row">
                      <div class="col-sm-4">
                        <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],87);//Surname !?></label>
                        <input type="text" name="surname" id="surname" maxlength="80" value="<?php echo $row_user['surname'];?>" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],87);//Surname !?> *">
                      </div>
                      </div>
                     <div class="row">
                      <div class="col-sm-4 text-center">
                         <input type="submit" class="form-control btn btn-info" value="<?php echo languages($_SESSION['jbms_front']['lang_code'],71);//Update !?>">
                      </div>
                      </div>
                    </form>
                 </div>
               </div>
             </div>
           </div>
        </div>
      <!-- ACCORDIONS -->
        <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
           <a data-toggle="collapse" data-parent="#accordion" href="#email" class="collapsed"><i class="fa fa-envelope fa-1x"></i> Email</a>
          </h4>
        </div>
          <div id="email" class="panel-collapse collapse <?php echo $collapse2;?>">
            <div class="panel-body">

              <div class="form-group col-sm-12 text-left">
                <div class="row">
                   <form action="post_upd_settings.php" id="email-validation" name="form-email" method="POST">
                    <input type="hidden" name="target" value="email" />
                     <div class="row">
                        <div class="col-sm-4">
                          <input type="text" name="email" id="email" maxlength="80" value="<?php echo $row_user['email'];?>" class="form-control" placeholder="Email *">
                        </div>
                      </div>
                     <div class="row">
                      <div class="col-sm-4 text-center">
                         <input type="submit" class="form-control btn btn-info" value="<?php echo languages($_SESSION['jbms_front']['lang_code'],71);//Update !?>">
                      </div>
                      </div>
                    </form>
                 </div>
              </div>
              
            </div>
          </div>
        </div>

      <!-- ACCORDIONS -->
        <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
           <a data-toggle="collapse" data-parent="#accordion" href="#password" class="collapsed"><i class="fa fa-star fa-1x"></i> <?php echo languages($_SESSION['jbms_front']['lang_code'],88);//Password !?></a>
          </h4>
        </div>
          <div id="password" class="panel-collapse collapse <?php echo $collapse3;?>">
            <div class="panel-body">
              
              <div class="form-group col-sm-12 text-left">

                 <div class="row">

                  <form action="post_upd_settings.php" id="form-validation" name="form-validation" method="POST">
                  <input type="hidden" name="target" value="password" />

                   <div class="row">
                    <div class="col-sm-4">
                       <input type="text" name="password" id="password1" value="" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],93);//New Password !?>">
                    </div>
                    </div>

                   <div class="row">
                    <div class="col-sm-4">
                       <input type="text" name="new_password" id="new_password" value="" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],94);//Confirm New Password?>">
                    </div>
                    </div>

                   <div class="row">
                    <div class="col-sm-4 text-center">
                       <input type="submit" class="form-control btn btn-info" value="<?php echo languages($_SESSION['jbms_front']['lang_code'],71);//Update !?>">
                    </div>
                    </div>

                    </form>

                 </div>

              </div>

            </div>
            </div>

        </div>

        <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
           <a data-toggle="collapse" data-parent="#accordion" href="#language" class="collapsed"><i class="fa fa-sign-language fa-1x"></i> <?php echo languages($_SESSION['jbms_front']['lang_code'],119);//Language !?></a>
          </h4>
        </div>
          <div id="language" class="panel-collapse collapse <?php echo $collapse4;?>">
            <div class="panel-body">
              <div class="form-group col-sm-4 ">
                <form action="post_upd_settings.php" id="language-validation" name="language-validation" method="POST">
                 <input type="hidden" name="target" value="language" />
                  <select id="id_language" name="id_language" class="form-control" onchange="this.form.submit();">
                    <?php $lang=$dbj->query('SELECT * FROM languages ORDER BY id_language');
                    while($row_lang=$lang->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <option value="<?php echo $row_lang['id_language'];?>" <?php if($row_lang['id_language']==$row_user['id_language']){ ?> selected="selected" <?php } ?>><?php echo $row_lang['language'];?></option>
                    <?php } ?>
                </select>
                </form>
             </div>
            </div>
        </div>
      </div>

        <!-- Visiblity -->
        <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
           <a data-toggle="collapse" data-parent="#accordion" href="#privacy" class="collapsed"><i class="fa fa-lock fa-1x"></i> <?php echo languages($_SESSION['jbms_front']['lang_code'],89);//Privacy Policy !?></a>
          </h4>
        </div>
          <div id="privacy" class="panel-collapse collapse <?php echo $collapse5;?>">
            <div class="panel-body">

              <div class="form-group col-sm-12 ">
                <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],90);//Question Mark !?></label>
                <form action="post_upd_settings.php" id="form-validation" name="form-validation" method="POST">
                <input type="hidden" name="target" value="privacy" />
                <?php echo checkbox_autosubmit('public_profile', $row_user['public_profile']);// Checkbox: name and value?>
                </form>
             </div>
            </div>
        </div>
      </div>
  </div>
</section>

<!--Footer-->
<?php require_once('admin/footer.php');?>

<!-- JS library and scripts-->
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
                  password1: {
                  required: true,
                  minlength: 5,
                  maxlength: 10
                },
                  new_password: {
                  required: true,
                  maxlength: 10,
                  equalTo: "#password1"
                },
            },

            messages: {

                password1: {
                    required: "Please enter a password",
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
<!-- JS Slice Switching -->
<script type="text/javascript">
$(function(argument) {
  $('[type="checkbox"]').bootstrapSwitch();
})
</script>
<!-- Including Footer file -->
<?php  require_once('admin/assets/js_bottom_front.php');?>
</body>
</html>