<?php   
    //library phpqrcode
    include "phpqrcode/qrlib.php";
    
    $tempdir = "assets/img/temp/"; 
    if (!file_exists($tempdir))
    mkdir($tempdir);
    

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

    $id = $_GET['id'];
    $rows = $func->detailParkir($id);

    

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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h1>Detail Parkir</h1>
                                        </div>
                                        <?php foreach($rows as $row) : ?>
                                        <div class="col-md-6">
                                            <a href="tiket.php?id=<?= $row['id']; ?>" class="btn btn-danger"
                                                style="float:right;margin-top: 15px">PRINT NOTA</a>
                                        </div>
                                    </div>
                                    <hr style="margin: 0">
                                </div>
                                <div class="panel-body">
                                    <label for="code">Kode Parkir Kendaraan :</label>
                                    <p><?= $row['code']; ?></p>
                                    <label for="name">Nama Kendaraan :</label>
                                    <p><?= $row['name']; ?></p>
                                    <label for="type">Tipe Kendaraan :</label>
                                    <p><?= $row['type']; ?></p>
                                    <label for="type">Kendaraan Masuk :</label>
                                    <p><?= $row['created_at']; ?></p>
                                    <label for="type">QR Code :</label><br>
                                    <?php
                                        //Isi dari QRCode Saat discan
                                        $isi_teks = $row['code'];
                                        //Nama file yang akan disimpan pada folder temp 
                                        $namafile = $row['code'].".png";
                                        //Kualitas dari QRCode 
                                        $quality = 'H'; 
                                        //Ukuran besar QRCode
                                        $ukuran = 8; 
                                        $padding = 0; 
                                        QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);
                                    ?>
                                    <img src="assets/img/temp/<?php echo $namafile; ?>">
                                    <?php endforeach; ?>
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
                <p class="copyright">&copy; 2021 <a href="https://www.themeineed.com" target="_blank">ParkirApps</a>.
                    All Rights Reserved.</p>
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