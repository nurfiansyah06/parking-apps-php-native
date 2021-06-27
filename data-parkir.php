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

    $rows = $func->getDataParkir();

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
                    <h1 style="margin-top:-30px">Data Parkir</h1>
                    <div class="row">
                        <div class="col-md-12">
                        
                            <div class="row">
                                <?php 
                                    $qty = 100;
                                    foreach($rows['count_parkir'] as $jml) : 
                                ?>
                                <div class="col-xs-6">
                                    <a href="tambah-parkir.php" class="btn btn-primary" style="display:<?= intval($jml) >= $qty ? 'none' : '' ?>">Tambah Data Parkir</a>
                                </div>
                                
                                <div class="col-xs-6">
                                    <p style="font-weight:bold;float: right;display:<?= intval($jml) >= $qty ? 'none' : '' ?>">Parkir yang masih tersedia : <?php echo $qty - intval($jml) ?></p>
                                </div>
                            </div>
                                <?php if(intval($jml) >= $qty) : ?>
                                <div class="alert alert-warning alert-dismissible" style="margin-top: 20px" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <i class="fa fa-warning"></i> Parkir Penuh
                                </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Kode Parkir</th>
                                        <th scope="col">Nama Kendaraan</th>
                                        <th scope="col">Tipe Kendaraan</th>
                                        <th scope="col">Nomor Kendaraan</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($rows['data'] as $row) : ?>
                                    <tr>
                                        <th scope="row"><?= $i ?></th>
                                        <td><?= $row['code'] ?></td>
                                        <td><?= $row['name'] ?></td>
                                        <td><?= $row['type'] ?></td>
                                        <td><?= $row['vehicle_number'] ?></td>
                                        <td>
                                            <?php 
                                                if ($row['updated_at'] == NULL) {
                                                    echo 'Kendaraan Masuk';
                                                } else {
                                                    echo 'Kendaraan Keluar';
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="detail-parkir.php?id=<?php echo $row["id"] ?>">Detail</a>
                                            <?php
                                                if ($row['updated_at'] == NULL) {
                                                    echo '<a class="btn btn-warning" href="ubah.php?id='.$row['id'].'">Ubah</a>';
                                                }
                                            ?>
                                            <a class="btn btn-danger" href="delete-parkir.php?id=<?php echo $row["id"] ?>" onclick="return confirm('Apakah Anda yakin akan menghapus data?')">Hapus</a>
                                        </td>
                                    </tr>
                                   <?php $i++; ?>
                                   <?php endforeach; ?>
                                </tbody>
                            </table>
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