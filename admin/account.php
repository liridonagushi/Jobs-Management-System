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
           <a data-toggle="collapse" data-parent="#accordion" href="#imglogo" class="collapsed"><i class="fa fa-picture-o fa-1x"></i> Profile Image</a>
          </h4>
        </div>
          <div id="imglogo" class="panel-collapse collapse <?php echo $collapse1;?>">
            <div class="panel-body">

              <div class="form-group col-sm-12 text-center">
                <div class="row">
                  <form action="post_upload_attachment.php" method="post" enctype="multipart/form-data">
                   <input type="hidden" name="target" value="profile_img">
                   <input type="hidden" name="destination" value="profile">
                   <input type="hidden" name="collapse" value="1">

                  <div class="profileimg-upload margintop20px">
                    <label for="file-input">
                      <?php if(!empty($row_user['profile_img'])){ ?>
                      <img src="<?php echo $_SESSION['jbms_back']['directory_profile_img'].$row_user['profile_img'];?>" alt="client" />
                      <?php }else{ ?>
                      <img src="<?php echo $_SESSION['jbms_back']['directory_profile_img'];?>no_photo.jpg" class="borderstyle" width="220" alt="client" />
                      <?php } ?>
                    </label>
                    <input id="file-input" type="file" name="profile_img" onchange="this.form.submit();"/>
                    <fieldset class="text-header">Profile Image</fieldset>
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
          <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#info"><i class="fa fa-info-circle fa-1x"></i> Personal Info</a></h4>
          </div>

          <div id="info" class="panel-collapse collapse <?php echo $collapse2;?>">

            <div class="panel-body">
              <div class="form-group col-sm-12 ">
                <div class="row">
                   <form action="post_upd_settings.php" id="info-validation" name="form-email" method="POST">
                    <input type="hidden" name="target" value="info" />

                   <div class="row">
                     <div class="col-sm-4">
                        <label class="control-label">Gender</label>
                        <select name="id_gender" id="id_gender" class="form-control">
                        <option value="">Select Gender</option>
                        <?php $sex=$dbj->query('SELECT * FROM genders ORDER BY id_gender');
                        while($row_sex=$sex->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <option value="<?php echo $row_sex['id_gender'];?>" <?php if($row_sex['id_gender']==$row_user['id_gender']){ ?> selected <?php } ?>><?php echo $row_sex[''.$_SESSION['jbms_front']['lang_code'].'_sex'];?></option>

                        <?php } ?>
                        </select>
                    </div>

                     <div class="col-sm-4">
                        <label class="control-label">Name</label>
                        <input type="text" name="name" id="name" maxlength="80" value="<?php echo $row_user['name'];?>" class="form-control" placeholder="Name *">
                      </div>

                      <div class="col-sm-4">
                        <label class="control-label">Surname</label>
                        <input type="text" name="surname" id="surname" maxlength="80" value="<?php echo $row_user['surname'];?>" class="form-control" placeholder="Surname *">
                      </div>
                    </div>

                     <div class="row">
                      <div class="col-sm-6">
                        <label class="control-label">Birthday</label>
                       <input type="text" name="birthday" id="birthday" value="<?php echo $row_user['birthday'];?>" class="form-control" placeholder="Birthday *">
                      </div>

                      <div class="col-sm-6">
                        <label class="control-label">Phone Number</label>
                        <input type="text" name="phone_number" value="<?php echo $row_user['phone_number'];?>" class="form-control" placeholder="Phone Number *">
                      </div>
                    </div>

                     <div class="row">
                      <div class="col-sm-6">
                       <label class="control-label">Adress</label>
                       <input type="text" name="adress" value="<?php echo $row_adress['adress'];?>" class="form-control" placeholder="Adress *">
                      </div>

                      <div class="col-sm-6">
                        <label class="control-label">Postal Code</label>
                        <input type="text" name="postal_code" value="<?php echo $row_adress['postal_code'];?>" class="form-control" placeholder="Postal Code *">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                         <label class="control-label">City</label>
                         <input type="text" name="city" value="<?php echo $row_adress['city'];?>" class="form-control" placeholder="City *">
                      </div>
                      <div class="col-sm-6">
                        <label class="control-label">Country</label>
                        <select name="id_country" id="id_country" class="form-control">
                        <option value="">Select Country</option>
                        <?php $exp=$dbj->query('SELECT * FROM countries ORDER BY countries.country_name');
                        while($row_exp=$exp->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <option value="<?php echo $row_exp['id_country'];?>" <?php if($row_exp['id_country']==$row_adress['id_country']){ ?> selected <?php } ?>><?php echo $row_exp['country_name'];?> <?php echo $row_exp['country_code'];?></option>
                        <?php } ?>
                        </select>
                      </div>
                      </div>

                     <div class="row">
                        <div class="col-sm-12 text-center">
                           <input type="submit" class="form-control btn btn-info" value="Update Info">
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
          <div id="email" class="panel-collapse collapse <?php echo $collapse3;?>">
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
                         <input type="submit" class="form-control btn btn-info" value="Update Email">
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
           <a data-toggle="collapse" data-parent="#accordion" href="#password" class="collapsed"><i class="fa fa-star fa-1x"></i> Password</a>
          </h4>
        </div>
          <div id="password" class="panel-collapse collapse <?php echo $collapse4;?>">
            <div class="panel-body">
              
              <div class="form-group col-sm-12 text-left">

                 <div class="row">

                  <form action="post_upd_settings.php" id="form-validation" name="form-validation" method="POST">
                  <input type="hidden" name="target" value="password" />

                   <div class="row">
                    <div class="col-sm-4">
                       <input type="text" name="password" id="password1" value="" class="form-control" placeholder="New Password">
                    </div>
                    </div>

                   <div class="row">
                    <div class="col-sm-4">
                       <input type="text" name="new_password" id="new_password" value="" class="form-control" placeholder="Confirm New Password">
                    </div>
                    </div>

                   <div class="row">
                    <div class="col-sm-4 text-center">
                       <input type="submit" class="form-control btn btn-info" value="Update Password">
                    </div>
                    </div>

                    </form>
                 </div>
              </div>
            </div>
          </div>
        </div>

<?php if($_SESSION['jbms_back']['admin_level']==1){?>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
           <a data-toggle="collapse" data-parent="#accordion" href="#fanpage" class="collapsed"><i class="fa fa-lock fa-1x"></i> Fan Pages</a>
          </h4>
        </div>
          <div id="fanpage" class="panel-collapse collapse <?php echo $collapse5;?>">
            <div class="panel-body">

        <?php $page=$dbj->query('SELECT social_fanpages.id_fanpage, social_fanpages.company_name, social_fanpages.img_icon, social_fanpages.http_direction, social_fanpages.active FROM social_fanpages ORDER BY social_fanpages.id_fanpage DESC');
        ?>
        <div>
              <table class="table table-inverse table-hover">
                <thead>
                    <tr class="active">
                      <th>Show On Page</th>
                      <th>Company Name </th>
                      <th>Social Page Link</th>
                      <th>Social Icon</th>
                    </tr>
                </thead>
            <?php while($fanpage=$page->fetch(PDO::FETCH_ASSOC)){ ?>
              <form name="fanpage-insert" id="fanpage-insert" action="post_upd_settings.php" method="post">
                <input type="hidden" name="target" value="fanpage" />
                <input type="hidden" name="id_fanpage" value="<?php echo $fanpage['id_fanpage'];?>" />
                  <tr>
                  <?php if($fanpage['active']==1){ ?>
                    <td><input type="submit" name="showpage" class="form-control btn btn-danger" value="hide"></td>
                    <?php }else{ ?>
                    <td><input type="submit" name="showpage" class="form-control btn btn-success" value="show"></td>
                    <?php } ?>
                    <td><?php echo $fanpage['company_name'];?></td>
                    <td><input type="text" value="<?php echo $fanpage['http_direction'];?>" name="http_direction" class="form-control" onchange="this.form.submit()"></a></td>
                    <td><?php echo $fanpage['img_icon'];?></td>
                  </tr>
              </form>
              <?php } ?>
           </table>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

       <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
           <a data-toggle="collapse" data-parent="#accordion" href="#privacy" class="collapsed"><i class="fa fa-lock fa-1x"></i> Privacy Policy</a>
          </h4>
        </div>
          <div id="privacy" class="panel-collapse collapse <?php echo $collapse6;?>">
            <div class="panel-body">
              <div class="form-group col-sm-12 ">
                <label class="control-label">Let the world see my profile ?</label>
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
                  password1: {
                  required: true,
                  minlength: 5,
                  maxlength: 10
                },
                  new_password: {
                  required: true,
                  minlength: 5,
                  maxlength: 10,
                  equalTo: "#password1"
                }
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
                    required: "Please enter a Fan Page"
                },

                http_direction: {
                    required: "Please enter the link of your fanpage",
                    minlength: "Text must be between 2 and 10 characters",
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