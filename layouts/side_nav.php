<?php
    $current_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
?>

<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="./home.php" class="<?= $current_page == 'home.php' ? 'active' : '' ?>"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li><a href="./data-parkir.php" class="<?= $current_page == 'data-parkir.php' ? 'active' : '' ?>"><i class="lnr lnr-user"></i> <span>Data Parkir</span></a></li>
                <li><a href="./scan.php" class="<?= $current_page == 'scan.php' ? 'active' : '' ?>"><i class="lnr lnr-location"></i> <span>Scan QR Code</span></a></li>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- END LEFT SIDEBAR -->