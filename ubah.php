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

    $id = $_GET['id'];

    $func = new functions();

    $detail = $func->detailParkir($id);
    if (isset($_POST["submit"])) {
        if ($func->addEditDataParkir($_POST) > 0){
                echo "
                <script>
                alert('Data BERHASIL diubah');
                document.location.href = 'data-parkir.php';
            </script>
            ";
        }
        else {
            die('ERROR: data gagal '.$data_parkir.': '. mysqli_error($data_parkir));
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
                    <h1 style="margin-top:-30px">Tambah Data Parkir</h1>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="post">
                                <?php foreach($detail as $d) : ?>
                                <input type="hidden" name="user_id" value="<?= $_SESSION['id']?>">
                                <input type="hidden" name="created_at" value="<?php echo date("Y-m-d\TH:i:s"); ?>" readonly="readonly">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Kendaraan :</label>
                                    <input type="name" class="form-control" name="name" value="<?= $d['name'] ?>" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nomor Kendaraan :</label>
                                    <input type="name" class="form-control" value="<?= $d['vehicle_number'] ?>" name="vehicle_number" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tipe Kendaraan</label>
                                    <select class="custom-select form-control" name="type">
                                        <?php

                                        if ($d['type'] == "Motor") echo "<option value='Motor' selected>Motor</option>";
                                        else echo "<option value='Motor'>Motor</option>";
                                        
                                        if ($d['type'] == "Mobil") echo "<option value='Mobil' selected>Mobil</option>";
                                        else echo "<option value='Mobil'>Mobil</option>";
       
                                        ?>
                                    </select>
                                </div>
                                <input type="submit" name="submit" value="Submit" class="btn btn-success">
                                <?php endforeach; ?>
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
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="assets/vendor/chartist/js/chartist.min.js"></script>
    <script src="assets/scripts/klorofil-common.js"></script>
</body>

</html>