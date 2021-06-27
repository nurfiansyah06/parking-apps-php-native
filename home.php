<?php   
    include_once('functions.php');  
    if(isset($_POST['logout'])){  
        // remove all session variables  
        session_unset();   
  
        // destroy the session   
        session_destroy();  
    }  
    if(!($_SESSION)){  
        header("Location:index.php");  
    }  
?>

<?= include('layouts/style.php') ?>
<style>
    .card {
        background: #fff;
        padding: 10px;
        height : 200px;
    }

    .card-qr-code {
        background-color : #FFFF00;
        border-radius: 18px
    }
</style>
<body>
    <!-- WRAPPER -->
	<div id="wrapper">
		<?= include('layouts/top_nav.php') ?>
		
        <?= include('layouts/side_nav.php') ?>

		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-qr-code">
                                <div class="card-body qr-code-card">
                                    <a href="#" class="btn btn-primary">Scan QR Code</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <a href="data-parkir.php" class="btn btn-primary">Data Parkir</a>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2021 <a href="https://www.themeineed.com" target="_blank">ParkirApps</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->

    <!-- Javascript -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="assets/vendor/chartist/js/chartist.min.js"></script>
    <script src="assets/scripts/klorofil-common.js"></script>
</body>

</html>