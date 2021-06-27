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
    
    $code = $_GET['code'];
    $func = new functions();

    $rows = $func->transaction($code);

    var_dump($rows);

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
                    <h1 style="margin-top:-30px">Detail Parkir</h1>
                    <div class="row">
                        <div class="col-md-12">
                            <?php foreach($rows as $row) : ?>
                                <label for="code">Kode Parkir Kendaraan :</label>
                                <p><?= $row['code']; ?></p>
                                <label for="name">Nama Kendaraan :</label>
                                <p><?= $row['name']; ?></p>
                                <label for="name">Nomor Kendaraan :</label>
                                <p><?= $row['vehicle_number']; ?></p>
                                <label for="type">Tipe Kendaraan :</label>
                                <p><?= $row['type']; ?></p>
                                <label for="type">Kendaraan Masuk :</label>
                                <p><?= $row['created_at']; ?></p>
                                <label for="type">Kendaraan Keluar :</label>
                                <p><?= $row['updated_at']; ?></p>
                                <?php
                                    $startHour = new DateTime($row['created_at']);
                                    $endHour = new DateTime($row['updated_at']);

                                    $result_hour = $startHour->diff($endHour);
                                    $time_spent = $result_hour->format('%h Jam %i Menit %s Detik');
                                ?>
                                <label for="parkir">Lama Parkir :</label>
                                <p><?= $time_spent; ?></p>
                                <label for="jml">Jumlah yang harus dibayar :</label>
                                <?php
                                    $costPerHour = 2000;
                                    $time_spent_2 = $result_hour->format('%h');
                                    $pay = $time_spent_2*$costPerHour;
                                ?>
                                <p style="font-weight:bold">Rp.<?= $pay ?></p>
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