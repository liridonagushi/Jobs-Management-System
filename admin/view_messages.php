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

$send_email=$dbj->query('SELECT users.id_user, users.email, users.name, users.surname, users.profile_img FROM users WHERE users.id_user="'.$_GET['id_user'].'"');
$row_user_email=$send_email->fetch(PDO::FETCH_ASSOC);

$total_messages=$dbj->query('SELECT emails.id_from, emails.id_to FROM emails WHERE ((emails.id_from="'.$_GET['id_user'].'" AND id_to="'.$_SESSION['jbms_back']['id_user'].'")OR(emails.id_to="'.$_GET['id_user'].'" AND id_from="'.$_SESSION['jbms_back']['id_user'].'")) AND emails.active_employee=1');

// Tital Messages
$total = $total_messages->rowCount();

// Including pagination elements through the file construct_paination.php
include('construct_pagination.php');

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
    <div class="col-md-12 text-center border-bottom">
      <h4 class="padding10"><b><i class="fa fa-envelope-o"></i> Outbox</b></h4>
    </div>
  </div>
</div>



  <!-- WRAPPER -->
<section id="headerbuttons">
  <div class="row">
    <div class="col-md-12">
      <div class="fadeIn wow animated">
        <a href="#" id="button" class="hyperlink" data-toggle="collapse" data-target="#ins_company">
        <i class="fa fa-angle-down fa-1x"></i> Write a Message </a>
      </div>
    </div>
  </div>


  <div id="ins_company" class="collapse">
  <div class="container">
  <div class="text-header">Sending a Message to <?php echo $row_user_email['name'];?> <?php echo $row_user_email['surname'];?>
<hr class="divider-menu"></div>

    <div class="row">

    <!-- Form inserting the details  -->
    <form id="form-validation" action="post_send_email.php" method="post">
    <input type="hidden" name="id_employee" value="<?php echo $row_user_email['id_user'];?>">
    <input type="hidden" name="target" value="messages">

      <div class="form-group col-xs-12">
      <label class="control-label">To</label>
      <input type="text"  name="employee_email" value="<?php echo $row_user_email['name'];?> <?php echo $row_user_email['surname'];?>" class="form-control" disabled="true">
      </div> 

      <div class="form-group col-xs-12">
        <label class="control-label">Object</label>
        <input type="text"  name="object_title" id="object_title" value="" class="form-control" placeholder="Message Title *">
      </div> 

      <div class="form-group col-xs-12 ">
        <label class="control-label">Text</label>
        <textarea name="message" id="message" class="form-control" placeholder="Message *"></textarea>
      </div>

      <div class="form-group col-xs-12">
        <input class="form-control btn-default" type="submit" value="Send Message">
      </div>
      
    </form>
    </div>
  </div>
  </div>
  </section>

<section id="searchresults">

  <div class="container">
  <div id="ins_company" class="collapse">
  <div class="text-header">Sending a Message to <?php echo $row_user_email['name'];?> <?php echo $row_user_email['surname'];?>
  <hr class="divider"></div>
    </div>

    <?php
$messages=$dbj->query('SELECT DISTINCT from_user.id_user AS fromuser, to_user.id_user AS touser, from_user.name AS fromname, from_user.surname AS fromsurname, from_user.email AS fromemail, to_user.email AS toemail, to_user.name AS toname, to_user.surname AS tosurname, emails.id_email, emails.object_title, emails.message, emails.time_message FROM emails LEFT JOIN users AS from_user ON(emails.id_from=from_user.id_user) LEFT JOIN users AS to_user ON(emails.id_to=to_user.id_user) WHERE ((emails.id_to="'.$_SESSION['jbms_back']['id_user'].'" AND emails.id_from="'.$_GET['id_user'].'") OR (emails.id_to="'.$_GET['id_user'].'" AND emails.id_from="'.$_SESSION['jbms_back']['id_user'].'")) AND emails.active_employee=1 ORDER BY emails.id_email DESC LIMIT '.$start.', '.$_SESSION['epp'].'');

// Counting Messages
$countmsg=$messages->rowCount();

  // If a message is in db
  if(!empty($countmsg)) {
  
       while($row_messages=$messages->fetch(PDO::FETCH_ASSOC)){ ?>

      <?php if ($row_messages['fromuser']==$_SESSION['jbms_back']['id_user']){
        $pre_echo='Me';
        }else{
        $pre_echo='User';
        }
      ?>
        <div class="row">
          <div class="col-xs-8">
            <div class="single-message animate_fade_in">
                <div class="col-xs-10">
                  <h5> <?php echo $pre_echo;?>, <?php echo $row_messages['fromname'];?>: <b><?php echo $row_messages['object_title'];?></b></h5>
                </div>

                <div class="col-xs-2 text-right">
                 <?php if(!empty($row_user_email['profile_img'])){ ?>
                  <img src="<?php echo $_SESSION['jbms_back']['directory_profile_img'].''.$row_user_email['profile_img'];?>" class="borderstyle" width="80" alt="client">
                  <?php }else{ ?>
                  <img src="<?php echo $_SESSION['jbms_back']['directory_profile_img'];?>no_photo.jpg" class="borderstyle" width="80" alt="client">
                  <?php } ?>
                </div>

                <div class="col-xs-12">
                  <blockquote> <?php echo $row_messages['message'];?>
                  <div class"timeMessage"><?php echo timetodate($row_messages['time_message']).' at '.date('h.i A',strtotime($row_messages['time_message']));?></div></blockquote>
                </div>
            </div>
          </div>
          <div class="col-xs-4">
          </div>
          
          </div>
          <?php } ?>

          <div class="row">

            <div class="col-xs-6">

            <?php if ($nbPages>1) { ?>
              <div class="pagination">
              <?php echo paginate('view_messages.php?id_user='.$_GET['id_user'].'', '&p=', $nbPages, $current, '#searchresults'); ?>
              </div>
            <?php } ?>

            </div>
            <div class="col-xs-6 text-left">
              <script type="text/javascript">
              function confirm_remove(id_user, name, surname){
                if(confirm('You are removing emails with '+name+' '+surname+' !')){
                   window.location.href='post_process_remove.php?id_user='+id_user+'&target=messages&hyperlink=view_messages.php?id_user='+id_user+'';
               }
              }
              </script>
            <a href="javascript:confirm_remove('<?php echo $row_user_email['id_user'];?>','<?php echo $row_user_email['name'];?>','<?php echo $row_user_email['surname'];?>')" id="button" class="hyperlink"><i class="fa fa-times fa-1x"></i> Delete Messages </a>
            </div>
            
          </div>
          <?php }else{ ?>
          <div class="row">
            <div class="col-xs-12 text-center">
             No messages found for this user
            </div>
          </div>
          <?php } ?>

        </div>

  </section>

    </div>
    
<!-- Including Footer -->
<?php require_once('footer.php');?>

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
               
                employee_email: {
                    required: true,
                    minlength: 5,
                    email: true
                },
                 object_title: {
                      required: true,
                      minlength: 2,
                      maxlength:35
                },

                message: {
                    required: true,
                    minlength: 2,
                    maxlength:800
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
                    minlength: "Object Title must be at least 2 characters long",
                    maxlength: "Object Title can not be grater than 35 characters"
                },

                message: {
                    required: "Employees email is not real",
                    minlength: "Message must be at least 2 characters long",
                    maxlength: "Message Text can not be grater than 800 characters"
                }
            }
        });
    });
</script>

<!-- Including Footer file -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>