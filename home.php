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
    .panel {
        border-radius : 8px;
        width: 70%;
        height: 150px;
        border: none!important;
    }

    .btn {
        margin-top: 45px;
    }

    .color-panel {
        background-image: linear-gradient(to right, rgba(77, 5, 232, 1), rgba(44, 130, 201, 1))
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
				<div class="container-fluid">
                        <h1>Dashboard Menu</h1>
                        <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel color-panel">
                                <div class="panel-body text-center">
                                    <a href="scan.php" class="btn btn-primary" >Scan QR Code</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel color-panel">
                                <div class="panel-body text-center">
                                    <a href="data-parkir.php" class="btn btn-primary" >Data Parkir</a>
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
				<p class="copyright">&copy; 2021 <a href="" target="_blank">ParkirApps</a>. All Rights Reserved.</p>
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