<!DOCTYPE html>
<html>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
<!-- Template core CSS -->
<title><?php echo title_back_module();?></title>
<!-- Latest compiled and minified JavaScript -->

<!-- Icon Fonts -->
<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />

<link rel="stylesheet" href="assets/bootstrap-3.3.7/css/bootstrap.css" />
<link rel="stylesheet" href="assets/jquery-ui-1.12.0/jquery-ui.css" />

<link rel="stylesheet" href="assets/css/admin_style.css" />

<!-- Bootstrap core CSS -->
<link rel="stylesheet" type="text/css" href="assets/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />

<link rel="stylesheet" href="assets/bootstrap-switchery/dist/css/bootstrap3/bootstrap-switch.css" />

<link rel="stylesheet" href="assets/css/alerts/alertify.core.css"/>

<link rel="stylesheet" href="assets/css/alerts/alertify.default.css" id="toggleCSS"/>

<script type="text/javascript" src="assets/jquery-ui-1.12.0/external/jquery/jquery.js"></script>
<script type="text/javascript" src="assets/bootstrap-3.3.7/js/bootstrap.js"></script>
<script type="text/javascript" src="assets/jquery-ui-1.12.0/jquery-ui.min.js"></script>
<!-- Showing alerts -->
<!-- JS library and scripts -->
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

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>

<?php echo log_message(); ?>
</head>

