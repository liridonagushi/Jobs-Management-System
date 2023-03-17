<?php
include('admin/assets/include/functions.php');

$job=$dbj->query('SELECT job_offers.id_job, job_offers.job_sn, job_offers.job_title, companies.company_name, companies.company_description, companies.number_employees, job_offers.id_company, companies.company_sn, job_type.'.$_SESSION['jbms_front']['lang_code'].'_description, job_offers.job_description, job_offers.start_date, job_offers.closing_date, salary_ranges.salary_range, levels_experience.'.$_SESSION['jbms_front']['lang_code'].'_level_experience AS level_experience, levels_experience.years_experience, levels_education.'.$_SESSION['jbms_front']['lang_code'].'_level_education AS level_education, expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_area AS expertise_area, category_expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_category AS expertise_category FROM job_offers LEFT JOIN expertises ON job_offers.id_expertise=expertises.id_expertise LEFT JOIN category_expertises ON expertises.id_category=category_expertises.id_cat_expertise LEFT JOIN levels_education ON job_offers.id_level_experience=levels_education.id_level_education LEFT JOIN levels_experience ON job_offers.id_level_experience=levels_experience.id_level_experience LEFT JOIN companies ON job_offers.id_company=companies.id_company LEFT JOIN users AS employers ON (companies.id_employer=employers.id_user AND employers.admin_level="2") LEFT JOIN salary_ranges ON job_offers.id_salary=salary_ranges.id_salary LEFT JOIN job_type ON job_offers.job_type=job_type.id_job_type WHERE job_offers.id_job="'.$_GET['id_job'].'"');
$row_job=$job->fetch(PDO::FETCH_ASSOC);

$job_cand=$dbj->query('SELECT id_job, id_employee, motivation_words FROM job_candidatures WHERE id_job="'.$_GET['id_job'].'" AND id_employee="'.$_SESSION['jbms_front']['id_user'].'"');
$row_job_cand=$job_cand->fetch(PDO::FETCH_ASSOC);

$file_attach=$dbj->query('SELECT cv_lm.id_cv, cv_lm.id_user, cv_lm.cv_code, cv_lm.lm_code FROM cv_lm WHERE cv_lm.id_user="'.$_SESSION['jbms_front']['id_user'].'"');
$file_job_cand=$file_attach->fetch(PDO::FETCH_ASSOC);

$em_ver=$dbj->query('SELECT email_verification FROM users WHERE id_user="'.$_SESSION['jbms_front']['id_user'].'"');
$verify_user=$em_ver->fetch(PDO::FETCH_ASSOC);

if($job_cand->rowCount()>0){$disabledbutton='disabled'; $value='Waiting a Response'; $apply_header='Applied Already';}else{$disabledbutton=''; $value='Make an Application'; $apply_header='Apply';}

// if((strlen($file_job_cand['cv_code'])>0) AND (strlen($file_job_cand['lm_code'])>0)){$disabledbutton=''; $value='Make an Application';}else{$disabledbutton='disabled'; $value='Missing Attachments';}
// Including header content
require_once('admin/assets/css_header_front.php');
?>

<body>

<?php echo include('top_menu.php');?>
<!-- Module showing results -->
     

<section id="filejob">
  <div class="row ">
  <div class="fadeIn wow animated">
    <h2><?php echo languages($_SESSION['jbms_front']['lang_code'],39);//Job SN?>: <?php echo $row_job['job_sn']; ?></h2>
  </div>
   <hr class="divider-menu" />
  </div>

    <div class="container">
        <div class="row">
            <!-- TABS -->
            <div role="tabpanel">
              <ul class="nav nav-tabs" role="tablist">
                <li><a href="#viewjob" data-toggle="tab"><?php echo languages($_SESSION['jbms_front']['lang_code'],95);//Job Overview?></a></li>
                <li><a href="#viewcompany" data-toggle="tab"><?php echo languages($_SESSION['jbms_front']['lang_code'],96);//Company Overview?></a></li>
                <li class="active"><a href="#application" data-toggle="tab"><?php echo $apply_header;?> <?php echo variable_exists($file_job_cand['cv_code'], $file_job_cand['lm_code']);?></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane" id="viewjob">

                    <div class="col-sm-12 borderstyle padding5px">
                      <h5><?php echo languages($_SESSION['jbms_front']['lang_code'],10);//Job Title?></h5>
                        <?php echo $row_job['job_title'];?>
                    </div>

                     <div class="col-sm-12 borderstyle padding5px">
                      <h5><?php echo languages($_SESSION['jbms_front']['lang_code'],97);//Level Education Required?></h5>
                        <?php echo $row_job['level_education'];?> 
                    </div>

                     <div class="col-sm-6 borderstyle padding5px">
                      <h5><?php echo languages($_SESSION['jbms_front']['lang_code'],98);//Expertise Required?></h5>
                        <?php echo $row_job['expertise_category'];?>
                    </div>

                     <div class="col-sm-6 borderstyle padding5px">
                      <h5><?php echo languages($_SESSION['jbms_front']['lang_code'],99);//Expertise Required?></h5>
                        <?php echo $row_job['level_experience'];?>
                    </div>

                     <div class="col-sm-6 borderstyle padding5px">
                      <h5><?php echo languages($_SESSION['jbms_front']['lang_code'],37);//Starting Date?></h5>
                        <?php echo $row_job['start_date'];?>
                    </div>

                     <div class="col-sm-6 borderstyle padding5px">
                      <h5><?php echo languages($_SESSION['jbms_front']['lang_code'],100);//Closing Application?></h5>
                        <?php echo $row_job['closing_date'];?>
                    </div>

                     <div class="col-sm-12 borderstyle padding5px">
                      <h5><?php echo languages($_SESSION['jbms_front']['lang_code'],101);//Closing Application?></h5>
                        <?php echo $row_job['job_description'];?>
                    </div>

                </div>
                <div class="tab-pane" id="viewcompany">

                    <div class="col-sm-6 borderstyle padding5px">
                       <h5><?php echo languages($_SESSION['jbms_front']['lang_code'],38);//Company Name?></h5>
                        <?php echo $row_job['company_name'];?>
                    </div>


                    <div class="col-sm-6 borderstyle padding5px">
                      <h5><?php echo languages($_SESSION['jbms_front']['lang_code'],102);//Number of Employees?></h5>
                        <?php echo $row_job['number_employees'];?>
                    </div>

                    <div class="col-sm-6 borderstyle padding5px">
                      <h5><?php echo languages($_SESSION['jbms_front']['lang_code'],103);//Company Description?></h5>
                        <?php echo $row_job['company_description'];?>
                    </div>


                </div>

                  <div class="tab-pane active" id="application">
                     <div class="col-lg-12">
                        <?php if($_SESSION['jbms_front']['admin_level']==3){?>
                      <table class="table table-inverse">
                        <thead class="borderstyle">
                        <tr>
                          <td><?php echo variable_exists($file_job_cand['cv_code'], 1);?> CV <?php if($file_job_cand['cv_code']){ ?> - <a href="<?php echo $_SESSION['directory_pdf'].$file_job_cand['cv_code'];?>" target="_new"> <?php echo $file_job_cand['cv_code'];?><?php } ?></td>
                          <td align="center">
                            <?php if(!$job_cand->rowCount()>0){ ?>
                              <div class="upload">
                                <form action="post_upload_attachment.php" method="post" enctype="multipart/form-data">
                                  <input type="hidden" name="destination" value="file_job">
                                  <input type="hidden" name="target" value="cv_lm">
                                  <input type="hidden" name="id_job" value="<?php echo $_GET['id_job'];?>">
                                  <input type="file" name="cv_code" id="input01" onchange="this.form.submit();">
                                </form>
                              </div>
                            <?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td><?php echo variable_exists($file_job_cand['lm_code'], 1);?><?php echo languages($_SESSION['jbms_front']['lang_code'],85);//Motivation Letter?> <?php if($file_job_cand['lm_code']){ ?> - <a href="<?php echo $_SESSION['directory_pdf'].$file_job_cand['lm_code'];?>" target="_new"> <?php echo $file_job_cand['lm_code'];?><?php } ?></td>
                          <td align="center">
                            <?php if(!$job_cand->rowCount()>0){ ?>
                                  <div class="upload">
                                    <form action="post_upload_attachment.php" method="post" enctype="multipart/form-data">
                                      <input type="hidden" name="target" value="cv_lm">
                                      <input type="hidden" name="destination" value="file_job">
                                      <input type="hidden" name="id_job" value="<?php echo $_GET['id_job'];?>">
                                      <input type="file" name="lm_code" id="input02" onchange="this.form.submit();">
                                    </form>
                                  </div>
                            <?php } ?>
                          </td>
                        </tr>
                        </thead>
                        </table>
                       <form name="form-validation" id="form-validation" method="post" enctype="multipart/form-data" action="post_application_form.php">
                          <input type="hidden" name="destination" value="file_job">
                          <input type="hidden" name="id_job" value="<?php echo $_GET['id_job'];?>">
                          <input type="hidden" name="id_company" value="<?php echo $row_job['id_company'];?>">
                        <table class="table table-inverse">
                          <thead class="borderstyle">
                          <tr>
                            <td colspan="2">
                          <fieldset><input type="hidden" name="email_verfiication" value="<?php echo $verify_user['email_verification'];?>"></fieldset>
                          <fieldset><input type="hidden" name="cv_code" value="<?php echo $file_job_cand['cv_code'];?>"></fieldset>
                          <fieldset><input type="hidden" name="lm_code" value="<?php echo $file_job_cand['lm_code'];?>"></fieldset>
                              <p><h5><?php echo languages($_SESSION['jbms_front']['lang_code'],104);//Short Motivation Words (max. 800 characters)?> </h5></p>
                              <textarea <?php echo $disabledbutton;?> maxlength="800" id="field" onkeyup="countChar(this)" id="motivation_words" name="motivation_words" class="form-control classy-editor" rows="5" cols="180" placeholder="Motivation Words"><?php echo $row_job_cand['motivation_words'];?></textarea>
                              <div id="charNum"></div>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" align="center">
                               <input type="submit" class="btn btn-info" <?php echo $disabledbutton;?> value="<?php echo $value;?>">
                            </td>
                          </tr>
                          </thead>
                      </table>
                    </form>
                    
      <?php }else{ ?>
        <table height="150">
            <div class="container">
              <div class="col-sm-12 top_left_cont dispbl">
                <div class="row">
                   <a href="sign.php" class="hyperlink"><?php echo languages($_SESSION['jbms_front']['lang_code'],33);//Login?></a> 
                </div>
                <div class="row">
                   <a href="register.php" class="hyperlink"><?php echo languages($_SESSION['jbms_front']['lang_code'],35);//Login?></a> 
                </div>
                <div class="row">
                   <a href="forgot_pass.php" class="hyperlink"><?php echo languages($_SESSION['jbms_front']['lang_code'],36);//Forgot Pass !?></a> 
                </div>
              </div>
            </div>
        </table>
     <?php } ?>
      </div>

    </div>
    
  </div>

      <!-- /TABS -->

    </div><!-- .col-* -->

  </div><!-- .row -->

</div>

</section>
  <!-- Including Footer file -->
  <?php require_once('admin/footer.php');?>
<!-- JS library and scripts-->

<script type="text/javascript">
var maxLength = 800;
$('textarea').keyup(function() {
  var length = $(this).val().length;
  var length = maxLength-length;
  $('#charNum').text(length);
});
</script>

<script>
    $().ready(function() {
        // validate signup form on keyup and submit
        $("#form-validation").validate({
           ignore: "input[type='text']:hidden",
            rules: {
                 cv_code: {
                    required: true,
                    minlength: 1
                },
                  lm_code: {
                    required: true,
                    minlength: 1
                },
                  email_verfiication: {
                   required:true,
                   number:true,
                   min:1
                },
                motivation_words: {
                  required: true
                }
            },

            messages: {

                 cv_code: { 
                    required: "Please upload a CV !"
                },

                lm_code: {
                    required: "Please upload a Motivation Letter !"
                },            
               
                email_verfiication: {
                  required: "To continue your application, Please first verify your account through the email !",
                  minlength: "To continue your application, Please first verify your account through the email !",
                  min: "To continue your application, Please first verify your account through the email !"
                },

                motivation_words: {
                    required: "Please write a short motivation letter"
                }
            }
        });
    });
</script>

<!-- Including Footer file -->
<?php echo file_get_contents('admin/assets/js_bottom_front.php');?>
</body>
</html>
