<?php $pages=$dbj->query('SELECT social_fanpages.company_name,  social_fanpages.img_icon, social_fanpages.http_direction FROM social_fanpages ORDER BY social_fanpages.http_direction');
?>
<footer class="footer" id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-1 col-sm-1">
                <div class="footer-logo">
                    <a href="index.html">
                        <img src="images/logo.png" alt="">
                    </a>
                </div>
            </div> <!-- /.col-md-4 -->
            <div class="col-md-4 col-sm-4">
                <div class="copyright">
                         Dotrond | Copyright &copy; 2016 |                        
                        <a rel="nofollow" href="#" target="_parent">Dotrond.com</a>
                </div>
            </div> <!-- /.col-md-4 -->
            <div class="col-md-6 col-sm-6">

                <ul class="social-icons">
                <?php 
                    while($row_pages=$pages->fetch(PDO::FETCH_ASSOC)){
                ?>
                <li><a href="<?php echo $row_pages['http_direction'];?>" class="<?php echo  $row_pages['img_icon'];?>" target="_new"></a></li>
                <?php } ?>
                </ul>
            </div> <!-- /.col-md-4 -->
        </div> <!-- /.row -->

    </div><!-- Container -->
</footer>