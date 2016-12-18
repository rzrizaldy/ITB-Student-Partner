<!--Jadwal Salat
/////////////////////////////////////////////////////////////////////////////////////////////////
/*NIM/Nama	:Dzaky El Fikri*/
/*Nama file :index.php*/
/*Tanggal	:14 Desember 2016*/
/////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////
/*Deskripsi:
//Program ini merupakan tugas besar mata kuliah II3160 Pemrograman Integratif
//Program jadwal salat merupakan program berbasis web yang menampilkan jadwal salat untuk beberapa kota di dunia
//Program memperoleh data negara, kota, dan jadwal salat melalui berkas API 18214038_api.php
//Mesin crawling yang digunakan adalah Simple HTML DOM https://simplehtmldom.sourceforge.net
/////////////////////////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////////////////////////////////
/*Penggunaan antarmuka:
//Masukan:							Keluaran:
//1.Pengguna memilih negara			Program menampilkan daftar kota untuk negara tersebut
//2.Pengguna memilih kota			Program menampilkan jadwal salat untuk kota tersebut
//////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////
/*Tentang berkas index.php:
//Berkas index.php memuat antarmuka yang digunakan untuk menampilkan data dari API 18214038_api.php
//Direktori API sama dengan direktori index.php
//Antarmuka menggunakan fungsi AJAX untuk menampilkan web dinamis tanpa memuat ulang halaman
//Terima kasih Pak Bas, fat han, dan Kopung
/////////////////////////////////////////////////////////////////////////////////////////////////
-->

<html>
<head>
        <link href="./css/mainstyle.css" rel="stylesheet">
	
</head>
<body>
<div class="wrapper-utama">
<div class="container-utama">
<h1 style="color:#000">Jadwal Shalat</h1>
<h4 style="color:#000">Pilih negara:</h4><br>

<!--API untuk menampilkan jadwal salat-->
<?php
//Fungsi untuk membuat direktori API dinamis
function get_host()
{	$url = $_SERVER['HTTP_HOST'];
	$uri = explode('/',$_SERVER['REQUEST_URI']);
	$uri[sizeof($uri)-1] = '';
	return 'http'.(isset($_SERVER['HTTPS'])?'s':'').'://'.$url.implode('/', $uri);
}
	echo file_get_contents(get_host()."18214038_api.php");	//API dan index.php satu direktori
?>

<br>
<br>
<div id="kota"></div>
<br>
<div id="jadwal"></div>
<br>
</div>
</div>

<script>	<!--Fungsi AJAX untuk menampilkan API tanpa memuat ulang halaman-->
function getNeg(Negara)		//Menampilkan kota
{	var req=new XMLHttpRequest();							
	document.getElementById('kota').innerHTML='Tunggu...';	//Tunggu...
	document.getElementById('jadwal').innerHTML='';
	req.open('GET', '18214038_api.php?negara='+Negara);		//membuka koneksi ke api
	req.send();
	req.onreadystatechange=function()						//Tampilkan ketika mendapat respon
	{	if(req.readyState==4)
		{	document.getElementById('kota').innerHTML='Pilih kota:<br>'+req.responseText;	}
	}
}

function getJadwal(Negara)	//Menampilkan jadwal
{	var req=new XMLHttpRequest();
	document.getElementById('jadwal').innerHTML='Tunggu...';
	req.open('GET', '18214038_api.php?tautan='+Negara);		//membuka koneksi ke api
	req.send();
	req.onreadystatechange=function()
	{	if(req.readyState==4)								//tampilkan ketika mendapat respon
		{	document.getElementById('jadwal').innerHTML='Jadwal Salat:<br>'+req.responseText;	}
	}
}
</script>

</body>
</html>