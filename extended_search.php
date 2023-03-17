<?php
// Page destination
$filename='lst_recent_jobs';

// Name of module
$module='lst_recent_jobs.php';

include('admin/assets/include/functions.php');

//Including Variables
require_once('admin/assets/include/variables.php');

// Including header content
require_once('admin/assets/css_header_front.php');
?>

<body>

<?php echo include('top_menu.php');?>

<!--Top_content-->
<section id="indexnoimg">

        <div class="row ">
            <div class="col-lg-12">
                <div class="margintop100px">
                    <div class="fadeIn wow animated">
                      <h2><?php echo languages($_SESSION['jbms_front']['lang_code'],1);//Jobs?></h2>
                    </div>
                     <hr class="divider-menu">
                </div>
            </div>
          </div>

    <div class="container">

          <div class="row">

                <!-- Form inserting the details  -->
                 <form name="extendedsearch" action="post_search_results.php" method="POST">
                  <input type="hidden" name="filename" value="<?php echo $filename;?>">
                  <input type="hidden" name="module" value="<?php echo $module;?>">

                       <div class="form-group col-sm-12">
                          <input type="text"  name="job_title" id="job_title" value="<?php echo $_SESSION[$filename]['job_title'];?>" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],10);//Job title?>">
                        </div> 

                       <div class="form-group col-sm-6">
                          <input type="text"  name="company_name" id="company_name" value="<?php echo $_SESSION[$filename]['company_name'];?>" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],38);//Company Name?>">
                        </div> 

                       <div class="form-group col-sm-6">
                          <input type="text"  name="job_sn" id="job_sn" value="<?php echo $_SESSION[$filename]['job_sn'];?>" class="form-control" placeholder="<?php echo languages($_SESSION['jbms_front']['lang_code'],39);//Job Sn?>">
                        </div>

                      <div class="form-group col-sm-6 text-left">
                      <select id="id_cat_expertise" name="id_category" class="form-control">
                          <option value=""><?php echo languages($_SESSION['jbms_front']['lang_code'],40);//All Categories?></option>
                          <?php $exp=$dbj->query('SELECT * FROM category_expertises WHERE active=1 ORDER BY id_cat_expertise ASC');
                          while($row_exp=$exp->fetch(PDO::FETCH_ASSOC)){
                          ?>
                          <option value="<?php echo $row_exp['id_cat_expertise'];?>" <?php if($row_exp['id_cat_expertise']==$_SESSION[$filename]['id_category']){ ?> selected="selected" <?php } ?>><?php echo $row_exp[''.$_SESSION['jbms_front']['lang_code'].'_expertise_category'];?></option>
                          <?php } ?>
                      </select>
                      </div>

                      <div class="form-group col-sm-6 text-left">
                        <?php if($_SESSION[$filename]['id_category']){ ?>
                          <select id="id_expertise" name="id_expertise" class="form-control">
                              <option value=""><?php echo languages($_SESSION['jbms_front']['lang_code'],48);//All Expertises?></option>
                              <?php $exp=$dbj->query('SELECT * FROM expertises WHERE id_category='.$_SESSION[$filename]['id_category'].' AND active=1 ORDER BY id_expertise ASC');
                              while($row_exp=$exp->fetch(PDO::FETCH_ASSOC)){
                              ?>
                              <option value="<?php echo $row_exp['id_expertise'];?>" <?php if($row_exp['id_expertise']==$_SESSION[$filename]['id_expertise']){ ?> selected="selected" <?php } ?>><?php echo $row_exp[''.$_SESSION['jbms_front']['lang_code'].'_expertise_area'];?></option>
                              <?php } ?>
                          </select>
                        <?php }else{ ?>

                          <select id="id_expertise" name="id_expertise" class="form-control">
                              <option value=""><?php echo languages($_SESSION['jbms_front']['lang_code'],48);//All Expertises?></option>
                          </select>
                        <?php } ?>
                      </div>
        
                    <div class="form-group col-sm-6">
                        <select name="publish_date" id="publish_date" class="form-control">
                            <option value="">All Publish Dates</option>
                            
                            <?php if($_SESSION[$filename]['publish_date']=='today'){ ?><option value="today" selected="selected"><?php echo languages($_SESSION['jbms_front']['lang_code'],50);//All Education Levels?></option><?php }else{ ?><option value="today"><?php echo languages($_SESSION['jbms_front']['lang_code'],50);//All Education Levels?></option><?php } ?>

                            <?php if($_SESSION[$filename]['publish_date']=='yesterday'){ ?><option value="yesterday" selected="selected"><?php echo languages($_SESSION['jbms_front']['lang_code'],51);//All Education Levels?></option><?php }else{ ?><option value="yesterday"><?php echo languages($_SESSION['jbms_front']['lang_code'],51);//All Education Levels?></option><?php } ?>
                            
                            <?php if($_SESSION[$filename]['publish_date']=='oneweek'){ ?><option value="oneweek" selected="selected"><?php echo languages($_SESSION['jbms_front']['lang_code'],52);//One Week Ago?></option><?php }else{ ?><option value="oneweek"><?php echo languages($_SESSION['jbms_front']['lang_code'],52);//One Week Ago?></option><?php } ?>
                            
                           <?php if($_SESSION[$filename]['publish_date']=='twoweeks'){ ?><option value="twoweeks" selected="selected"><?php echo languages($_SESSION['jbms_front']['lang_code'],53);//Two Weeks Ago?></option><?php }else{ ?><option value="twoweeks"><?php echo languages($_SESSION['jbms_front']['lang_code'],53);//Two Weeks Ago?></option><?php } ?>
                           
                            <?php if($_SESSION[$filename]['publish_date']=='onemonth'){ ?><option value="onemonth" selected="selected"><?php echo languages($_SESSION['jbms_front']['lang_code'],54);//One Month Ago?></option><?php }else{ ?><option value="onemonth"><?php echo languages($_SESSION['jbms_front']['lang_code'],54);//One Month Ago?></option><?php } ?>
                            
                        </select>
                    </div>

                      <div class="form-group col-sm-6 text-left">
                         <select name="id_level_education" id="id_level_education" class="form-control">
                        <option value=""><?php echo languages($_SESSION['jbms_front']['lang_code'],42);//All Education Levels?></option>
                        <?php $exp_cat=$dbj->query('SELECT * FROM levels_education ORDER BY id_level_education ASC');
                          while($row_exp_cat=$exp_cat->fetch(PDO::FETCH_ASSOC)){
                        ?>
                          <option value="<?php echo $row_exp_cat['id_level_education'];?>" <?php if($row_exp_cat['id_level_education']==$_SESSION[$filename]['id_level_education']){ ?> selected="selected" <?php } ?>><?php echo $row_exp_cat[''.$_SESSION['jbms_front']['lang_code'].'_level_education'];?></option>
                          <?php } ?>
                        </select>
                      </div>

                      <div class="form-group col-sm-6 text-left">
                       <select name="id_level_experience" id="id_level_experience" class="form-control">
                        <option value=""><?php echo languages($_SESSION['jbms_front']['lang_code'],55);//All Education Levels?></option>
                        <?php $exp_cat=$dbj->query('SELECT * FROM levels_experience WHERE active=1 ORDER BY years_experience ASC');
                          while($row_exp_cat=$exp_cat->fetch(PDO::FETCH_ASSOC)){
                        ?>
                         <option value="<?php echo $row_exp_cat['id_level_experience'];?>" <?php if($row_exp_cat['id_level_experience']==$_SESSION[$filename]['id_level_experience']){ ?> selected="selected" <?php } ?>><?php echo $row_exp_cat[''.$_SESSION['jbms_front']['lang_code'].'_level_experience'];?></option>
                          <?php } ?>
                        </select>
                      </div>

                      <div class="form-group col-sm-6 text-left">
                         <select name="id_salary" id="id_salary" class="form-control">
                        <option value=""><?php echo languages($_SESSION['jbms_front']['lang_code'],44);//All Salary Ranges?></option>
                        <?php $exp_cat=$dbj->query('SELECT * FROM salary_ranges WHERE active=1 ORDER BY id_salary ASC');
                          while($row_exp_cat=$exp_cat->fetch(PDO::FETCH_ASSOC)){
                        ?>
                         <option value="<?php echo $row_exp_cat['id_salary'];?>" <?php if($row_exp_cat['id_salary']==$_SESSION[$filename]['id_salary']){ ?> selected="selected" <?php } ?>><?php echo $row_exp_cat['salary_range'];?></option>
                          <?php } ?>
                        </select>
                      </div>

                    <div class="form-group col-sm-12">
                      <input type="submit" name="name" class="form-control btn btn-success" value="<?php echo languages($_SESSION['jbms_front']['lang_code'],45);//FILTER?>">
                      <input type="submit" name="reset" class="form-control btn btn-success" value="<?php echo languages($_SESSION['jbms_front']['lang_code'],12);//RESET?>">
                    </div>
                  </form>
              </div>
           </div>
</section>
  <!-- Including Footer file -->
  <?php require_once('admin/footer.php');?>

    <!-- /section -->
<script type="text/javascript">
$(document).ready(function(){
    $('#id_cat_expertise').on('change',function(){
        var id_cat_expertise = $(this).val();
        if(id_cat_expertise){
            $.ajax({
                type:'POST',
                url:'admin/deroul_expertises.php',
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
<?php echo file_get_contents('admin/assets/js_bottom_front.php');?>

</body>
</html>