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

//Including Variables
require_once('assets/include/variables.php');
// Query of the database
$company = $dbj->query('SELECT * FROM companies WHERE id_company="'.$_GET['id_company'].'" ORDER BY companies.id_company ASC');
$row_company=$company->fetch(PDO::FETCH_ASSOC);

$adress = $dbj->query('SELECT * FROM adresses WHERE id_adress="'.$row_company['id_adress'].'"');
$row_adress=$adress->fetch(PDO::FETCH_ASSOC);

// Including header content
require_once('assets/css_header.php');

switch ($_GET['collapse']) {
  case '1':
  $collapse1='in';
  $collapse2='';
  break;
  case '2':
  $collapse2='in';
  $collapse1='';
  break;

  default:
  $collapse2='in';
  $collapse1='';
  break;
}
?>
<body>

<!-- WRAPPER -->
<div class="container">
  <div class="text-header">Update Company <?php echo $row_company['company_sn'];?></div>
   <hr class="divider">
    <div class="row">
      <!-- ACCORDIONS -->
      <div id="accordion" class="panel-group">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#image" class="collapsed">Company Logo</a></h4>
          </div>

        <div id="image" class="panel-collapse collapse <?php echo $collapse1;?>">
          <div class="panel-body">

            <div class="col-sm-12">
                <div class="form-group col-sm-12 text-center">
                  <form action="post_upload_attachment.php" method="post" enctype="multipart/form-data">
                     <input type="hidden" name="target" value="logo_img">
                     <input type="hidden" name="destination" value="company">
                     <input type="hidden" name="collapse" value="1">
                     <input type="hidden" name="id_company" value="<?php echo $_GET['id_company'];?>">

                    <div class="profileimg-upload margintop20px">
                      <label for="file-input">
                        <?php if(empty($row_company['logo_img'])){ ?>
                        <div class="image-upload" style="cursor:pointer;"><i class="fa fa-file-image-o fa-2x" aria-hidden="true"></i></div>
                        <?php }else{ ?>
                        <img src="<?php echo $_SESSION['jbms_back']['directory_logo'].$row_company['logo_img'];?>" alt="client" />
                        <?php } ?>
                      </label>
                      <input id="file-input" type="file" name="logo_img" onchange="this.form.submit();"/>
                      <fieldset class="text-header">Company Logo</fieldset>
                    </div>
                  </form>
                </div>
            </div>
          </div>
      </div>
  </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#adress">Details</a></h4>
                </div>
                <div id="adress" class="panel-collapse collapse <?php echo $collapse2;?>">
                 <div class="panel-body">

                    <form id="form-validation" action="post_upd_company.php" method="post">
                    <input type="hidden" name="target" value="company_info">
                    <input type="hidden" name="id_company" value="<?php echo $_GET['id_company'];?>">
                    <input type="hidden" name="id_adress" value="<?php echo $row_company['id_adress'];?>">
                    <input type="hidden" name="id_country" value="<?php echo $row_adress['id_country'];?>">

                       <div class="form-group col-sm-6">
                          <label class="control-label">Company Name</label>
                          <input type="text"  name="company_name" id="company_name" value="<?php echo $row_company['company_name'];?>" class="form-control" placeholder="Company Name*">
                        </div>

                        <div class="form-group col-sm-6 ">
                           <label class="control-label">SN</label>
                            <input type="text" name="company_sn" id="company_sn"  value="<?php echo $row_company['company_sn'];?>" class="form-control" placeholder="SN*">
                        </div>

                        <div class="form-group col-sm-12 ">
                            <label class="control-label">Expertise Category</label>
                            <select id="id_cat_expertise" name="id_cat_expertise" class="form-control" required>
                                <option value="">Choose</option>
                            <?php $exp=$dbj->query('SELECT * FROM category_expertises WHERE active="1" ORDER BY id_cat_expertise');
                                  while($row_exp=$exp->fetch(PDO::FETCH_ASSOC)){
                            ?>
                              <option value="<?php echo $row_exp['id_cat_expertise'];?>" <?php if($row_exp['id_cat_expertise']==$row_company['id_cat_expertise']){ echo'selected';} ?>><?php echo $row_exp[''.$_SESSION['jbms_front']['lang_code'].'_expertise_category'];?></option>
                            <?php } ?>
                            </select>
                        </div>

                        <div class="form-group col-sm-6 ">
                           <label class="control-label">Number of Employees</label>
                           <input type="text" name="number_employees" id="number_employees"  value="<?php echo $row_company['number_employees'];?>" class="form-control" placeholder="SN*">
                        </div>

                        <div class="form-group col-sm-6 ">
                           <label class="control-label">Phone Number</label>
                           <input type="text" name="phone_number" id="phone_number"  value="<?php echo $row_company['phone_number'];?>" class="form-control" placeholder="Phone Number*">
                        </div>

                        <div class="form-group col-sm-4 ">
                         <label class="control-label">Adress</label>
                         <input type="text" name="adress"  value="<?php echo $row_adress['adress'];?>" class="form-control" placeholder="Adress*">
                        </div>

                        <div class="form-group col-sm-4 ">
                           <label class="control-label">Postal Code</label>
                           <input type="text" name="postal_code"  value="<?php echo $row_adress['postal_code'];?>" class="form-control" placeholder="Postal Code*">
                        </div>

                        <div class="form-group col-sm-4 ">
                          <label class="control-label">City</label>
                          <input type="text" name="city"  value="<?php echo $row_adress['city'];?>" class="form-control" placeholder="City*">
                        </div>

                        <div class="form-group col-sm-12 ">
                            <label class="control-label">Country </label>
                            <select id="id_country" name="id_country" class="form-control">
                                <option value="">Choose</option>
                            <?php $countries=$dbj->query('SELECT * FROM countries ORDER BY id_country');
                                  while($row_countries=$countries->fetch(PDO::FETCH_ASSOC)){
                            ?>
                              <option value="<?php echo $row_countries['id_country'];?>" <?php if($row_countries['id_country']==$row_adress['id_country']){ echo'selected';} ?>><?php echo $row_countries['country_name'];?> - <?php echo $row_countries['country_code'];?></option>
                            <?php } ?>
                            </select>
                        </div>

                        <div class="form-group col-sm-12 ">
                           <label class="control-label">Company Description</label>
                          <textarea name="company_description"  class="form-control" placeholder="Short words about the company *"><?php echo $row_company['company_description'];?></textarea>
                        </div>

                        <div class="form-group col-sm-12 ">
                           <label class="control-label">Company Active ?</label>
                           <?php echo checkbox('active', $row_company['active']);// Checkbox: name and value?>
                        </div>

                        <div class="form-group col-sm-12">
                          <input class="form-control btn-default" type="submit" value="UPDATE">
                        </div>
                  </form>
                  </div>
              </div>
           </div>
      </div>
	</div>
  
<!-- Showing alert messages -->
<?php echo log_message(); ?>

<!-- Alerts -->
<script type="text/javascript">
        function reset () {
            $("#toggleCSS").attr("href", "assets/css/alerts/alertify.default.css");
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
</script>

<script>
    $().ready(function() {
        // validate signup form on keyup and submit
        $("#form-validation").validate({
            rules: {
                    company_name: {
                    required: true,
                    minlength: 2
                },
                 id_cat_expertise: {
                    required: true,
                },
                 adress: {
                    required: true,
                    minlength: 2
                },
                 postal_code: {
                    required: true,
                    minlength: 2
                },
                 city: {
                    required: true,
                    minlength: 2
                },
                 id_country: {
                    required: true,
                },
                 number_employees: {
                    required: true,
                    number: true
                },
                 phone_number: {
                    required: true,
                    number: true, 
                    minlength: 9
                },
                company_sn: {
                    required: true,
                    minlength: 3,
                    remote: "check_company_sn.php?id_company=<?php echo $_GET['id_company'];?>&target=update"
                },
            },

            messages: {
               company_name: {
                    required: "Enter an adress",
                    minlength: "Company name must be at least 2 characters long !"
                },
                id_cat_expertise: {
                    required: "Enter an expertise area"
                },
                adress: {
                    required: "Enter an adress",
                    minlength: "Your password must be at least 5 characters long !"
                },
                postal_code: {
                    required: "Enter a postal code",
                    minlength: "Your postal code must be at least 2 characters !"
                },
                city: {
                    required: "Enter a city",
                    minlength: "Your city must be at least 2 characters !"
                },
                id_country: {
                    required: "Select a country !"
                },
                number_employees: {
                    required: "Number of people working in your company !"
                },
                phone_number: {
                   required: "Enter a phone number !",
                  minlength: "Phone number must be at least 9 characters !",
                },
                company_sn: { 
                    required: "Enter a company SN",
                    minlength: "SN must consist of at least 3 characters !",
                    remote: "This company SN already exists !"
                },
            }
        });
    });
</script>
              <!-- JS Slice Switching -->
    <script>
    $(function(argument) {
      $('[type="checkbox"]').bootstrapSwitch();
    })
    </script>

<!-- Including Footer file -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>