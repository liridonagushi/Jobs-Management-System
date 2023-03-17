<?php
// Including functions
require_once('assets/include/functions.php');

// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('assets/include/variables.php');



// Including header content
require_once('assets/css_header.php');
?>

<body>
    <!-- WRAPPER -->
  <div class="container">
    <div class="text-header">Insert a Company</div>
      <hr class="divider">
                    <form id="form-validation" name="form-validation" action="post_ins_company.php" method="post">
                      <input type="hidden" name="target" value="company_info">

                       <div class="form-group col-sm-6">
                          <label class="control-label">Company Name</label>
                          <input type="text" name="company_name" id="company_name" value="" class="form-control" placeholder="Company Name*">
                        </div>

                        <div class="form-group col-sm-6 ">
                           <label class="control-label">SN</label>
                            <input type="text" name="company_sn" id="company_sn"  value="" class="form-control" placeholder="SN*">
                        </div>

                        <div class="form-group col-sm-6 ">
                           <label class="control-label">Category</label>
                            <select name="id_cat_expertise" id="id_cat_expertise" class="form-control">
                            <option value="">Choose a category</option>
                            <?php $categories=$dbj->query('SELECT * FROM category_expertises ORDER BY id_cat_expertise');
                                  while($row_categories=$categories->fetch(PDO::FETCH_ASSOC)){
                            ?>
                              <option value="<?php echo $row_categories['id_cat_expertise'];?>"><?php echo $row_categories[''.$_SESSION['jbms_front']['lang_code'].'_expertise_category'];?></option>
                            <?php } ?>
                            </select>
                        </div>


                        <div class="form-group col-sm-6 ">
                           <label class="control-label">Number of Employees</label>
                           <input type="text" name="number_employees" id="number_employees"  value="" class="form-control" placeholder="Number of Employees *">
                        </div>

                        <div class="form-group col-sm-6 ">
                           <label class="control-label">Phone Number</label>
                           <input type="text" name="phone_number" id="phone_number"  value="" class="form-control" placeholder="Phone Number*">
                        </div>

                        <div class="form-group col-sm-6 ">
                         <label class="control-label">Adress</label>
                         <input type="text" name="adress"  value="" class="form-control" placeholder="Adress*">
                        </div>

                        <div class="form-group col-sm-6 ">
                           <label class="control-label">Postal Code</label>
                           <input type="text" name="postal_code"  value="" class="form-control" placeholder="Postal Code*">
                        </div>

                        <div class="form-group col-sm-6 ">
                          <label class="control-label">City</label>
                          <input type="text" name="city"  value="" class="form-control" placeholder="City*">
                        </div>

                        <div class="form-group col-sm-12 ">
                            <select name="id_country" id="id_country" class="form-control">
                            <option value="">Choose a country</option>
                            <?php $countries=$dbj->query('SELECT * FROM countries ORDER BY id_country');
                                  while($row_countries=$countries->fetch(PDO::FETCH_ASSOC)){
                            ?>
                              <option value="<?php echo $row_countries['id_country'];?>"><?php echo $row_countries['country_name'];?> - <?php echo $row_countries['country_code'];?></option>
                            <?php } ?>
                            </select>
                        </div>

                        <div class="form-group col-sm-12">
                          <input type="submit" class="form-control btn-default" value="Insert">
                        </div>
                  </form>
                </div>

    <!-- /section -->
<script type="text/javascript">
$(document).ready(function(){
    $('#id_cat_expertise').on('change',function(){
        var id_cat_expertise = $(this).val();
        if(id_cat_expertise){
            $.ajax({
                type:'POST',
                url:'deroul_expertises.php',
                data:'id_cat_expertise='+id_cat_expertise,
                success:function(html){
                    $('#id_expertise').html(html);
                }
            }); 
        }else{
            $('#id_expertise').html('<option value="">Select category</option>');
        }
    });
});

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
                    minlength: 6
                },
                company_sn: {
                    required: true,
                    minlength: 3,
                    remote: "check_company_sn.php?target=insert"
                }
            },

            messages: {
               company_name: {
                    required: "Enter an adress",
                    minlength: "Company name must be at least 2 characters long !"
                },
                id_cat_expertise: {
                    required: "Select a category"
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
                }
            }
        });
    });
</script>

<!-- Including Footer file -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>