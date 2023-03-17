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

$user=$dbj->query('SELECT users.id_user, users.name, users.surname, users.birthday, users.email, users.password, users.date_registered, users.phone_number, users.id_expertise, users.id_expertise, users.id_adress, users.profile_img, users.id_gender, adresses.adress, adresses.city, adresses.postal_code, adresses.id_country, cv_lm.cv_code, cv_lm.lm_code FROM users LEFT JOIN cv_lm ON users.id_user=cv_lm.id_user LEFT JOIN adresses ON users.id_adress=adresses.id_adress LEFT JOIN countries ON adresses.id_country=countries.id_country LEFT JOIN expertises ON expertises.id_expertise=users.id_expertise LEFT JOIN category_expertises ON expertises.id_category=category_expertises.id_cat_expertise  WHERE users.id_user="'.$_SESSION['jbms_front']['id_user'].'"');
$row_user=$user->fetch(PDO::FETCH_ASSOC);

$file_attach=$dbj->query('SELECT cv_lm.id_cv, cv_lm.id_user, cv_lm.cv_code, cv_lm.lm_code FROM cv_lm WHERE cv_lm.id_user="'.$_SESSION['jbms_front']['id_user'].'"');
$file_job_cand=$file_attach->fetch(PDO::FETCH_ASSOC);

$working_exp = $dbj->query('SELECT DISTINCT working_experiences.id_experience, working_experiences.company_name, category_expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_category  AS expertise_category, expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_area AS expertise_area, working_experiences.description, working_experiences.start_date, working_experiences.end_date, working_experiences.active FROM working_experiences LEFT JOIN users ON working_experiences.id_user=users.id_user LEFT JOIN expertises ON working_experiences.id_expertise=expertises.id_expertise LEFT JOIN category_expertises ON expertises.id_category=category_expertises.id_cat_expertise WHERE working_experiences.id_user="'.$_SESSION['jbms_front']['id_user'].'"');

$diploma = $dbj->query('SELECT DISTINCT diploma_users.id_diploma_user, diploma_users.id_user, diploma_types.'.$_SESSION['jbms_front']['lang_code'].'_type_diploma AS type_diploma, diploma_users.title_diploma, levels_education.'.$_SESSION['jbms_front']['lang_code'].'_level_education AS level_education, diploma_users.date_started, diploma_users.date_finished, diploma_users.on_load FROM diploma_users LEFT JOIN diploma_types ON diploma_users.id_type_diploma=diploma_types.id_type_diploma  LEFT JOIN levels_education ON diploma_users.id_level_education=levels_education.id_level_education LEFT JOIN users ON diploma_users.id_user=users.id_user WHERE diploma_users.id_user="'.$_SESSION['jbms_front']['id_user'].'"');

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
$collapse2='';
$collapse3='';
$collapse4='';
$collapse1='';
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
                       <h2><?php echo languages($_SESSION['jbms_front']['lang_code'],29);//Profile?></h2>
                      <hr class="divider-menu">
                    </div>
                </div>
            </div>
         </div>

    <div class="container">
        <div class="row">
            <h2><?php echo verify_profile('profile');?></h2>
        </div>
      <div class="row">
      <!-- ACCORDIONS -->
      <div id="accordion" class="panel-group">
        <div class="panel panel-default">

          <div class="panel-heading">
          <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#image"><?php echo variable_exists($row_user['profile_img'],1);?><?php echo languages($_SESSION['jbms_front']['lang_code'],61);//Profile Image?></a></h4>
          </div>

          <div id="image" class="panel-collapse collapse <?php echo $collapse1;?>">

            <div class="panel-body">

              <div class="form-group col-sm-12 text-left">

                  <form action="post_upload_attachment.php" method="post" enctype="multipart/form-data">
                   <input type="hidden" name="target" value="profile_img">
                   <input type="hidden" name="destination" value="profile">
                   <input type="hidden" name="collapse" value="1">

                  <div class="image-upload">
                    <label for="file-input">
                      <?php if(!empty($row_user['profile_img'])){ ?>
                      <img src="<?php echo $_SESSION['jbms_front']['directory_profile_img'].$row_user['profile_img'];?>" alt="client">
                      <?php }else{ ?>
                      <img src="<?php echo $_SESSION['jbms_front']['directory_profile_img'];?>no_photo.jpg" class="borderstyle" width="80" alt="client">
                      <?php } ?>
                    </label>
                    <input id="file-input" type="file" name="profile_img" onchange="this.form.submit();"/>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
           <a data-toggle="collapse" data-parent="#accordion" href="#adress" class="collapsed"><?php echo variable_exists($row_user['birthday'], $row_user['id_adress']);?> <?php echo languages($_SESSION['jbms_front']['lang_code'],91);//Details !?></a>
          </h4>
        </div>
          <div id="adress" class="panel-collapse collapse <?php echo $collapse2;?>">
            <div class="panel-body">

            <form id="form-validation" action="post_upd_profile.php" method="post">
              <input type="hidden" name="id_adress" value="<?php echo $row_user['id_adress'];?>">
              <div class="col-sm-4">
                <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],92);//Birthday !?></label>
                <input type="text" id="birthday" name="birthday" value="<?php echo $row_user['birthday'];?>" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],92);//Birthday !?>*">
              </div>

              <div class="col-sm-4 ">
                <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],62);//Gender?></label>
                <select id="id_gender" name="id_gender" class="form-control">
                  <option value=""><?php echo languages($_SESSION['jbms_front']['lang_code'],65);//Choose?></option>
                  <?php if($row_user['id_gender']==1){?><option value="1" selected><?php echo languages($_SESSION['jbms_front']['lang_code'],63);//Male?></option><?php }else{ ?><option value="1"><?php echo languages($_SESSION['jbms_front']['lang_code'],63);//Male?></option><?php } ?>
                  <?php if($row_user['id_gender']==2){?><option value="2" selected><?php echo languages($_SESSION['jbms_front']['lang_code'],64);//Female?></option><?php }else{ ?><option value="2"><?php echo languages($_SESSION['jbms_front']['lang_code'],64);//Female?></option><?php } ?>
                </select>
              </div>

              <div class="col-sm-4">
                <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],66);//Phone Number?></label>
                <input type="text" name="phone_number" id="phone_number" value="<?php echo $row_user['phone_number'];?>" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],66);//Phone Number?>*">
              </div>
              
              <div class="col-sm-4 ">
                <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],67);//Adress?></label>
                <input type="text" name="adress" value="<?php echo $row_user['adress'];?>" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],67);//Adress?>*">
              </div>

              <div class="col-sm-4 ">
                <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],68);//Postal Code?></label>
                <input type="text" name="postal_code" value="<?php echo $row_user['postal_code'];?>" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],68);//Postal Code?>*">
              </div>

              <div class="col-sm-4 ">
                <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],69);//Postal Code?></label>
                <input type="text" name="city" value="<?php echo $row_user['city'];?>" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],69);//Postal Code?>*">
              </div>


              <div class="col-sm-12 ">
                <label class="control-label"><?php echo languages($_SESSION['jbms_front']['lang_code'],70);//Country?> *</label>
                <select id="id_country" name="id_country" class="form-control">
                <option value=""><?php echo languages($_SESSION['jbms_front']['lang_code'],65);//Choose?></option>
                <?php $countries=$dbj->query('SELECT * FROM countries ORDER BY id_country');
                while($row_countries=$countries->fetch(PDO::FETCH_ASSOC)){
                ?>
                <option value="<?php echo $row_countries['id_country'];?>" <?php if($row_countries['id_country']==$row_user['id_country']){ echo'selected';} ?>><?php echo $row_countries['country_name'];?> - <?php echo $row_countries['country_code'];?></option>
                <?php } ?>
                </select>
              </div>


              <div class="col-sm-12">
               <input type="submit" class="form-control btn btn-success" value="<?php echo languages($_SESSION['jbms_front']['lang_code'],71);//Update?>">
              </div>
            </form>

            </div>
          </div>
        </div>

        <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#education" class="collapsed"><?php echo variable_exists($diploma->rowCount(),$diploma->rowCount());?> <?php echo languages($_SESSION['jbms_front']['lang_code'],72);//Education?></a>
          </h4>
        </div>
          <div id="education" class="panel-collapse collapse <?php echo $collapse3;?>">
            <div class="panel-body">
              <table class="table table-inverse table-hover">
                  <thead>
                    <tr class="active">
                       <th width="20%">
                          <?php echo languages($_SESSION['jbms_front']['lang_code'],73);//Education Level?>
                       </th>
                       <th width="20%">
                         <?php echo languages($_SESSION['jbms_front']['lang_code'],74);//Diploma Type?>
                       </th>
                      <th width="20%">
                       <?php echo languages($_SESSION['jbms_front']['lang_code'],75);//Diploma Title?>
                      </th>
                      <th width="20%">
                       <?php echo languages($_SESSION['jbms_front']['lang_code'],37);//Starting Date?>
                      </th>
                       <th width="20%">
                        <?php echo languages($_SESSION['jbms_front']['lang_code'],46);//Finishing Date?>
                       </th>
                       <th width="2%">
                       </th>
                    </tr>
                  </thead>

                  <script type="text/javascript">
                    function confirm_remove(id_diploma_user, type_diploma){
                       if(confirm('<?php echo languages($_SESSION['jbms_front']['lang_code'],76);//Question mark?> '+type_diploma+' !')){
                      window.location.href='post_del_diploma.php?id_diploma_user='+id_diploma_user+'&type_diploma='+type_diploma+'';
                     }
                    }
                  </script>

                    <?php for ($i = 1; $i <= $diploma->rowCount(); $i++) {?>
                      <?php while($row_diploma=$diploma->fetch(PDO::FETCH_ASSOC)){ ?>
                    <tr>
                       <td>
                           <div class="margintop5px">
                           <?php echo $i++.') '.$row_diploma['level_education'];?>
                           </div>
                        </td>
                        <td>
                           <div class="margintop5px">
                           <?php echo $row_diploma['type_diploma'];?>
                           </div>
                        </td>
                        <td>
                           <div class="margintop5px">
                           <?php echo $row_diploma['title_diploma'];?>
                           </div>
                        </td>
                        <td>
                           <div class="margintop5px">
                           <?php echo $row_diploma['date_started'];?>
                           </div>
                        </td>
                        <td>
                        <?php if(empty($row_diploma['date_finished'])){?>
                           <div class="margintop5px">
                            <h4><span class="label label-warning"><?php echo languages($_SESSION['jbms_front']['lang_code'],77);//Attending?>!</span></h4>
                           </div>
                           <?php }else{ ?>
                           <div class="margintop5px">
                             <?php echo $row_diploma['date_finished'];?>
                           </div>
                           <?php } ?>
                        </td>
                        <td>
                          <div class="col-md-2">
                          <!-- Group buttons -->
                          <a class="dropdown-toggle btn btn-sm btn-success"  data-toggle="dropdown" href="#"><?php echo languages($_SESSION['jbms_front']['lang_code'],56);//Options?> <i class="fa fa-arrow-down fa-1x"></i></a>
                          <ul class="dropdown-menu" role="menu">

                          <li><a class="file_edu fancybox.iframe" href="upd_diploma.php?id_diploma_user=<?php echo $row_diploma['id_diploma_user'];?>"><i class="fa fa-edit fa-1x"></i> <?php echo languages($_SESSION['jbms_front']['lang_code'],71);//Update?></a></li>
                          
                          <li><a href="javascript:confirm_remove('<?php echo $row_diploma['id_diploma_user'];?>','<?php echo $row_diploma['type_diploma'];?>')"><i class="fa fa-remove fa-1x"></i> <?php echo languages($_SESSION['jbms_front']['lang_code'],78);//Remove Diploma?></a></li>
                          </ul>
                          </div>
                        </td>
                    </tr>
                   <?php } } ?>
                    <tr>
                      <td colspan="6">
                        <div class="col-sm-12 text-center"><a href="ins_diploma.php" class="file_edu fancybox.iframe btn btn-sm btn-success"><i class="fa fa-plus-circle fa-1x"></i> <?php echo languages($_SESSION['jbms_front']['lang_code'],79);//New Diploma?></a></div>
                      </td>
                    </tr>
                </table>
            </div>
          </div>
        </div>

        <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
           <a data-toggle="collapse" data-parent="#accordion" href="#work_exp" class="collapsed"><?php echo variable_exists($working_exp->rowCount(),1);?> <?php echo languages($_SESSION['jbms_front']['lang_code'],80);//Working Experience?></a>
          </h4>
        </div>
          <div id="work_exp" class="panel-collapse collapse <?php echo $collapse4;?>">
            <div class="panel-body">
                <table class="table table-inverse table-hover">
                  <thead>
                  <tr class="active">
                    <th width="20%"><?php echo languages($_SESSION['jbms_front']['lang_code'],38);//Company Name?></th>
                    <th width="20%"><?php echo languages($_SESSION['jbms_front']['lang_code'],48);//Company Name?></th>
                    <th width="30%"><?php echo languages($_SESSION['jbms_front']['lang_code'],81);//Company Name?></th>
                    <th width="15%"><?php echo languages($_SESSION['jbms_front']['lang_code'],37);//Starting Date?></th>
                    <th width="15%"><?php echo languages($_SESSION['jbms_front']['lang_code'],46);//Finish Date?></th>
                    <th width="2%"> </th>
                  </tr>
                  </thead>
                  <script type="text/javascript">
                    function confirm_remove_exp(id_experience, expertise){
                       if(confirm('<?php echo languages($_SESSION['jbms_front']['lang_code'],129);//Question Mark?> '+expertise+' !')){
                      window.location.href='post_del_experience.php?id_experience='+id_experience+'&expertise='+expertise+'';
                     }
                    }
                  </script>

                  <?php for ($i = 1; $i <= $working_exp->rowCount(); $i++) {?>
                    <?php while($row_work=$working_exp->fetch(PDO::FETCH_ASSOC)){ ?>
                  <tr>
                      <td>
                           <div class="margintop5px">
                         <?php echo $i++.') '.$row_work['company_name'];?>
                           </div>
                      </td>
 
                      <td>
                           <div class="margintop5px">
                           <?php echo $row_work['expertise_area'];?>
                           </div>
                      </td>
                      <td>
                           <div class="margintop5px">
                          <?php echo $row_work['description'];?>
                           </div>
                      </td>
                      <td>
                           <div class="margintop5px">
                           <?php echo $row_work['start_date'];?>
                           </div>
                      </td>
                      <td>
                        <?php if(empty($row_work['end_date'])){?>
                           <div class="margintop5px">
                            <h4><span class="label label-warning"><?php echo languages($_SESSION['jbms_front']['lang_code'],77);//Attending !?></span></h4>
                           </div>
                       <?php }else{ ?>
                           <div class="margintop5px">
                         <?php echo $row_work['end_date'];?>
                           </div>
                       <?php } ?>
                      </td>
                      <td align="center">
                          <div class="col-md-2 text-center">
                          <!-- Group buttons -->
                          <a class="dropdown-toggle btn btn-sm btn-success"  data-toggle="dropdown" href="#"><?php echo languages($_SESSION['jbms_front']['lang_code'],56);//Options !?> <i class="fa fa-arrow-down fa-1x"></i></a>
                          <ul class="dropdown-menu" role="menu">

                          <li><a class="work_exp fancybox.iframe" href="upd_experience.php?id_experience=<?php echo $row_work['id_experience'];?>"><i class="fa fa-edit fa-1x"></i> <?php echo languages($_SESSION['jbms_front']['lang_code'],71);//Update !?></a></li>
                          
                          <li><a href="javascript:confirm_remove_exp('<?php echo $row_work['id_experience'];?>','<?php echo $row_work['expertise_area'];?>')"><i class="fa fa-remove fa-1x"></i> <?php echo languages($_SESSION['jbms_front']['lang_code'],78);//Remove !?></a></li>
                          </ul>
                          </div>
                        </td>
                  </tr>
                 <?php } } ?>
                  <tr>
                    <td colspan="7">
                      <div class="col-sm-12 text-center"><a href="ins_experience.php" class="work_exp fancybox.iframe btn btn-sm btn-success"><i class="fa fa-plus-circle fa-1x"></i> <?php echo languages($_SESSION['jbms_front']['lang_code'],82);//New Experience !?></a></div>
                    </td>
                  </tr>
                </table>
            </div>
          </div>
        </div>

        <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#cvlm" class="collapsed"><?php echo variable_exists($row_user['cv_code'], $row_user['lm_code']);?>  <?php echo languages($_SESSION['jbms_front']['lang_code'],83);//Attachments !?></a>
          </h4>
        </div>

        <div id="cvlm" class="panel-collapse collapse <?php echo $collapse5;?>">
        <div class="panel-body">
                      <table class="table table-inverse">
                        <thead class="borderstyle">
                        <tr>
                          <td><?php echo variable_exists($file_job_cand['cv_code'],1);?> <?php echo languages($_SESSION['jbms_front']['lang_code'],84);//Curriculum Vitae !?> <?php if($file_job_cand['cv_code']){ ?> - <a href="<?php echo $_SESSION['jbms_front']['directory_pdf'].$file_job_cand['cv_code'];?>" target="_new"> <?php echo $file_job_cand['cv_code'];?><?php } ?></td>
                          <td align="center">
                              <div class="upload">
                                <form action="post_upload_attachment.php" method="post" enctype="multipart/form-data">
                                  <input type="hidden" name="target" value="cv_lm">
                                  <input type="hidden" name="destination" value="profile">
                                  <input type="hidden" name="collapse" value="5">
                                  <input type="file" name="cv_code" id="input01" onchange="this.form.submit();">
                                </form>
                              </div>
                          </td>
                        </tr>

                        <tr>
                          <td><?php echo variable_exists($file_job_cand['lm_code'],1);?> <?php echo languages($_SESSION['jbms_front']['lang_code'],85);//Motivation Letter !?> <?php if($file_job_cand['lm_code']){ ?> - <a href="<?php echo $_SESSION['jbms_front']['directory_pdf'].$file_job_cand['lm_code'];?>" target="_new"> <?php echo $file_job_cand['lm_code'];?><?php } ?></td>
                          <td align="center">
                                  <div class="upload">
                                    <form action="post_upload_attachment.php" method="post" enctype="multipart/form-data">
                                      <input type="hidden" name="target" value="cv_lm">
                                      <input type="hidden" name="destination" value="profile">
                                      <input type="hidden" name="collapse" value="5">
                                      <input type="file" name="lm_code" id="input02" onchange="this.form.submit();">
                                    </form>
                                  </div>
                          </td>
                        </tr>
                        </thead>
                      </table>
        </div>
      </div>
    </div>
  </div>
</section>
<!--Footer-->
<?php require_once('admin/footer.php');?>

<script type="text/javascript">

// Fancy Box Script
$(document).ready(function() {

$(".file_edu").fancybox({
  autoSize : false,
  width    : "55%",
  height   : "65%",
  'afterClose':function () {
       location.href = "profile.php?collapse=3";
  },
});

$(".work_exp").fancybox({
  autoSize : false,
  width    : "60%",
  height   : "90%",
  'afterClose':function () {
       location.href = "profile.php?collapse=4";
  },
});

});

</script>

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
        $("#form-validation").validate({
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
</script>
<!-- Including Footer file -->
<?php  require_once('admin/assets/js_bottom_front.php');?>
</body>
</html>