<?php
// Including functions
require_once('assets/include/functions.php');

// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('assets/include/variables.php');

// Function to check logged user
login_twoadmin();

// Counting Total Results
$total = count_received_msg();

// Label and number of users
$title_total_results=$total.' Received Messages';

// Including pagination elements through the file construct_paination.php
include('construct_pagination.php');

// Including header content
require_once('assets/css_header.php');
?>

<body>
<!-- PRELOADER -->
<div class="page-loader">
  <div class="loader">Loading</div>
</div>

<!-- Including menu -->
<?php include('left_menu.php'); ?>

<!-- Content side content -->
<div class="content">

<!-- Search -->
<div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <h4 class="margintop40px"><b><i class="fa fa-file-o"></i> Inbox</b></h4>
      <hr class="divider-menu">
    </div>
  </div>
</div>

<section id="adminheader">
  <div class="container">
    <form name="name" method="post" action="post_search_inbox.php">
    <input type="hidden" name="filename" value="<?php echo $filename;?>">
      <div class="form-group col-md-4">
        <input type="text" name="search_comp"  value="<?php echo $_SESSION[$filename]['search_comp']; ?>" class="form-control" placeholder="User, Message Header">
      </div>

      <div class="form-group col-md-4">
        <input type="submit" name="name" class="form-control btn-default" value="Search">
      </div>

      <div class="form-group col-md-4">
        <input type="submit" name="reset" class="form-control btn-default" value="Reset">
      </div>
    </form>
  </div>
</section>

<!-- Module showing results -->
<section id="module" class="bg-gray">
  <h5 class="padding30"><b><?php echo $title_total_results;?></b></h5>
  <div class="container-custom-grid">
   <div class="row">
    <div class="col-md-12">

    <?php $data=$dbj->query('SELECT from_user.id_user AS fromuser, to_user.id_user AS touser, from_user.name AS fromname, from_user.surname AS fromsurname, from_user.email AS fromemail, to_user.email AS toemail, to_user.name AS toname, to_user.surname AS tosurname, emails.id_email, emails.object_title, emails.message, emails.time_message FROM emails LEFT JOIN users AS from_user ON(emails.id_from=from_user.id_user) LEFT JOIN users AS to_user ON(emails.id_to=to_user.id_user) WHERE emails.id_to="'.$_SESSION['jbms_back']['id_user'].'" AND emails.active_employer="1" '.$_SESSION[$filename]['search_query'].' GROUP BY from_user.id_user ORDER BY emails.time_message DESC LIMIT '.$start.', '.$_SESSION['epp'].'');
    ?>
    <script type="text/javascript">
    function confirm_delete(id_user, fromemail){
    if(confirm('You are removing messages with '+fromemail+' ?')){
         window.location.href='post_del_email.php?id_user='+id_user+'&email_adress='+fromemail+'&target=inbox';
     }
    }
    </script>
    <!-- messages -->
    <?php if($data->rowCount()){
        for ($i = 1; $i <= $data->rowCount(); $i++) {
        while($row_data=$data->fetch(PDO::FETCH_ASSOC)){
  
    $emails=$dbj->query('SELECT DISTINCT from_user.id_user AS fromuser, to_user.id_user AS touser, from_user.name AS fromname, from_user.surname AS fromsurname, from_user.email AS fromemail, to_user.email AS toemail, to_user.name AS toname, to_user.surname AS tosurname, emails.id_email, emails.object_title, emails.message, emails.time_message FROM emails LEFT JOIN users AS from_user ON(emails.id_from=from_user.id_user) LEFT JOIN users AS to_user ON(emails.id_to=to_user.id_user) WHERE ((emails.id_to="'.$_SESSION['jbms_back']['id_user'].'" AND emails.id_from="'.$row_data['fromuser'].'") OR (emails.id_to="'.$row_data['fromuser'].'" AND emails.id_from="'.$_SESSION['jbms_back']['id_user'].'")) ORDER BY emails.id_email DESC');
    ?>

    <div class="wizard-card row border padding30">
       <div class="col-md-1">
         <fieldset>
         <a href="view_messages.php?id_user=<?php echo $row_data['fromuser'];?>"><span class="badge"><?php echo $emails->rowCount();?></span><span  style="display:block; margin:-1px;"><i class="fa fa-envelope fa-2x"></i></span></a>
        </fieldset>
      </div>

      <div class="col-md-3">
        <fieldset>
          <a href="view_messages.php?id_user=<?php echo $row_data['fromuser'];?>">
            <?php echo $row_data["fromname"];?> 
            <?php echo $row_data["fromsurname"];?>
          </a>
        </fieldset>

        <fieldset>
         <?php echo $row_data["fromemail"];?>
        </fieldset>
      </div>

      <div class="col-md-3">
      <h4 class="iconbox-header">Object</h4>
        <fieldset>
        <?php echo $row_data["object_title"];?>
        </fieldset>
      </div>

      <div class="col-md-3">
      <h4 class="iconbox-header">Time Message</h4>
        <fieldset>
         <?php echo date('d-m-Y',strtotime($row_data['time_message'])); ?>
        </fieldset>
      </div>

     <!-- Group buttons -->
      <div class="col-md-1 text-right paddingtop10px">
           <a href="javascript:confirm_delete('<?php echo $row_data['fromuser'];?>','<?php echo $row_data['fromemail'];?>')"><i class="fa fa-times fa-2x"></i></a>
      </div>
    </div>

    <?php } } }else{ ?>

      <div class="row border">
        <div class="form-group col-lg-12 text-center">
        <fieldset class="padding30">No data found</fieldset>
        </div>
      </div>
    <?php }?>
    <?php if ($nbPages>1) {?>

    <div class="pagination">
    <?php echo paginate($module, '?p=', $nbPages, $current, '#module'); ?>
    </div>

    <?php } ?>
    </div>
  </div>
</section>

<!-- Including Footer file -->
<?php require_once('footer.php');?>
<!-- /content -->
</div>



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
</script>

<!-- Including Footer file -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>