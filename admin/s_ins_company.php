<?php
// Including functions
require_once('assets/include/functions.php');

// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('assets/include/variables.php');



?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- Latest compiled and minified JavaScript -->
<link href="assets/bootstrap/336/css/bootstrap.min.css" rel="stylesheet">
    
<!-- Icon Fonts -->
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<link href="assets/css/et-line-font.min.css" rel="stylesheet">

<!-- Template core CSS -->
<link href="assets/css/style.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css" />
<link rel="stylesheet" href="assets/css/template.css" />
<link rel="stylesheet" href="assets/css/alerts/alertify.core.css" />
<link rel="stylesheet" href="assets/css/alerts/alertify.default.css" id="toggleCSS" />

<!-- Java Script Libraries -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.js"></script>  
<script src="assets/js/alerts/alertify.min.js"></script>
<script src="assets/js/validation/jquery.validate.js"></script>
<script src="assets/js/validation/jquery.validate.min.js"></script>
  <script type="text/javascript" src="assets/bootstrap/336/js/bootstrap.min.js"></script>

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
                 id_expertise: {
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
                company_sn: {
                    required: true,
                    minlength: 2,
                    remote: "check_company_sn.php?target=insert"
                },
            },

            messages: {
               company_name: {
                    required: "Please provide an adress",
                    minlength: "Company name must be at least 2 characters long"
                },
                id_expertise: {
                    required: "Please provide an expertise area"
                },
                adress: {
                    required: "Please provide an adress",
                    minlength: "Your password must be at least 5 characters long"
                },
                postal_code: {
                    required: "Please provide a postal code",
                    minlength: "Your password must be at least 5 characters long"
                },
                city: {
                    required: "Please provide a city",
                    minlength: "Your password must be at least 5 characters long"
                },
                id_country: {
                    required: "Please select a country"
                },
                company_sn: { 
                    required: "Please enter a company SN",
                    minlength: "SN must consist of at least 3 characters",
                    remote: "This company SN already exists"
                },
            }
        });
    });
</script>

<?php echo log_message(); ?>
</head>
<body>

  <!-- PRELOADER -->
<!--   <div class="page-loader">
    <div class="loader">Loading...</div>
  </div>  -->

	<!-- WRAPPER -->
	<div class="wrapper">

    <div class="text-header">Insert a Company</div>
    <section class="module">
    <hr class="divider">
                <div class="row">
            <div class="col-sm-12">
                  
                    <form id="forma-validation" class="form-horizontal" action="post_ins_company.php" method="post">

                       <div class="form-group col-lg-12">
                          <label class="control-label">Company Name</label>
                          <input type="text"  name="company_name" id="company_name" value="" class="form-control" placeholder="Company Name*">
                        </div>

                        <div class="form-group col-lg-12 ">
                        <label class="control-label">SN</label>
                        <input type="text" name="company_sn" id="company_sn"  value="" class="form-control" placeholder="SN*">
                        </div>

                        <div class="form-group col-lg-12 ">
                            <label class="control-label">Expertise </label>
                            <select id="id_expertise" name="id_expertise" class="form-control" required>
                                <option value="">Choose</option>
                            <?php $exp=$dbj->query('SELECT * FROM expertises WHERE active="1" ORDER BY id_expertise');
                                  while($row_exp=$exp->fetch(PDO::FETCH_ASSOC)){
                            ?>
                              <option value="<?php echo $row_exp['id_expertise'];?>"><?php echo $row_exp['expertise_area'];?></option>
                            <?php } ?>
                            </select>
                        </div>

                        <div class="form-group col-lg-12 ">
                        <label class="control-label">Adress</label>
                        <input type="text" name="adress"  value="" class="form-control" placeholder="Adress*">
                        </div>

                        <div class="form-group col-lg-12 ">
                        <label class="control-label">Postal Code</label>
                        <input type="text" name="postal_code"  value="" class="form-control" placeholder="Postal Code*">
                        </div>

                        <div class="form-group col-lg-12 ">
                        <label class="control-label">City</label>
                        <input type="text" name="city"  value="" class="form-control" placeholder="City*">
                        </div>

                        <div class="form-group col-lg-12 ">
                            <label class="control-label">Country </label>
                            <select id="id_country" name="id_country" class="form-control">
                                <option value="">Choose</option>
                            <?php $countries=$dbj->query('SELECT * FROM countries ORDER BY id_country');
                                  while($row_countries=$countries->fetch(PDO::FETCH_ASSOC)){
                            ?>
                              <option value="<?php echo $row_countries['id_country'];?>"><?php echo $row_countries['country_name'];?> - <?php echo $row_countries['country_code'];?></option>
                            <?php } ?>
                            </select>
                        </div>

                        <div class="form-group col-lg-12">
                          <input class="form-control btn-default" type="submit" value="Update">
                        </div>
                  </form>
                </div>
                </div>
        </section>
	</div>
	<!-- /WRAPPER -->
  <script type="text/javascript" src="assets/js/custom.js"></script>

</body>
</html>