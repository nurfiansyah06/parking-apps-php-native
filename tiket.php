<?php

require_once("dompdf/autoload.inc.php");
include_once('functions.php'); 

use Dompdf\Dompdf;
define("DOMPDF_UNICODE_ENABLED", true);

// get base url for qr code img
$path = explode('/',$_SERVER['REQUEST_URI']);
$path_new = $path[1];
define("BASE_URL", 'http://'.$_SERVER['HTTP_HOST'].'/'. $path_new .'/');

$func = new functions();

$dompdf = new Dompdf();


$id = $_GET['id'];
$rows = $func->detailParkir($id);

$html = '<html><center><h3>Tiket Parkir</h3></center><hr/><br/>';

$html .= "
        <style>
            #nota {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #nota td, #nota th {
                border: 0px solid #ddd;
                padding: 8px;
            }

            #nota tr:nth-child(even){background-color: #f2f2f2;}

            #nota tr:hover {background-color: #ddd;}

            </style>
        ";

foreach ($rows as $row) 
{
$html .= "
        <table id='nota'>
            <tr>
                <td>Kode Parkir</td>
                <td>".$row['code']."</td>
            </tr>
            <tr>
                <td>Nama Kendaraan</td>
                <td>".$row['name']."</td>
            </tr>
            <tr>
                <td>Nomor Kendaraan</td>
                <td>".$row['vehicle_number']."</td>
            </tr>
            <tr>
                <td>Kendaraan Masuk</td>
                <td>".$row['created_at']."</td>
            </tr>
            ";

    if ($row['updated_at'] != NULL) {
        $html .= "<tr>
                <td>Kendaraan Keluar</td>
                <td>".$row['updated_at']."</td>
            </tr>";
    }
            
   $html .= "<tr>
                <td>QR Code</td>
                <td><img src='".BASE_URL."assets/img/temp/".$row['code'].".png'></td>
            </tr>
        </table><br>";   
         
    if ($row['updated_at'] != NULL) {
        $startHour = new DateTime($row['created_at']);
        $endHour = new DateTime($row['updated_at']);

        $result_hour = $startHour->diff($endHour);
        $time_spent = $result_hour->format('%h Jam %i Menit %s Detik');
        
        $costPerHour = 2000;
        $time_spent_new = $result_hour->format('%h');
        $pay = $time_spent_new*$costPerHour;

        $html .= "<h4>Lama Parkir :".$time_spent."</h4>
                  <h4>Jumlah yang harus dibayar : Rp".$pay."</h4>
                ";
    }
}

$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->set_option('isRemoteEnabled', true);
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('Tiket_Parkir.pdf');

?>