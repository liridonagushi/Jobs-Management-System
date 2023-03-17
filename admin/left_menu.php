	<!-- SIDEBAR -->
	<div class="sidebar">

		<nav class="navbar navbar-custom font-alt">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#custom-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
		
				<!-- YOU LOGO HERE -->
				<a class="navbar-brand" href="index.html">
					<!-- IMAGE OR SIMPLE TEXT -->
					<img class="light-logo" src="assets/images/logo-light.png" width="95" alt="">
				</a>
			</div>
		
			<div class="collapse navbar-collapse" id="custom-collapse">
				<ul class="nav navbar-nav">
					<li><a href="index.php"><span class="badge"> <i class="fa fa-home fa-1x" aria-hidden="true"></i></span> Home </a></li>
					<li><a href="lst_companies.php">My Companies <span class="badge"> <?php echo count_companies('',$my_companies=true);?></span> </a></li>
					<li><a href="lst_job_offers.php"> Job Offers <span class="badge"> <?php echo count_job_offers();?></span> </a></li>
          <li><a href="post_link.php?&destination=allcandidates"> All Candidates <span class="badge"> <?php echo count_all_candidates();?></span> </a></li>
          <li><a href="lst_fav_candidates.php"> Favourite Candidates <span class="badge"> <?php echo count_favourite_candidates();?></span> </a></li>

          <li><a href="lst_inbox.php">Messages <span class="badge"> <?php echo count_received_msg();?></span></a></li>

          <!-- styled hr -->
          <hr class="divider-menu" />
          <?php if($_SESSION['jbms_back']['admin_level']==1){?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administration</a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="lst_categories.php">Category Expertises <span class="badge"><?php echo count_cat_exp();?></span> </a></li>
              <li><a href="lst_expertises.php">Expertises Area<span class="badge"><?php echo count_exp_area();?></span> </a></li>
               <li><a href="lst_diploma_types.php">Diploma Types <span class="badge"> <?php echo count_diplomas();?></span> </a></li>
              <li><a href="lst_education_levels.php">Education Levels <span class="badge"><?php echo count_edu_levels();?></span> </a></li>
              <li><a href="lst_experience_levels.php">Experience Levels <span class="badge"><?php echo count_exp_levels();?></span> </a></li>
            </ul>
          </li>
          <li><a href="lst_all_companies.php">All Companies <span class="badge"> <?php echo count_companies();?></span> </a></li>
          <li><a href="lst_users.php">Users</a></li>
          <li><a href="import_data.php">Import Data <i class="fa fa-file-excel-o"></i></a></li>
          <?php } ?>
            <li><a href="account.php">Account Settings</a></li>
          <?php if($_SESSION['jbms_back']['admin_level']==2){?>
          <li><a href="contact_hd.php">Contact HelpDesk</a></li>
          <?php } ?>
					<li><a href="post_logout.php">Logout</a></li>
				</ul>
			</div>
		</nav>
	</div>
	<!-- /SIDEBAR -->