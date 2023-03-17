<?php
// Including functions
require_once('assets/include/functions.php');

// Name of the module !important
$module=basename($_SERVER["SCRIPT_NAME"]);

// Name of the file !important
$filename=basename(__FILE__, '.php');

//Including Variables
require_once('assets/include/variables.php');
  
  $jobs=$dbj->query('SELECT job_offers.id_company, companies.company_name, companies.company_sn, COUNT(job_candidatures.id_job) AS jobcandidatures, companies.id_employer, companies.company_name FROM companies LEFT JOIN job_offers ON companies.id_company=job_offers.id_company LEFT JOIN job_candidatures ON job_offers.id_job=job_candidatures.id_job WHERE companies.id_employer="'.$_SESSION['jbms_back']['id_user'].'" GROUP BY job_candidatures.id_job ORDER BY jobcandidatures');

  // Verify connected admin
  login_twoadmin();

// Including header content
require_once('assets/css_header.php');
?>

   <script type="text/javascript" src="assets/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([

        ['Companies', 'Applications'],
        <?php
        while($row_jobs=$jobs->fetch(PDO::FETCH_ASSOC)){ ?>
        ['<?php echo $row_jobs['company_name'];?>', '<?php echo $row_jobs['jobcandidatures'];?>'],<?php } ?>]);

        var options = {
        width: 1200,
        height: 400,
      
        backgroundColor: {
            fill: '#49b5e7'
        },
        legend: {
            position: 'none'
        },
        chart: {
            title: 'Company jobs and candidatures',
            subtitle: 'Google Graphs Script'
        },
        bars: 'horizontal', // Required for Material Bar Charts.
        axes: {
            x: {
                0: {
                    side: 'bottom',
                    label: 'Applications'
                } // Top x-axis.
            }
        },
        bar: {
            groupWidth: "90%"
        },
            animation: {
                duration: 25500,
                startup: true
              }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>
<body>
<!-- PRELOADER -->
<div class="page-loader">
  <div class="loader">Loading...</div>
</div> 
<!-- Including menu -->
<?php  include('left_menu.php'); ?>

<!-- Content side content -->
<div class="content">

<!-- Search -->
<div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <h4 class="margintop40px"><b><i class="fa fa-file-o"></i> My Companies and Candidatures</b></h4>
    </div>
  </div>
</div>
      <hr class="divider-menu">

<!-- Module showing results -->
<section id="module">
<div class="container">

				<div class="row">
          <div class="col-sm-12 text-center">
			     	<div id="top_x_div" style="width: 820px; height: 500px;"></div>
          </div>
       </div>
</div>
</section>
</div>

  <!-- Including Footer file -->
  <?php require_once('footer.php');?>
<!-- /WRAPPER -->
</div>

<!-- Including Footer file -->
<?php echo file_get_contents('assets/js_bottom.php');?>

</body>
</html>