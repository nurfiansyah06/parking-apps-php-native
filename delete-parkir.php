<?php

include_once('functions.php');

$func = new functions();

$id = $_GET["id"];

if ($func->deleteDataParkir($id) > 0){
    echo "
        <script>
            alert('Data Berhasil dihapus');
            document.location.href = 'data-parkir.php';
        </script>
        ";
}
else{
    echo "
        <script>
            alert('Data GAGAL dihapus');
            document.location.href = 'data-parkir.php';
        </script>
        ";
}

?>