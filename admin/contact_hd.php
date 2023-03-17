<?php
include('assets/include/functions.php');

// Verify connected admin
login_admin();

$user=$dbj->query('SELECT * FROM users WHERE id_user="'.$_SESSION['jbms_back']['id_user'].'"');
$row_user=$user->fetch(PDO::FETCH_ASSOC);

$expertise=$dbj->query('SELECT expertises.id_expertise, expertises.id_category FROM expertises LEFT JOIN category_expertises ON expertises.id_category=category_expertises.id_cat_expertise LEFT JOIN users ON expertises.id_expertise=users.id_expertise WHERE users.id_user="'.$_SESSION['jbms_back']['id_user'].'"');
$row_expertise=$expertise->fetch(PDO::FETCH_ASSOC);

$adress=$dbj->query('SELECT * FROM adresses WHERE id_adress="'.$row_user['id_adress'].'"');

$row_adress=$adress->fetch(PDO::FETCH_ASSOC);

// Including header content
require_once('assets/css_header.php');
?>

<body>

<!-- Including menu -->
<?php include('left_menu.php'); ?>

<!-- Content side content -->
<div class="content">

<!-- Search -->
<div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <h4 class="margintop40px"><b><i class="fa fa-file-o"></i> Contact Help Desk</b></h4>
      <hr class="divider-msg ">
    </div>
  </div>

<!-- Module showing results -->
<section id="indexnoborder">
    <div class="col-md-12">

				<div class="row">
					<div class="col-sm-12">

            <form id="form-validation" class="form-horizontal" action="send_email.php" method="post">
            <input type="hidden" name="target" value="update_employer">
            <input type="hidden" name="id_adress" value="<?php echo $row_user['id_adress'];?>">


             <div class="form-group col-sm-12">
                <label class="control-label">Object</label>
                <input type="text"  name="object_title" id="object_title" value="" class="form-control" placeholder="Object Title*">
            </div>

            <div class="form-group col-sm-12 ">
              <label class="control-label">Describe your request !</label>
              <textarea maxlength="800" id="message" onkeyup="countChar(this)" id="message" name="message" class="form-control classy-editor" rows="5" cols="180" placeholder="Describe your request !"></textarea>
              <div id="charNum"></div>
            </div>

             <div class="form-group col-sm-12">
              <input class="form-control btn-default" type="submit" value="Send request">
            </div>

          </form>
       </div>
	</div>
</div>
</section>
</div>

  <!-- Including Footer file -->
  <?php require_once('footer.php');?>
<!-- /content -->
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
</script>

<script>
    $().ready(function() {
        // validate signup form on keyup and submit
        $("#form-validation").validate({
            rules: {
              object_title: {
                  required: true,
                  minlength: 2,
                  maxlength: 80
                },
              message: {
                  required: true,
                  minlength: 20,
                  maxlength: 800
                }
            },

            messages: {
               object_title: {
                    required: "Please write your object title here !",
                    minlength: "Your object must have at least 2 characters "
                },

               message: {
                    required: "Please write your request here !",
                    minlength: "Your request must have at least 20 characters ",
                    maxlength: "Your message must have maximum 800 characters "
                }
            }
        });
    });
</script>

  <script type="text/javascript">
  var maxLength = 800;
  $('textarea').keyup(function() {
    var length = $(this).val().length;
    var length = maxLength-length;
    $('#charNum').text(length);
  });
  </script>

<!-- Including Footer file -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>