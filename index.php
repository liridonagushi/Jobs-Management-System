<?php
// Page destination
$filename='lst_recent_jobs';

// Name of module
$module='lst_recent_jobs.php';

include('admin/assets/include/functions.php');

//Including Variables
require_once('admin/assets/include/variables.php');

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
                      <h2><?php echo languages($_SESSION['jbms_front']['lang_code'],9); //Search Jobs?></h2>
                    </div>
                     <hr class="divider-msg">
                </div>
            </div>
        </div>

    <div class="container">
      <div class="row">
          <form name="search" action="post_search_results.php" method="POST">
          <input type="hidden" name="filename" value="<?php echo $filename;?>">
          <input type="hidden" name="module" value="<?php echo $module;?>">
              <div class="col-md-3">
                <input type="text" name="job_title" value="<?php echo $_SESSION[$filename]['job_title'];?>" class="form-control" placeholder="Job Title">
              </div>

              <div class="col-md-3">
                  <select id="id_category" name="id_category" class="form-control">
                      <option value=""><?php echo languages($_SESSION['jbms_front']['lang_code'],34); //All?></option>
                      <?php $exp=$dbj->query('SELECT * FROM category_expertises WHERE active=1 ORDER BY id_cat_expertise');
                      while($row_exp=$exp->fetch(PDO::FETCH_ASSOC)){
                      ?>
                      <option value="<?php echo $row_exp['id_cat_expertise'];?>" <?php if($row_exp['id_cat_expertise']==$_SESSION[$filename]['id_category']){ ?> selected="selected" <?php } ?>><?php echo $row_exp[''.$_SESSION['jbms_front']['lang_code'].'_expertise_category'];?></option>
                      <?php } ?>
                  </select>
              </div>

              <div class="col-md-3">
                  <input type="submit" name="name" class="form-control btn-default" value="<?php echo languages($_SESSION['jbms_front']['lang_code'],11);//Search?>">
              </div>
              <div class="col-md-3">
                  <input type="submit" name="reset" class="form-control btn-default" value="<?php echo languages($_SESSION['jbms_front']['lang_code'],12);//RESET?>">
              </div>
          </form>
          
       </div>
    </div>

<?php if(empty($_SESSION['jbms_front']['id_user'])){ ?>
  <div class="container">
   <div class="border margintop60px difbg">
    
    <div class="row">

    <!-- Pricing Tables-->
    <div class="col-md-5">
      <div class="pricing hover-effect">
        <div class="pricing-head">
          <h3><?php echo languages($_SESSION['jbms_front']['lang_code'],13); //Job Seeker?> <span>
          <?php echo languages($_SESSION['jbms_front']['lang_code'],14); //Browse Unlimited Jobs?> </span>
          </h3>
        </div>
        <ul class="pricing-content list-unstyled">
          <li>
            1000+ Job Applications
          </li>
          <li>
            Tenders For Companies
          </li>
          <li>
            Assistance
          </li>
        </ul>
        <div class="pricing-footer">
          <a href="sign.php?id_offer=1" class="btn yellow-crusta">
          Browse
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-2">
    </div>
 <div class="col-md-5">
      <div class="pricing hover-effect">
        <div class="pricing-head">
          <h3><?php echo languages($_SESSION['jbms_front']['lang_code'],15); //Job Seeker?> <span>
          <?php echo languages($_SESSION['jbms_front']['lang_code'],16); //Browse Qualified Employees?> </span>
          </h3>
        </div>
        <ul class="pricing-content list-unstyled">
          <li>
            <?php echo languages($_SESSION['jbms_front']['lang_code'],21); // Publish Unlimited Jobs ?>
          </li>
          <li>
            <?php echo languages($_SESSION['jbms_front']['lang_code'],22); // Receive Candidatures  ?>
          </li>
          <li>
           <?php echo languages($_SESSION['jbms_front']['lang_code'],23); // Contact Employees?>
          </li>
        </ul>
        <div class="pricing-footer">
          <a href="admin/sign.php" class="btn yellow-crusta" target="_New" >
          Browse
          </a>
        </div>
      </div>
    </div>

            </div>
        </div>
    <?php } ?>
    </div>
</section>


<!--Top_content--> 
<!--Service-->

<!-- Including Footer -->
<?php require_once('admin/footer.php');?>

<!-- JS library and scripts-->
<script>
    $().ready(function() {
        // validate signin form on key up and submit
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
                  maxlength: 50
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
                    maxlength: "Please enter no more than 80 characters."
                }
            }
        });
    });
</script>

<!-- Including Footer file -->
<?php echo file_get_contents('admin/assets/js_bottom_front.php');?>

</body>
</html>