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

if(empty($_GET['job_sn'])){
 $jobsn='';
}else{
  $jobsn='Job SN: '.$_GET['job_sn'].'';
}
$send_email=$dbj->query('SELECT users.id_user, users.email, users.name, users.surname FROM users WHERE users.id_user="'.$_GET['id_user'].'"');
$row_send_email=$send_email->fetch(PDO::FETCH_ASSOC);

$emails=$dbj->query('SELECT DISTINCT from_user.id_user AS fromuser, to_user.id_user AS touser, from_user.name AS fromname, from_user.surname AS fromsurname, from_user.email AS fromemail, to_user.email AS toemail, to_user.name AS toname, to_user.surname AS tosurname, emails.id_email, emails.object_title, emails.message, emails.time_message FROM emails LEFT JOIN users AS from_user ON(emails.id_from=from_user.id_user) LEFT JOIN users AS to_user ON(emails.id_to=to_user.id_user) WHERE ((emails.id_to="'.$_SESSION['jbms_back']['id_user'].'" AND emails.id_from="'.$_GET['id_user'].'") OR (emails.id_to="'.$_GET['id_user'].'" AND emails.id_from="'.$_SESSION['jbms_back']['id_user'].'")) ORDER BY emails.id_email DESC');
?>

<!-- Including header content-->
<?php require_once('assets/css_header.php');?>

<body>

<!-- Showing alert messages -->
<?php echo log_message(); ?>

    <!-- WRAPPER -->
    <div class="container">

    <div class="text-header">Sending a Message to <?php echo $row_send_email['name'];?> <?php echo $row_send_email['surname'];?></div>
    <section class="module">
    <hr class="divider">

                <div class="row">

                <!-- Form inserting the details  -->
                 <form id="form-validation" action="post_send_email.php" method="post">
                 <input type="hidden" name="id_employee" value="<?php echo $row_send_email['id_user'];?>">

                       <div class="form-group col-xs-12">
                          <label class="control-label">To</label>
                          <input type="text"  name="employee_email" id="employee_email" value="<?php echo $row_send_email['email'];?>" class="form-control" readonly>
                        </div> 

                       <div class="form-group col-xs-12">
                          <label class="control-label">Object</label>
                          <input type="text"  name="object_title" id="object_title" value="<?php echo $jobsn;?>" class="form-control" placeholder="Company Name*">
                       </div> 
                   
                    <div class="form-group col-xs-12 ">
                        <label class="control-label">Text</label>
                        <textarea name="message" id="message" class="form-control"></textarea>
                    </div>

                    <div class="form-group col-xs-12">
                      <input class="form-control btn-default" type="submit" value="Send Message">
                    </div>
                  </form>
                </div>
      <!-- module -->
      <section class="module">
        <button id="button" type="button" class="btn btn-default" data-toggle="collapse" data-target="#ins_company">
         <i class="fa fa-angle-down fa-1x"></i> Messages <span class="badge"><?php echo $emails->rowCount();?></span>
        </button>
        </section>

        <div id="ins_company" class="collapse">
          <div class="text-header text-right">Messages with <?php echo $row_send_email['name'];?> <?php echo $row_send_email['surname'];?></div>
            <div class="row">
              <?php for ($i = 1; $i <= $emails->rowCount(); $i++) {?>
                <?php while($row_emails=$emails->fetch(PDO::FETCH_ASSOC)){ ?>

                <div class="form-group col-xs-2 text-center">
                 <?php if ($row_emails['fromuser']==$_SESSION['jbms_back']['id_user']){  $pre_echo='Me'; }else{ $pre_echo='User';} ?>
                 <h7><?php echo $i++.')';?></b> <?php echo $pre_echo;?>, <?php echo $row_emails['fromname'];?></h7>
                  <b><?php echo timetodate($row_emails['time_message']);?></b>
                </div>

                <div class="form-group well col-xs-10 text-left">
                <h6><?php echo $row_emails['object_title'];?></h6>
                  <h7><?php echo $row_emails['message'];?></h7>
                </div>
                <?php } } ?>
            </div> 
            
          </div>
        </div>
      </section>
    </div>
    <!-- WRAPPER -->


<!-- JS library and scripts-->
<!-- Showing alert messages -->
<!-- Alerts -->


<script>
    $().ready(function() {
        // validate signup form on keyup and submit
        $("#form-validation").validate({
            rules: {
               
                employee_email: {
                    required: true,
                    minlength: 5,
                    email: true
                },
                 object_title: {
                      required: true,
                      minlength: 2
                },

                message: {
                    required: true,
                    minlength: 2
                }
            },

            messages: {

                employee_email: {
                    required: "Please enter a message",
                    email: "Please enter a valid email email.",
                    minlength: "Message must be at least 2 characters long"
                },

               object_title: {
                    required: "Please enter an object title",
                    minlength: "Object Title must be at least 2 characters long"
                },

                message: {
                    required: "Please enter your message",
                    minlength: "Message must be at least 2 characters long"
                }
            }
        });
    });
</script>

<!-- Including Footer file -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>