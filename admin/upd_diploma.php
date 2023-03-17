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

$diploma=$dbj->query('SELECT * FROM diploma_types WHERE id_type_diploma="'.$_GET['id_type_diploma'].'"');
$row_diploma=$diploma->fetch(PDO::FETCH_ASSOC);

// Including header content
require_once('assets/css_header.php');
?>
</head>
<body>

  <!-- WRAPPER -->
  <div class="container">

    <div class="text-header">Update Diploma</div>
    <hr class="divider">
      <div class="row">
          <!-- Form inserting the details  -->
         <form id="form-validation" action="post_upd_diploma.php" method="post">
              <input type="hidden" name="id_type_diploma" value="<?php echo $_GET['id_type_diploma'];?>" />

              <div class="form-group col-md-12">
                <label class="control-label">Diploma Title</label>
                <input type="text"  name="type_diploma" id="type_diploma" value="<?php echo $row_diploma['type_diploma'];?>" class="form-control" placeholder="ex. Engineer *">
              </div> 
              
              <div class="form-group col-md-12 ">
              <label class="control-label">Diploma Active ?</label>
              <p><?php echo checkbox('active', $row_diploma['active']);// Checkbox: name and value?></p>
             </div>

              <div class="form-group col-md-12">
                <input class="form-control btn-default" type="submit" value="UPDATE">
              </div>

            </form>
          </div>
  </div>
  <!-- JS Slice Switching -->
  <script>
  $(function(argument) {
  $('[type="checkbox"]').bootstrapSwitch();
  })
  </script>

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
</script>

<script>
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
                    required: "Please enter a diploma title !",
                    minlength: "Title must be at least 2 characters long",
                    maxlength: "Please enter no more than 80 characters."
                }
            }
        });
    });
</script>

<!-- Including Footer file -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>