<title>Hotels System</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicons -->
    <link rel="shortcut icon" href="../images/favicon.png">
    <link rel="apple-touch-icon" href="../images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../images/apple-touch-icon-114x114.png">
    
    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700' rel='stylesheet' type='text/css'>


<!-- Slice Checkbox -->
<link rel="stylesheet" type="text/css" media="all" href="../css/switchery.min.css">
<script type="text/javascript" src="../js/switchery.min.js"></script>

<!-- Crop Image -->
<!-- <script type="text/javascript" src="../js/cropimage/jquery-1.10.2.min.js"></script> -->
<script type="text/javascript" src="../js/cropimage/jquery.form.min.js"></script>

<script type="text/javascript">
$(document).ready(function () {

    $("#date1").datepicker({
        dateFormat: "dd-M-yy",
        inline: true,
        minDate: 0,
        showButtonPanel: true,
        onSelect: function (date) {
            var date2 = $('#date2');
            var startDate = $(this).datepicker('getDate');
            var minDate = $(this).datepicker('getDate');
            date2.datepicker('setDate', minDate);
            startDate.setDate(startDate.getDate() + 30);
            //sets date2 maxDate to the last day of 30 days window
            date2.datepicker('option', 'maxDate', startDate);
            date2.datepicker('option', 'minDate', minDate);
        }
    });
    $('#date2').datepicker({
        dateFormat: "dd-M-yy"
    });
});
</script>

    <script type="text/javascript">
        $(function () {
                $(".birthday").datepicker({
                    dateFormat: 'dd/mm/yy',
                    inline: true,
                    changeMonth: true,
                    changeYear: true,
                    maxDate:0,
                    yearRange: "-120:+0", // last 120 years
                    showButtonPanel: true
                });
            });
    </script>
