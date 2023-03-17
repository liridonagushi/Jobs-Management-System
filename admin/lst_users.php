<?php
// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

// Including functions
require_once('assets/include/functions.php');

// Function to check logged in user
login_oneadmin();

//Including Variables
require_once('assets/include/variables.php');

// Query of the database
$total=count_users($_SESSION[$filename]['search_query']);

// Label and number of users
$title_total_users=$total.' Registered Users';

// Including pagination elements through the file construct_paination.php
include('construct_pagination.php');

// Including header content
require_once('assets/css_header.php');
?>

<body>
<!-- PRELOADER -->
<div class="page-loader">
  <div class="loader">Loading...</div>
</div> 

<!-- Including menu -->
<?php include('left_menu.php'); ?>

<!-- Content side content -->
<div class="content">

<!-- Search -->
<div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <h4 class="padding30"><b><i class="fa fa-file-o"></i> Users</b></h4>
      <hr class="divider-menu">
    </div>
  </div>
</div>

<section id="adminheader">
  <div class="container">
    <form name="name" method="post" action="post_search_candidates.php">
    <input type="hidden" name="filename" value="<?php echo $filename;?>">
    <input type="hidden" name="link" value="<?php echo $module;?>">

      <div class="form-group col-md-2">
        <input type="text" name="emp_name"  value="<?php echo $_SESSION[$filename]['emp_name']; ?>" class="form-control" placeholder="Search User">
      </div>

      <div class="form-group col-md-2">
        <select id="id_level" name="id_level" class="form-control">
        <option value="">Select User Level</option>
        <?php $level=$dbj->query('SELECT * FROM admin_levels ORDER BY admin_level');
        while($row_level=$level->fetch(PDO::FETCH_ASSOC)){
        ?>
        <option value="<?php echo $row_level['id_level'];?>" <?php if($row_level['id_level']==$_SESSION[$filename]['id_level']){ ?> selected <?php } ?>><?php echo $row_level['admin_level'];?></option>
        <?php } ?>
        </select>
      </div>

      <div class="form-group col-md-4">
        <input type="submit" name="name" class="form-control btn-default" value="SEARCH">
      </div>

      <div class="form-group col-md-4">
        <input type="submit" name="reset" class="form-control btn-default" value="RESET">
      </div>
    </form> 
  </div>
</section>

<!-- Module showing results -->
<section id="module" class="bg-gray">
    <h5 class="padding30"><b><?php echo $title_total_users;?></b></h5>
    <div class="container-custom-grid">
      <div class="row">
        <div class="col-md-12">

    <?php
    $usrs=$dbj->query('SELECT users.id_user, admin_levels.id_level, users.admin_level, users.name, users.surname, users.profile_img, users.phone_number, users.email, countries.country_code, countries.country_name, adresses.city, adresses.postal_code, adresses.adress, admin_levels.admin_level FROM users LEFT JOIN adresses ON users.id_adress=adresses.id_adress LEFT JOIN countries ON adresses.id_country=countries.id_country LEFT JOIN admin_levels ON users.admin_level=admin_levels.id_level WHERE 1=1 '.$_SESSION[$filename]['search_query'].' '.$_SESSION[$filename]['orderby'].' LIMIT '.$start.', '.$_SESSION['epp'].'');

     if($usrs->rowCount()){
          while($row_usrs=$usrs->fetch(PDO::FETCH_ASSOC)){ 
     ?>

    <div class="wizard-card row border padding30">
      <div class="form-group col-md-4">
        <fieldset>
        <h7><i class="fa fa-user fa-1x"></i> <?php echo $row_usrs['id_user'];?> <?php echo $row_usrs['surname'];?> <?php echo $row_usrs['name'];?></h7>
        </fieldset>

        <fieldset>
          <div class="image-upload">
            <label for="file-input">
              <?php if(!empty($row_usrs['profile_img'])){ ?>
              <img src="<?php echo $_SESSION['jbms_back']['directory_profile_img'].$row_usrs['profile_img'];?>" alt="client">
              <?php }else{ ?>
              <img src="<?php echo $_SESSION['jbms_back']['directory_profile_img'];?>no_photo.jpg" class="borderstyle" width="80" alt="client">
              <?php } ?>
            </label>
          </div>
        </fieldset>
      </div>

      <div class="form-group col-md-2">
        <h4 class="iconbox-header"><i class="fa fa-tags fa-1x"></i> Contact</h4>
        <fieldset>
        <i class="fa fa-phone fa-1x"></i> <?php echo $row_usrs['phone_number'];?><br />
        <i class="fa fa-envelope fa-1x"></i> <?php echo $row_usrs['email'];?>
        </fieldset>
      </div>

      <div class="form-group col-md-2">
        <h4 class="iconbox-header"><i class="fa fa-street-view fa-1x"></i> Adress</h4>
        <fieldset>
        <i class="fa fa-map-marker fa-1x"></i>
        <?php echo $row_usrs['country_code'];?>
        <?php echo $row_usrs['country_name'];?>
        </fieldset>
        <fieldset>
        <?php echo $row_usrs['city'];?>
        <?php echo $row_usrs['postal_code'];?>
        <?php echo $row_usrs['adress'];?>
        </fieldset>
      </div>
      <div class="form-group col-md-2">
        <h4 class="iconbox-header"><i class="fa fa-street-view fa-1x"></i> User Level</h4>
        <fieldset>
        <i class="fa fa-map-marker fa-1x"></i>
        <?php echo $row_usrs['admin_level'];?>
        </fieldset>
      </div>
      <script type="text/javascript">
      function confirm_remove(id_user, name, surname, module){
        if(confirm('You are removing '+name+' '+surname+' from your favourite candidates ?')){
           window.location.href='post_process_favourites.php?id_user='+id_user+'&name='+name+'&surname='+surname+'&link='+module+'&target=remove';
       }
      }

      function confirm_insert(id_user, name, surname, module){
        if(confirm('You are adding '+name+' '+surname+' to your favourite candidates ?')){
           window.location.href='post_process_favourites.php?id_user='+id_user+'&name='+name+'&surname='+surname+'&link='+module+'&target=insert';
       }
      }

      function confirm_remove_usr(id_user, name, surname, module){
        if(confirm('You are removing '+name+' '+surname+' from your database ?')){
           window.location.href='post_delete_user.php?id_user='+id_user+'&name='+name+'&surname='+surname+'&link='+module+'&target=remove';
       }
      }

      function ban_usr(id_user, name, surname){
        if(confirm('You are banning '+name+' '+surname+' for a period of 30 days !')){
           window.location.href='post_process_banuser.php?id_user='+id_user+'&target=ban';
       }
      }

      function unban_usr(id_user, name, surname){
        if(confirm('You are removing ban period for the user: '+name+' '+surname+' !')){
           window.location.href='post_process_banuser.php?id_user='+id_user+'&target=unban';
       }
      }
      </script>
      <?php if($row_usrs['id_level']!=$_SESSION['jbms_back']['admin_level']){ ?>
      <div class="form-group col-md-2 text-center">
        <!-- Group buttons -->
         <a class="dropdown-toggle btn btn-sm btn-default btn-round"  data-toggle="dropdown" href="#">Options <i class="fa fa-arrow-down fa-1x"></i></a>
          <ul class="dropdown-menu" role="menu">

          <?php
          $fav=$dbj->query('SELECT * FROM profile_favourites WHERE id_employee="'.$row_usrs['id_user'].'" AND id_employer='.$_SESSION['jbms_back']['id_user'].'');

          if($fav->rowCount()>0){ ?>
       
          <li><a href="javascript:confirm_remove('<?php echo $row_usrs['id_user'];?>','<?php echo $row_usrs['name'];?>','<?php echo $row_usrs['surname'];?>','<?php echo $module;?>')"><i class="fa fa-remove fa-1x"></i> Remove from Favourites</a></li>

          <?php }else{ ?>

          <li><a href="javascript:confirm_insert('<?php echo $row_usrs['id_user'];?>','<?php echo $row_usrs['name'];?>','<?php echo $row_usrs['surname'];?>','<?php echo $module;?>')"><i class="fa fa-reply fa-1x"></i> Add to Favourites</a></li>

          <?php } ?>

          <li><a class="fancybox fancybox.iframe" href="send_email.php?id_user=<?php echo $row_usrs['id_user'];?>"><i class="fa fa-envelope fa-1x"></i> Send en email</a></li>

          <?php 
            $banned=$dbj->query('SELECT * FROM banned_users WHERE id_user_banned="'.$row_usrs['id_user'].'"');
            if ($banned->rowCount()>0){ ?>
            <li><a href="javascript:unban_usr('<?php echo $row_usrs['id_user'];?>','<?php echo $row_usrs['name'];?>','<?php echo $row_usrs['surname'];?>')"><i class="fa fa-ban fa-1x"></i> Remove Ban</a></li>
            <?php }else{ ?>
            <li><a href="javascript:ban_usr('<?php echo $row_usrs['id_user'];?>','<?php echo $row_usrs['name'];?>','<?php echo $row_usrs['surname'];?>','<?php echo $module;?>')"><i class="fa fa-ban fa-1x"></i> Ban User</a></li>
            <?php } ?>

            <li><a href="javascript:confirm_remove_usr('<?php echo $row_usrs['id_user'];?>','<?php echo $row_usrs['name'];?>','<?php echo $row_usrs['surname'];?>','<?php echo $module;?>')"><i class="fa fa-times fa-1x"></i> Remove User</a></li>
          </ul>
      </div>
    <?php } ?>
    </div>

    <?php } }else{ ?>
      <div class="row border">
        <div class="form-group col-md-12 text-center">
        <fieldset class="padding30">No results found</fieldset>
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
<!-- /WRAPPER -->
</div>
    <!-- /section -->
<script type="text/javascript">
$(document).ready(function(){
    $('#id_company').on('change',function(){
        var id_company = $(this).val();
        if(id_company){
            $.ajax({
                type:'POST',
                url:'deroul_jobs.php',
                data:'id_company='+id_company,
                success:function(html){
                    $('#id_job').html(html);
                }
            }); 
        }else{
            $('#id_job').html('<option value="">Choose Company</option>');
        }
    });
});
</script>
<!-- Including JS Content -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>