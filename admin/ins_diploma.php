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

// Including header content
require_once('assets/css_header.php');
?>

<body>
    <!-- WRAPPER -->
    <div class="container">

    <div class="text-header">Insert a Diploma</div>
    <section class="module">
    <hr class="divider">

                <div class="row">

                <!-- Form inserting the details  -->
                 <form id="form-validation" action="post_ins_diploma.php" method="post">

                       <div class="form-group col-md-12">
                          <label class="control-label">Type Diploma</label>
                          <input type="text"  name="type_diploma" id="type_diploma" value="" maxlength="50" class="form-control" placeholder="ex. Science in Computer Engineering *">
                        </div> 

                    <div class="form-group col-md-12">
                      <input class="form-control btn-default" type="submit" value="INSERT">
                    </div>

                  </form>
                </div>
        </section>
    </div>

<script type="text/javascript">
    $().ready(function() {
        // validate signup form on keyup and submit
        $("#form-validation").validate({
            rules: {

                  type_diploma: {
                  required: true,
                  minlength: 2,
                  maxlength: 50
                }
            },

            messages: {

                type_diploma: {
                    required: "Please enter a diploma type",
                    minlength: "Title must be at least 2 characters long",
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