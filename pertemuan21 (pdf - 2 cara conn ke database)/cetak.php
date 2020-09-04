<?php

// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();
// Kalau mau landscape tambahkan orientasi
// $mpdf = new \Mpdf\Mpdf([ 'orientation' => 'L']);

// untuk debug tes apa yang keliru
// $mpdf->debug = true;

// Write some HTML code:
// $mpdf->WriteHTML('Hello World');

// kita buat dan gunakan var html
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HALAMAN ADMIN - PDF</title>

    <link rel="stylesheet" href="print.css">
</head>
<body>

    <h1>DAFTAR MAHASISWA</h1>

    <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No.</td>
                <th>Gambar</td>
                <th>NRP</td>
                <th>Nama</td>
                <th>Email</td>
                <th>Jurusan</th>
            </tr>';
            // foreach( $mahasiswa as $row ) {
            
            $i = 1;
            foreach( $mahasiswa as $row ) {
                $html .= '<tr>
                    <td>'. $i .'</td>
                    <td><img src="image/'. $row["gambar"] .'" width="50"></td>
                    <td>'. $row["nrp"] .'</td>
                    <td>'. $row["nama"] .'</td>
                    <td>'. $row["email"] .'</td>
                    <td>'. $row["jurusan"] .'</td>
                </tr>';
            }

$html .= '</table>
</body>
</html>';

$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
// kalau namanya mau diubah tulis di parameter 1,; lalu parameter 2 harus ditulis juga bisa lihat di dokumentasi mpdf di reference
// string Output ( [ string $filename [, string $dest ]) kalau INLINE bisa diganti 'I'
$mpdf->Output('daftar-mahasiswa.pdf', \Mpdf\Output\Destination::INLINE);

?>