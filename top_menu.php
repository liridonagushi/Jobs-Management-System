<?php
 if(isset($_GET['tabmenu']) && $_GET['tabmenu']=='menuhome'){
    $_SESSION['menu_home']="active";
    $_SESSION['menu_jobs']="";
    $_SESSION['menu_search']="";
    $_SESSION['menu_profile']="";
}
if(isset($_GET['tabmenu']) && $_GET['tabmenu']=='jobs'){
    $_SESSION['menu_jobs']="active";
    $_SESSION['menu_home']="";
    $_SESSION['menu_search']="";
    $_SESSION['menu_profile']="";
}
if(isset($_GET['tabmenu']) && $_GET['tabmenu']=='menusearch'){
    $_SESSION['menu_search']="active";
    $_SESSION['menu_jobs']="";
    $_SESSION['menu_home']="";
    $_SESSION['menu_profile']="";
}
if(isset($_GET['tabmenu']) && $_GET['tabmenu']=='profile'){
    $_SESSION['menu_profile']="active";
    $_SESSION['menu_search']="";
    $_SESSION['menu_jobs']="";
    $_SESSION['menu_home']="";
}
?>
   <header id="header">
        <nav id="main-nav" class="navbar navbar-default navbar-fixed-top" role="banner">
        <div class="container-custom-grid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span><span
                    class="icon-bar"></span><span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="overlay"><img src="admin/assets/images/logo/logo.png"></li>
                <li class="<?php echo $_SESSION['menu_home'];?>"><a href="index.php?tabmenu=menuhome"><span class="glyphicon glyphicon-home"></span><?php echo languages($_SESSION['jbms_front']['lang_code'],4);//Home?> </a></li>
                <li class="dropdown <?php echo $_SESSION['menu_jobs'];?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-gears fa-1x" aria-hidden="true"></i><?php echo languages($_SESSION['jbms_front']['lang_code'],5);//Jobs?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="lst_recent_jobs.php?tabmenu=jobs"><?php echo languages($_SESSION['jbms_front']['lang_code'],6);//Recent Jobs?></a></li>
                        <?php if(isset($_SESSION['jbms_front']['admin_level']) && $_SESSION['jbms_front']['admin_level']==3){?>
                        <li><a href="lst_candidatures.php?tabmenu=jobs"><?php echo languages($_SESSION['jbms_front']['lang_code'],7);//Candidatures?></a></li>
                        <li class="divider-msg"></li>
                        <li class="difcolor"><a href="lst_saved_jobs.php?tabmenu=jobs"><?php echo languages($_SESSION['jbms_front']['lang_code'],8);?> <span class="label label-info"><?php echo saved_jobs();?></span></a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="<?php echo $_SESSION['menu_search'];?>"><a href="extended_search.php?tabmenu=menusearch"><i class="fa fa-search fa-1x" aria-hidden="true"></i><?php echo languages($_SESSION['jbms_front']['lang_code'],1);?></a></li>

                <ul class="dropdown-menu" style="min-width: 300px;">
                    <li>
                        <div class="row">
                            <div class="col-md-12">
                                <form class="navbar-form navbar-left" role="search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" />
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">
                                            Go!</button>
                                    </span>
                                </div>
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
                </li>
                </ul>

             <?php if(!empty($_SESSION['jbms_front']['admin_level']) && $_SESSION['jbms_front']['admin_level']==3){?>
                <ul class="nav navbar-nav navbar-right">
                <?php $emails=$dbj->query('SELECT DISTINCT emails.id_to, emails.id_from, users.name, users.surname, emails.time_message, emails.object_title, emails.active_employee FROM emails LEFT JOIN users ON emails.id_from=users.id_user WHERE (emails.id_to="'.$_SESSION['jbms_front']['id_user'].'" OR emails.id_from="'.$_SESSION['jbms_front']['id_user'].'") AND ((emails.id_from !="'.$_SESSION['jbms_front']['id_user'].'") OR (emails.id_from=emails.id_to)) AND active_employee="1" GROUP BY emails.id_from ORDER BY emails.time_message DESC LIMIT 5'); ?>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o fa-1x" aria-hidden="true"></i> Inbox <span class="label label-info"><?php echo $emails->rowCount();?></span>
                        <ul class="dropdown-menu messages12px">
                        <?php
                        if($emails->rowCount()>0){
                        while($row_emails=$emails->fetch(PDO::FETCH_ASSOC)){ ?>
                            <li><a href="view_messages.php?id_user=<?php echo $row_emails['id_from'];?>"><span class="label label-warning"><b><?php echo timetodate($row_emails['time_message']);?></b></span> <span class="label label-info messages12px"><b><b><?php echo $row_emails['name'].' '.$row_emails['surname'];?></b></b></span>
                            <span class="object_title"><?php echo substr($row_emails['object_title'],0,30); ?> ...</span></a></li>
                        <?php } ?>
                            <li class="divider-msg"></li>
                            <li><a href="lst_messages.php" class="text-center"><?php echo languages($_SESSION['jbms_front']['lang_code'],3);//View All?> </a></li>
                            <?php }else{ ?>
                            <li><a  class="text-center"><?php echo languages($_SESSION['jbms_front']['lang_code'],31);//No new messages?> </a></li>
                        <?php } ?>
                        </ul>
                    </li>

                    <li class="dropdown <?php echo $_SESSION['menu_profile'];?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                        class="glyphicon glyphicon-user"></span><?php echo $_SESSION['jbms_front']['name'].' '.$_SESSION['jbms_front']['surname'] ;?><?php echo verify_profile('menu');?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="profile.php?tabmenu=profile"><span class="glyphicon glyphicon-user"></span><?php echo languages($_SESSION['jbms_front']['lang_code'],29);//Profile?> <?php echo verify_profile('menu');?></a></li>
                            <li><a href="account.php?tabmenu=profile"><span class="glyphicon glyphicon-cog"></span><?php echo languages($_SESSION['jbms_front']['lang_code'],30);//Settings?></a></li>
                            <li class="divider-msg"></li>
                            <li><a href="post_logout.php"><span class="glyphicon glyphicon-off"></span><?php echo languages($_SESSION['jbms_front']['lang_code'],32);//Logout?> </a></li>
                        </ul>
                    </li>
                </ul>
                <?php }else{ ?>
                           <ul class="nav navbar-nav navbar-right">
                               <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               <span class="glyphicon glyphicon-user"></span><?php echo languages($_SESSION['jbms_front']['lang_code'],33);//Login?><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="sign.php"><i class="fa fa-user fa-1x" aria-hidden="true"></i><?php echo languages($_SESSION['jbms_front']['lang_code'],28);//Employee Area?> </a></li>
                                    <li class="<?php echo $_SESSION['menu_employer'];?>"><a href="admin/index.php" target="_new"><i class="fa fa-user fa-1x" aria-hidden="true"></i> <?php echo languages($_SESSION['jbms_front']['lang_code'],27);//Employer Area?></a></li>
                                </ul>
                             </li>
                           </ul>
                <?php } ?>
                         <ul class="nav navbar-nav navbar-right">
                          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">



                          <?php $lang=$dbj->query('SELECT * FROM languages WHERE lang_code="'.$_SESSION['jbms_front']['lang_code'].'"');
                                $row_lang=$lang->fetch(PDO::FETCH_ASSOC);
                          ?>
                         
                           <span class="flag-icon flag-icon-<?php echo $row_lang['lang_code'];?>"></span> <?php echo $row_lang['language'];?>
                            <ul class="dropdown-menu">
                                <?php $language=$dbj->query('SELECT * FROM languages WHERE lang_code="'.$_SESSION['jbms_front']['lang_code'].'"');
                                while($row_lang=$language->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <li><a href="process_lan.php?lang_code=<?php echo $row_lang['lang_code'];?>&id_language=<?php echo $row_lang['id_language'];?>"><span class="flag-icon <?php echo $row_lang['img_code'];?>"></span> <?php echo $row_lang['language'];?></a></li>
                                <?php } ?>

                                <?php $languages=$dbj->query('SELECT * FROM languages WHERE lang_code!="'.$_SESSION['jbms_front']['lang_code'].'"'); while($row_langs=$languages->fetch(PDO::FETCH_ASSOC)){ ?>

                                        <li><a href="process_lan.php?lang_code=<?php echo $row_langs['lang_code'];?>&id_language=<?php echo $row_langs['id_language'];?>">
                                            <span class="flag-icon <?php echo $row_langs['img_code'];?>"></span> 
                                            <?php echo $row_langs['language'];?></a>
                                        </li>

                                <?php } ?>
                            </ul>
                       </li>
                    </ul>
            </div>
        </div><!--/.container-->
    </nav><!--/nav-->
</header><!--/header-->

<!-- PRELOADER -->
<!-- <div class="page-loader">
    <div class="loader">Loading...</div>
</div>
 -->
