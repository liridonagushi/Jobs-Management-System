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
$category=$dbj->query('SELECT * FROM category_expertises WHERE id_cat_expertise="'.$_GET['id_cat_expertise'].'"');

$row_category=$category->fetch(PDO::FETCH_ASSOC);

login_oneadmin();

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

    <div class="text-header">Update a Category</div>
      <section class="module">
      <hr class="divider">

        <div class="row">

        <!-- Form inserting the details  -->
          <form id="form-validation" action="post_upd_category.php" method="post">
          <input type="hidden" name="id_cat_expertise" value="<?php echo $_GET['id_cat_expertise'];?>">

            <div class="form-group col-sm-12">
              <label class="control-label">Expertise Category</label>
              <input type="text"  name="expertise_category" id="expertise_category" value="<?php echo $row_category['expertise_category'];?>" class="form-control" placeholder="Job expertise_category*">
            </div>

            <div class="form-group col-sm-12 ">
              <label class="control-label">Category Active ?</label>
              <p><?php echo checkbox('active', $row_category['active']);// Checkbox: name and value?></p>
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
                
                  expertise_category: {
                  required: true,
                  minlength: 2,
                  maxlength: 80
                }
            },

            messages: {

                expertise_category: {
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