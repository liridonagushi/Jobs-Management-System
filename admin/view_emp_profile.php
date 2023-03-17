<?php
// Including functions
require_once('assets/include/functions.php');

// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);
//Including Variables

// Name of the file !important
$filename=basename(__FILE__, '.php');

// Including Variables
require_once('assets/include/variables.php');

// Query of the database
$users = $dbj->query('SELECT * FROM users WHERE id_user="'.$_GET['id_user'].'"');
$row_user=$users->fetch(PDO::FETCH_ASSOC);

$working_exp = $dbj->query('SELECT DISTINCT working_experiences.id_experience, working_experiences.company_name, category_expertises.expertise_category, expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_area AS expertise_area, working_experiences.description, working_experiences.start_date, working_experiences.end_date, working_experiences.active FROM working_experiences LEFT JOIN users ON working_experiences.id_user=users.id_user LEFT JOIN expertises ON working_experiences.id_expertise=expertises.id_expertise LEFT JOIN category_expertises ON expertises.id_category=category_expertises.id_cat_expertise WHERE working_experiences.id_user="'.$_GET['id_user'].'"');

$diploma = $dbj->query('SELECT DISTINCT diploma_types.id_type_diploma, users.id_user, users.id_adress, diploma_users.title_diploma, diploma_types.type_diploma, diploma_users.date_started, diploma_users.date_finished, diploma_users.on_load FROM diploma_types LEFT JOIN diploma_users ON diploma_types.id_type_diploma=diploma_users.id_type_diploma LEFT JOIN users ON diploma_users.id_user=users.id_user WHERE diploma_users.id_user="'.$_GET['id_user'].'"');

$cv_lm = $dbj->query('SELECT id_user, cv_code, lm_code FROM cv_lm WHERE cv_lm.id_user="'.$_GET['id_user'].'" AND active=1 LIMIT 1');
$row_cvlm=$cv_lm->fetch(PDO::FETCH_ASSOC);

$adress = $dbj->query('SELECT * FROM adresses WHERE id_adress="'.$row_user['id_adress'].'"');
$row_adress=$adress->fetch(PDO::FETCH_ASSOC);

$country = $dbj->query('SELECT * FROM countries WHERE id_country="'.$row_adress['id_country'].'"');
$row_country=$country->fetch(PDO::FETCH_ASSOC);

// Including header content
require_once('assets/css_header.php');
?>

<body>

  <!-- WRAPPER -->
    <div class="text-header">Candidate <?php echo $row_user['email'];?></div>
    <section id="module">
            <div class="container-custom">
                <div class="row">

                        <!-- TABS -->
                        <div role="tabpanel">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#general" data-toggle="tab">General Information</a></li>
                                <li><a href="#work_exp" data-toggle="tab">Working Experience</a></li>
                                <li><a href="#education" data-toggle="tab">Education</a></li>
                                <li><a href="#cv" data-toggle="tab">Curriculum Vitae</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="general">
                                   <div class="form-group col-lg-12">

                                   <div class="form-group col-sm-6 text-left">
                                      <h6>Name</h6>
                                       <p><?php echo $row_user['name'];?></p>
                                     </div>

                                    <div class="form-group col-sm-6 text-left">
                                      <h6>Suranme</h6>
                                       <p><?php echo $row_user['surname'];?></p>
                                     </div>
                                     
                                     <div class="form-group col-sm-6 text-left">
                                      <h6>Email</h6>
                                       <p><?php echo $row_user['email'];?></p>
                                    </div>
                                    <div class="form-group col-sm-6 text-left">
                                      <h6>Adress</h6>
                                       <p><?php echo $row_adress['adress'];?></p>
                                     </div>
                                    <div class="form-group col-sm-6 text-left">
                                      <h6>City</h6>
                                       <p><?php echo $row_adress['city'];?></p>
                                    </div>
                                    <div class="form-group col-sm-6 text-left">
                                      <h6>Country</h6>
                                       <p><?php echo $row_country['country_name'];?></p>
                                    </div>
                                    <div class="form-group col-sm-6 text-left">
                                      <h6>Phone Number</h6>
                                       <p><?php echo $row_user['phone_number'];?></p>
                                     </div>
                                     </div>
                                </div>
                                <div class="tab-pane" id="work_exp">
                                   <div class="form-group col-lg-12">
                                <table class="table table-hover">
                                <thead>
                                <tr class="active">
                                   <th width="150px">
                                      Company Name
                                   </th>
                                   <th width="150px">
                                      Expertise Category
                                   </th>
                                  <th width="150px">
                                   Expertise Area
                                  </th>
                                  <th width="150px">
                                   Description
                                  </th>
                                   <th width="150px">
                                     Start Date
                                   </th>
                                                           <th width="150px">
                                     Finish Date
                                   </th>
                                </tr>
                                </thead>
                                <?php for ($i = 1; $i <= $working_exp->rowCount(); $i++) {?>
                                  <?php while($row_work=$working_exp->fetch(PDO::FETCH_ASSOC)){ ?>
                                <tr>
                                  
                                    <td>
                                       <?php echo $i++.') '.$row_work['company_name'];?>
                                    </td>
                                    <td>
                                       <?php echo $row_work['expertise_category'];?>
                                    </td>
                                    <td>
                                       <?php echo $row_work['expertise_area'];?>
                                    </td>
                                    <td>
                                       <?php echo $row_work['description'];?>
                                    </td>
                                    <td>
                                       <?php echo $row_work['start_date'];?>
                                    </td>
                                    <td>
                                       <?php echo $row_work['end_date'];?>
                                    </td>
                                </tr>
                               <?php } } ?>
                                  </table>
                                </div>
                                </div>
                                <div class="tab-pane" id="education">
                                   <div class="form-group col-lg-12">
                      <table class="table table-hover">
                                <thead>
                                <tr class="active">
                                   <th width="150px">
                                      Type Diploma
                                   </th>
                                  <th width="150px">
                                   Title
                                  </th>
                                  <th width="150px">
                                   Date Started
                                  </th>
                                   <th width="150px">
                                    Date Finished
                                   </th>
                        
                                </tr>
                                </thead>
                                <?php for ($i = 1; $i <= $diploma->rowCount(); $i++) {?>
                                  <?php while($row_diploma=$diploma->fetch(PDO::FETCH_ASSOC)){ ?>
                                <tr>
                                  
                                    <td>
                                       <?php echo $i++.') '.$row_diploma['type_diploma'];?>
                                    </td>
                                    <td>
                                       <?php echo $row_diploma['title_diploma'];?>
                                    </td>
                                    <td>
                                       <?php echo $row_diploma['date_started'];?>
                                    </td>
                                    <td>
                                       <?php echo $row_diploma['date_finished'];?>
                                    </td>
                                </tr>
                               <?php } } ?>
                                  </table>
                                 </div>
                              </div>

                                <div class="tab-pane" id="cv">
                                   <div class="form-group col-sm-6">
                                        <?php if(strlen($row_cvlm['cv_code'])>0){ ?>
                                              <pre><h6><a href="<?php echo  $_SESSION['jbms_back']['directory_pdf'].''.$row_cvlm['cv_code'];?>" target="_blank">Curriculum Vitae <i class="fa fa-download fa-1x"></i></a></h6></pre>
                                         <?php }else{ ?>
                                              <pre><h6 class="text-error">CV not uploaded Yet</h6></pre>
                                         <?php }?>
                                   </div>
                                   <div class="form-group col-sm-6">
                                        <?php if(strlen($row_cvlm['lm_code'])>0){ ?>
                                              <pre><h6><a href="<?php echo  $_SESSION['jbms_back']['directory_pdf'].''.$row_cvlm['lm_code'];?>" target="_blank">Letter Motivation <i class="fa fa-download fa-1x"></i></a></h6></pre>
                                         <?php }else{ ?>
                                              <pre><h6 class="text-error">Letter Motivation not uploaded Yet</h6></pre>
                                         <?php }?>
                                    </div>
                                </div>
                           </div>
                        <!-- /TABS -->
                    </div><!-- .col-* -->
                </div><!-- .row -->
            </div>
        </section>
    </div>

<!-- Including Footer file -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>