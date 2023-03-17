<?php if(empty($_SESSION['jbms_front']['lang_code'])){$_SESSION['jbms_front']['lang_code']='en';} ?>
<!DOCTYPE html>
<html>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
<!-- Template -->
<title><?php echo title_module();?></title>

<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<!-- Latest compiled and minified JavaScript -->
<meta name="revisit-after" content="10 days">
<meta name="distribution" content="web">
<?php $metaname=$dbj->query('SELECT id_job, job_title, job_description FROM job_offers ORDER BY id_job DESC LIMIT 20');
    while($rowmeta=$metaname->fetch(PDO::FETCH_ASSOC)){
?>

<meta name="title" content="<?php echo $rowmeta['job_title'];?>">
<meta name="description" content="<?php echo $rowmeta['job_description'];?>">

<?php } ?>

<link rel="icon" type="image/png" href="admin/assets/images/logo/logo.png" sizes="16x16">
<!-- Icon Fonts -->
<link rel="stylesheet" href="admin/assets/font-awesome/css/font-awesome.min.css" />

<link rel="stylesheet" href="admin/assets/bootstrap-3.3.7/css/bootstrap.css" />
<link rel="stylesheet" href="admin/assets/jquery-ui-1.12.0/jquery-ui.css" />

<link rel="stylesheet" href="admin/assets/css/admin_style.css" />

<!-- Bootstrap core CSS -->
<link rel="stylesheet" type="text/css" href="admin/assets/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />

<link rel="stylesheet" href="admin/assets/bootstrap-switchery/dist/css/bootstrap3/bootstrap-switch.css" />

<link rel="stylesheet" href="admin/assets/css/alerts/alertify.core.css"/>

<link rel="stylesheet" href="admin/assets/css/alerts/alertify.default.css" id="toggleCSS"/>
<link href="admin/assets/flagsicons/css/flag-icon.css" rel="stylesheet">

<link href="admin/assets/flagsicons/css/docs.css" rel="stylesheet">

<script type="text/javascript" src="admin/assets/jquery-ui-1.12.0/external/jquery/jquery.js"></script>
<script type="text/javascript" src="admin/assets/bootstrap-3.3.7/js/bootstrap.js"></script>
<script type="text/javascript" src="admin/assets/jquery-ui-1.12.0/jquery-ui.min.js"></script>
<!-- Showing alerts -->
<!-- JS library and scripts -->
<!-- Showing alert messages -->
<!-- Alerts -->
<script type="text/javascript">

function reset () {
$("#toggleCSS").attr("href", "admin/assets/css/alerts/alertify.default.css");
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

<?php echo log_message(); ?>
</head>
