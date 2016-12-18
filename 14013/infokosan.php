<?php

include('simple_html_dom.php');

//Membuat array
$kosan_favorit = array();
$kosan_terbaru = array();


for($i=1;$i<=2;$i++) {
	$next = "http://beta.e-kosan.com/index.php?hal=" . $i;
	//load file from url
	$html = file_get_html($next);

	$kosan = $html->find('div[class="box box-success]');

	//KOSAN FAVORIT
	//Proses find element
	$kategori="";
	foreach ($kosan as $kosans) {
		$alamat = $kosans->find('a[href] tr td text',0);
		$harga = $kosans->find('b span[class="style2"] text',0);
		$kampus = $kosans->find('span[class="label label-primary"] text',0);
		$kategori = $kosans->find('span[class="label label-danger"] text',0);
		$link ="http://beta.e-kosan.com/".($kosans->find('a[href]',0)->href);
		$fasilitas = $kosans->find('div[class="col-md-7"] text',0);

		//Memasukkan ke array
		array_push($kosan_favorit, array(
			"alamat"=>$alamat->_[4]
			,"harga"=>$harga->_[4]
			,"kampus"=>$kampus->_[4]
			,"kategori"=>$kategori->_[4]
			,"link"=>$link
			,"fasilitas"=>isset($fasilitas->_[4])?$fasilitas->_[4]:''
			
		));
	
	}

	//KOSAN
	$kosan2 = $html->find('div[class="box box-danger]');

	//Proses find element
	foreach ($kosan2 as $kosans2) {
		$alamat = $kosans2->find('a[href] tr td text',0);
		$harga = $kosans2->find('b span[class="style2"] text',0);
		$kampus = $kosans2->find('span[class="label label-primary"] text',0);
		$kategori = $kosans2->find('span[class="label label-danger"] text',0);
		$link ="http://beta.e-kosan.com/".($kosans2->find('a[href]',0)->href);
		$fasilitas = $kosans2->find('div[class="col-md-7"] text',0);

		//Memasukkan ke array
		array_push($kosan_terbaru, array(
			"alamat"=>$alamat->_[4]
			,"harga"=>$harga->_[4]
			,"kampus"=>$kampus->_[4]
			,"kategori"=>$kategori->_[4]
			,"link"=>$link
			,"fasilitas"=>isset($fasilitas->_[4])?$fasilitas->_[4]:''
		));
	}
}	
	// Clear DOM object
    $html->clear();
    unset($html);



$array_gab = array_merge($kosan_favorit, $kosan_terbaru);
$array_unik=array();
foreach ($array_gab as $v) {
	if(array_search($v, $array_unik)==false){
		$array_unik[$v['alamat']]=$v;
	}
}
echo json_encode($array_unik);

?>