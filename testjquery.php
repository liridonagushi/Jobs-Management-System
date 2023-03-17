<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
.container .box {
  float: left;
  width: 150px;
  margin: 20px;
}

.container .box .top {
  padding: 12px;
  background-color: blue;
  color: white;
  cursor: pointer;
}

.container .box .bottom {
  padding: 12px;
  background-color: red;
  color: white;
  display: none;
}

</script>

</head>
<body>
<div class="container">
  <div class="box">
    <div class="top">
      click me
    </div>
    <div class="bottom">
      door #1
    </div>
  </div>
  <div class="box">
    <div class="top">
      click me
    </div>
    <div class="bottom">
      door #2
    </div>
  </div>
  <div class="box">
    <div class="top">
      click me
    </div>
    <div class="bottom">
      door #3
    </div>
  </div>
</div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script>
$('.top').on('click', function() {
  $parent_box = $(this).closest('.box');
  $parent_box.siblings().find('.bottom').hide();
  $parent_box.find('.bottom').toggle();
});
</script>
</html>
