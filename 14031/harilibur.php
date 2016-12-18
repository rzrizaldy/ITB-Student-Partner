<?php

function bacaHTML($url){
     // inisialisasi CURL
     $data = curl_init();
     // setting CURL
     curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($data, CURLOPT_URL, $url);
     // menjalankan CURL untuk membaca isi file
     $hasil = curl_exec($data);
     curl_close($data);
     return $hasil;
}

$kodeHTML =  bacaHTML('http://kalender.web.id/2017.html');
$pecah = explode('<tbody>', $kodeHTML);

$pecahLagi = explode('</tbody>', $pecah[1]);

echo "<hr>";
echo "Jadwal Hari Libur Nasional 2017";
echo "<hr>";
echo "<table border='1'>";
echo "<tr><td>Tanggal</td><td>Hari</td><td>Hari Libur</td><td>Keterangan</td></tr>";
echo $pecahLagi[0];
echo "</table>";
?>
