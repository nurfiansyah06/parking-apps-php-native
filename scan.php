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

    $func = new functions();
    
    if (isset($_POST["submit"])) {
        if ($func->updateTime($_POST) > 0){
            header("Location:transaksi.php?code=".$_POST['code']); 
        }
        else {
            die('ERROR: data gagal '.$data.': '. mysqli_error($data));
        }
    }

?>

<style>

</style>
<?= include('layouts/style.php') ?>

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
                    <h1 style="margin-top:-30px">Scan QRCode Parkir</h1>
                    <div class="row">
                        <div class="col-md-6">
                            <video id="preview" width="100%"></video>
                        </div>
                        <div class="col-md-6">
                            <form action="" method="post">
                                <label>SCAN QR CODE</label>
                                <input type="text" name="code" id="text" readonyy="" placeholder="scan qrcode"
                                    class="form-control">
                                <input type="submit" name="submit" value="SUBMIT" class="btn btn-primary" style="margin-top:20px">
                            </form>
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
                <p class="copyright">&copy; 2021 <a href="https://www.themeineed.com" target="_blank">ParkirApps</a>.
                    All Rights Reserved.</p>
            </div>
        </footer>
    </div>
    <!-- END WRAPPER -->

    <!-- Javascript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="assets/vendor/chartist/js/chartist.min.js"></script>
    <script src="assets/scripts/klorofil-common.js"></script>
    <script>
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
        });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert('No cameras found');
            }

        }).catch(function (e) {
            console.error(e);
        });

        scanner.addListener('scan', function (c) {
            document.getElementById('text').value = c;
        });
    </script>
</body>

</html>