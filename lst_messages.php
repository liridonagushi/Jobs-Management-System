<?php
// Including functions
require_once('admin/assets/include/functions.php');

// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('admin/assets/include/variables.php');

login_front();

$jobs=$dbj->query('SELECT DISTINCT emails.id_email, emails.id_from FROM emails LEFT JOIN users AS from_user ON(emails.id_from=from_user.id_user) LEFT JOIN users AS to_user ON(emails.id_to=to_user.id_user) WHERE  emails.id_to="'.$_SESSION['jbms_front']['id_user'].'" AND emails.active_employee="1" GROUP BY emails.id_from');

  $total = $jobs->rowCount();

// Label and number of Jobs
$title_total_jobs=$total.' Messages';

// Including pagination elements through the file construct_paination.php
include('admin/construct_pagination.php');

// Including header content
require_once('admin/assets/css_header_front.php');
?>

<body>

<?php echo include('top_menu.php');?>
<!-- Module showing results -->

<!-- Module Search -->
<section id="headerbuttons">
      <div class="row">
        <form name="search" action="post_search_messages.php" method="POST">
            <div class="col-lg-3">
              <input type="text" name="job_title" value="<?php echo $_SESSION[$filename]['job_title'];?>" class="form-control" placeholder="Email, Header">
            </div>

            <div class="col-lg-3">
                <input type="submit" name="name" class="form-control btn-default" value="Search">
            </div>
            <div class="col-lg-3">
                <input type="submit" name="reset" class="form-control btn-default" value="Reset">
            </div>
        </form>
  </div>
</section>

<section id="searchresults">
  <div class="row">
    <div class="col-lg-12">
      <h4><?php echo $title_total_jobs;?></h4>
      <div class="divider"></div>
    </div>
  </div>

<div class="container">
  <div class="row">
  <table class="table table-inverse">
    <thead class="thead-inverse">
      <tr class="active">
        <th width="250px">
         <?php echo languages($_SESSION['jbms_front']['lang_code'],115); //From?>
        </th>
        <th width="250px">
         <?php echo languages($_SESSION['jbms_front']['lang_code'],116); //Header?>
        </th>
        <th width="250px">
         <?php echo languages($_SESSION['jbms_front']['lang_code'],117); //Time Message?>
        </th>
        <th width="250px">
        </th>
      </tr>
    </thead>

    <?php $message=$dbj->query('SELECT DISTINCT emails.id_email, emails.id_from, emails.id_to, CONCAT(from_user.name, " ", from_user.surname) AS fromname, CONCAT(to_user.name, " ", to_user.surname) AS toname, emails.object_title, emails.time_message FROM emails LEFT JOIN users AS from_user ON(emails.id_from=from_user.id_user) LEFT JOIN users AS to_user ON(emails.id_to=to_user.id_user) WHERE ((emails.id_to="'.$_SESSION['jbms_front']['id_user'].'" OR emails.id_from="'.$_SESSION['jbms_front']['id_user'].'")) AND ((emails.id_from !="'.$_SESSION['jbms_front']['id_user'].'") OR (emails.id_from=emails.id_to)) AND emails.active_employee="1" GROUP BY emails.id_from ORDER BY emails.id_from DESC LIMIT '.$start.', '.$_SESSION['epp'].'');
    ?>

    <script type="text/javascript">
    function confirm_save(id_job, job_title, link){
      if(confirm('You are saving '+job_title+' job to your saved jobs ?')){
      window.location.href='post_upd_savejob.php?id_job='+id_job+'&link='+link+'';
     }
    }
    </script>

    <script type="text/javascript">
    function confirm_delete(id_email, id_from){
       if(confirm('Are you sure to remove this message from your inbox !')){
      window.location.href='post_upd_savejob.php?id_job='+id_job+'&link='+link+'';
     }
    }
    </script>

    <!-- MODULE rows -->
    <?php if($message->rowCount()>0){
    echo'<tbody>';
    while($row_messages=$message->fetch(PDO::FETCH_ASSOC)){
    ?>

      <script type="text/javascript">

      function confirm_remove(id_from, fromname){
        if(confirm('<?php echo languages($_SESSION['jbms_front']['lang_code'],118); //Question?>: '+fromname+' !')){
           window.location.href='post_process_remove.php?id_user='+id_from+'&target="email"';
       }
      }
      </script>

    <tr class="td-inverse">
      <td> <?php echo $row_messages['fromname'];?></td>
      <td><?php echo substr($row_messages['object_title'],0,30); ?> ...</td>
      <td><?php echo date('d-m-Y',strtotime($row_messages['time_message'])); ?></td>
      <td>
        <div class="form-group col-lg-2 text-center">
        <!-- Group buttons -->
        <a class="dropdown-toggle btn btn-sm btn-info" data-toggle="dropdown" href="#"><?php echo languages($_SESSION['jbms_front']['lang_code'],56); //Options?> <i class="fa fa-arrow-down fa-1x"></i></a>

        <ul class="dropdown-menu" role="menu">
          <li><a href="view_messages.php?id_user=<?php echo $row_messages['id_from'];?>"><i class="fa fa-inbox fa-1x"></i><?php echo languages($_SESSION['jbms_front']['lang_code'],57); //View?></a></li>
          <li><a href="javascript:confirm_remove('<?php echo $row_messages['id_from'];?>','<?php echo $row_messages['fromname'];?>')"><i class="fa fa-remove fa-1x"></i><?php echo languages($_SESSION['jbms_front']['lang_code'],78); //Remove?></a></li>
        </ul>
        </div>
      </td>
    </tr>

    <?php } }else{ ?>

    <tr>
      <td colspan="6">
        <fieldset class="padding30 text-center"><?php echo languages($_SESSION['jbms_front']['lang_code'],60); //No data found?></fieldset>
      </td>
    </tr>

    <?php } ?>

    <?php if ($nbPages>1) { ?>
    <tr>
    <td colspan="6">
    <div class="pagination">
    <?php echo paginate($module, '?p=', $nbPages, $current, '#module'); ?>
    </div>
    </td>
    </tr>
    <?php echo '</tbody>';?>

    <?php } ?>
  </table>
</div>
</div>
</section>
<!--Footer-->
<?php require_once('admin/footer.php');?>

<!-- JS library and scripts-->
<script>
    $().ready(function() {
        // validate signup form on keyup and submit
        $("#form-validation").validate({
            rules: {
                  email: {
                  required: true,
                  minlength: 5,
                  maxlength: 50,
                  email: true
                },
                  password: {
                  required: true,
                  minlength: 5,
                  maxlength: 50
                }
            },

            messages: {

                email: {
                    required: "Please enter an email adress",
                    minlength: "Email must be at least 5 characters long",
                    maxlength: "Please enter no more than 50 characters."
                },

                password: {
                    required: "Please enter a password",
                    minlength: "Password must be at least 5 characters long",
                    maxlength: "Please enter no more than 80 characters."
                }
            }
        });
    });
</script>

<!-- Including Footer file -->
<?php echo file_get_contents('admin/assets/js_bottom_front.php');?>

</body>
</html>