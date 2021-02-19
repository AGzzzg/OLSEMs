<?php
$config = include('db/config.php');
?>
<div class="footer-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <span class="footer-copyright">Copyright 2020, <a href="#">Protrader</a>. All Rights
                    Reserved.</span>
            </div><!-- .col -->
            <div class="col-md-5 text-md-right">
                <ul class="footer-links">
                    <li><a href="policy.html">Privacy Policy</a></li>
                    <li><a href="policy.html">Terms of Use</a></li>
                </ul>
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</div>
<!-- FooterBar End -->

<!-- JavaScript (include all script here) -->
<script src="<?php echo $config['dashboardPath'] ?>/dashboard/assets/js/jquery.bundle.js?ver=101"></script>
<script src="<?php echo $config['dashboardPath'] ?>/dashboard/assets/js/vendor/clipboard.min.js?ver=101"></script>
<script src="<?php echo $config['dashboardPath'] ?>/dashboard/assets/js/script.js?ver=101"></script>
<script src="<?php echo $config['dashboardPath'] ?>/dashboard/assets/js/chartjs/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="<?php echo $config['dashboardPath'] ?>/dashboard/assets/js/image.js"></script>