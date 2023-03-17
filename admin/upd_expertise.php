<?php
// Including functions
require_once('assets/include/functions.php');

// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('assets/include/variables.php');


// Function to check logged in user
login_oneadmin();

$expertise=$dbj->query('SELECT expertises.id_expertise, expertises.'.$_SESSION['jbms_front']['lang_code'].'_expertise_area AS expertise_area, expertises.id_category, expertises.active FROM expertises LEFT JOIN category_expertises ON expertises.id_category=category_expertises.id_cat_expertise WHERE expertises.id_expertise='.$_GET['id_expertise'].'');
$row_expertise=$expertise->fetch(PDO::FETCH_ASSOC);

// Including header content
require_once('assets/css_header.php');
?>

<body>

  <!-- PRELOADER -->
  <div class="page-loader">
    <div class="loader">Loading...</div>
  </div> 

    <!-- WRAPPER -->
    <div class="container">

    <div class="text-header">Update an Expertise</div>
    <section class="module">
       <hr class="divider">

                <div class="row">

                <!-- Form inserting the details  -->
                 <form id="form-validation" action="post_upd_expertise.php" method="post">
                 <input type="hidden" name="id_expertise" value="<?php echo $_GET['id_expertise'];?>">
                 
                        <div class="form-group col-sm-12 ">
                            <label class="control-label">Expertise Category</label>
                            <select id="id_cat_expertise" name="id_cat_expertise" class="form-control">
                                <option value="">Choose</option>
                            <?php $exp=$dbj->query('SELECT * FROM category_expertises WHERE active="1" ORDER BY id_cat_expertise');
                                  while($row_exp=$exp->fetch(PDO::FETCH_ASSOC)){
                            ?>
                              <option value="<?php echo $row_exp['id_cat_expertise'];?>" <?php if($row_exp['id_cat_expertise']==$row_expertise['id_category']){ echo'selected';} ?>><?php echo $row_exp[''.$_SESSION['jbms_front']['lang_code'].'_expertise_category'];?></option>
                            <?php } ?>
                            </select>
                        </div>


                   <div class="form-group col-sm-12">
                      <label class="control-label">Expertises Area</label>
                      <input type="text"  name="expertise_area" id="expertise_area" value="<?php echo $row_expertise['expertise_area'];?>" class="form-control" placeholder="Job expertise_area*">
                    </div> 
          
                    <div class="form-group col-sm-12 ">
                       <label class="control-label">Company Active ?</label>
                       <p><?php echo checkbox('active', $row_expertise['active']);// Checkbox: name and value?></p>
                    </div>

                    <div class="form-group col-sm-12">
                      <input class="form-control btn-default" type="submit" value="Update">
                    </div>

                  </form>
                </div>
        </section>
    </div>

<!-- JS library and scripts-->
<!-- Showing alert messages -->
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
  
    $().ready(function() {
        // validate signup form on keyup and submit
        $("#form-validation").validate({
            rules: {
                
                  id_category: {
                  required: true
                },
                  expertise_area: {
                  required: true,
                  minlength: 2,
                  maxlength: 80
                }
            },

            messages: {

                id_category: {
                    required: "Please select a Category",
                },
                expertise_area: {
                    required: "Please enter a Category",
                    minlength: "Category must be at least 2 characters long",
                    maxlength: "Please enter no more than 80 characters."
                }
            }
        });
    });
</script>

<!-- Including JS Content -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>