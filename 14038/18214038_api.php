<?php
//Jadwal Salat
/////////////////////////////////////////////////////////////////////////////////////////////////
/*NIM/Nama	:Dzaky El Fikri*/
/*Nama file :18214038_api.php*/
/*Tanggal	:14 Desember 2016*/
/////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////
//*Deskripsi:
//Program ini merupakan tugas besar mata kuliah II3160 Pemrograman Integratif
//Program jadwal salat merupakan program berbasis web yang menampilkan jadwal salat untuk beberapa kota di dunia
//Program memperoleh data negara, kota, dan jadwal salat melalui berkas API 18214038_api.php
//Kota yang dilacak hanya kota yang tercantum pada halaman pertama https://islamicfinder.org/world/$negara saja
//untuk mengurangi waktu crawling
//Mesin crawling yang digunakan adalah Simple HTML DOM https://simplehtmldom.sourceforge.net
/////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////
//*Tentang berkas 18214038_api.php:
//Berkas 18214038_api.php memuat API yang digunakan dalam program Jadwal Salat
//Direktori API sama dengan direktori index.php
//Data negara, kota, dan jadwal salat diambil dari https://islamicfinder.org
//Terima kasih Pak Bas, fat han, dan Kopung
/////////////////////////////////////////////////////////////////////////////////////////////////


//Terima kasih Pak Bas, fat han, dan Kopung

include('simple_html_dom.php');	//Mesin crawling https://simplehtmldom.sourceforge.net

/////////////////////////////////////////////////////////////////////////////////////////////////
//API jadwal salat
if(isset($_GET['tautan']))
{	$tautan	=isset($_GET['tautan'])?$_GET['tautan']:"";			//tautan hasil crawling kota
	$html	=file_get_html("https://islamicfinder.org$tautan");	//sumber
	$salat	=$html->find('div[class=todayPrayer]');				//mencari tabel jadwal salat

	//memasukkan data ke tabel
	echo '<table>';
	foreach($salat as $salat)
	{	$item['nama']	=$salat->find('span[class=todayPrayerName]',0)->plaintext;
		$item['waktu']	=$salat->find('span[class=todayPrayerTime]',0)->plaintext;
		echo "<tr>";
		echo "<td>";
		echo $item['nama'];
		echo "</td>";
		echo "<td>";
		echo $item['waktu'];
		echo "</td>";
		echo "</tr>";
	}
	echo '</table>';
	exit();
}
/////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////
//API pilih kota
//Pengguna memilih negara terlebih dahulu	
if(isset($_GET['negara']))	//negara hasil pilihan dropdown
{	$negara	=isset($_GET['negara'])?$_GET['negara']:"";	
	$html	=file_get_html("https://islamicfinder.org/$negara");		//sumber crawling
	$kota	=$html->find("div[class=large-4 medium-4 small-4 columns] a");	//daftar kota

	//membuat pilihan dropdown, jika diklik API jadwal muncul
	echo '<select name="kota" onChange="getJadwal(this.value)">';
	echo '<option selected> </option>';	//Pilihan awal NULL
	
	//Daftar kota untuk negara yang dipilih
	foreach($kota as $kota)
	{	$namaKota=explode("\n",$kota->plaintext)[0];
		$tautan=$kota->getAttribute('href');
		echo '<option value="';
		echo "$tautan";
		echo '">';
		echo "$namaKota";
		echo '</option>';
	}
	
	echo '</select>';
	exit();
}
/////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////
//Meminta daftar negara dari http://islamicfinder.org/world
//Membuat daftar dropdown untuk negara
//Jika negara dipilih, daftar dropdown kota muncul
echo '<select name="negara" id="negara" onChange="getNeg(this.value)">';
echo '<option selected> </option>';											//Pilihan awal NULL
$html	=file_get_html("https://islamicfinder.org/world");					//sumber crawling
$negara	=$html->find('a[href^=/world/]');									//algoritma crawling
	
//memuat daftar negara
foreach($negara as $negara)
{	$daftarNeg=$negara->plaintext;
	$tautanNeg=$negara->getAttribute('href');
	echo '<option value="';
	echo "$tautanNeg";
	echo '">';
	echo "$daftarNeg";
	echo '</option>';
}	
echo "</select>";
exit();
/////////////////////////////////////////////////////////////////////////////////////////////////
?>