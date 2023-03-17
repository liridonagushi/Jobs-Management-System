<!-- PRELOADER -->
<div class="page-loader">
  <div class="loader">Loading</div>
</div>
<!-- Showing alert messages -->
<?php echo log_message(); ?>
<!-- JS library and scripts-->
<!-- Alerts -->

<!-- JS Slice Switching -->
<script type="text/javascript">
$(document).ready(function() {
  $('[type="checkbox"]').bootstrapSwitch();
})
</script>
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

// Fancy Box Script
$(document).ready(function() {
$(".fancybox").fancybox({
   padding : 0,
   width : "1050",
  'afterClose':function () {
  window.location.reload();
  },
});

// Fancy Box Script
$(".fancybox1").fancybox({
   padding : 0,
   width : "650",
  'afterClose':function () {
  window.location.reload();
  },
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


<script type="text/javascript" src="assets/js/alerts/alertify.min.js"></script>
<script type="text/javascript" src="assets/fancybox/jquery.fancybox.js?v=2.1.5"></script>
<script type="text/javascript" src="assets/js/validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/bootstrap-switchery/dist/js/bootstrap-switch.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>



</body>
</html>
