<?php 


// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
	header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
	header('Access-Control-Allow-Credentials: true');
	header('Access-Control-Max-Age: 86400');    // cache for 1 day
}
// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         
	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
		header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
}

require 'Connection.php';
error_reporting(0);
class Makanan{
	var $QUERY="";
	var $arr;
	var $gizi_db;
	
	function __construct($q=''){
		$this->gizi_db = new Connection();
		$q=implode("+", explode(' ', $q));
		$this->QUERY=$q;
	}

	function list_fatscreet_id(){
		$hasil = array();
		$isi=file_get_contents('http://www.fatsecret.co.id/kalori-gizi/search?q='.$this->QUERY);

		//cek apakah ada hasilnya
		$idx=strrpos($isi, '<table class="generic searchResult">');
		if($idx===false)return $hasil;

		//mencari jumlah halaman
		$idx2=strrpos($isi, '<div class="searchResultSummary">');
		$idx3= strpos($isi, ' dari ', $idx2);
		$idx4= strpos($isi, ' ', $idx3+6);
		$r=substr($isi, $idx3+6, $idx4-$idx3-6);
		$r=($r/10|0);//jumlah halaman

		//cari konten di tiap halaman
		for($i=0;$i<=min(2,$r);$i++){//max 2 halaman
			if($i>0)$isi=file_get_contents('http://www.fatsecret.co.id/kalori-gizi/search?pg='.$i.'&q='.$this->QUERY);

			$idx=strrpos($isi, '<table class="generic searchResult">');
			if($idx!==false){
				$konten=explode('<a class="prominent" href="', $isi);
				for($ii=1;$ii<sizeof($konten);$ii++ ){

					//id (url)
					$id=substr($konten[$ii],13 , strpos( $konten[$ii],'"')-13);

					//nama makanan
					$nama	=substr($konten[$ii],   strpos($konten[$ii], '>')+1, strpos($konten[$ii], '<')-strpos($konten[$ii], '>')-1 );

					//ukuran
					preg_match('/per .+ - Kalori/', $konten[$ii], $kalori, PREG_OFFSET_CAPTURE);
					if($kalori!==false){
						$param1=$kalori[0][0];
						//var_dump($kalori);
						$ukuran=substr($param1,4, strrpos($param1," - Kalori" )-4 ) ;
					}

					//kalori
					preg_match('/Kalori: .+kkal/', $konten[$ii], $kalori, PREG_OFFSET_CAPTURE);
					if($kalori!==false){
						$param1=$kalori[0][0];
						$kalori=substr($param1,8, strrpos($param1,"kkal" )-8 ) ;
					}

					//lemak
					preg_match('/Lemak: .+g/', $konten[$ii], $lemak, PREG_OFFSET_CAPTURE);
					if($lemak!==false){
						$param1=$lemak[0][0];
						$lemak=substr($param1,7, strpos($param1,"g")-7 ) ;
						$lemak=implode('.', explode(',', $lemak));
					}
					//echo ($lemak)."<br/>";

					//karbohidrat
					preg_match('/Karb: .+g/', $konten[$ii], $protein, PREG_OFFSET_CAPTURE);
					if($protein!==false){
						$param1=$protein[0][0];
						$protein=substr($param1,6, strpos($param1,"g")-6 ) ;
						$karbohidrat=implode('.', explode(',', $protein));
					}
					//echo ($karbohidrat)."<br/>";

					//protein
					preg_match('/Prot: .+g/', $konten[$ii], $protein, PREG_OFFSET_CAPTURE);
					if($protein!==false){
						$param1=$protein[0][0];
						$protein=substr($param1,6, strpos($param1,"g")-6 ) ;
						$protein=implode('.', explode(',', $protein));
					}
					//echo ($protein)."<br/>";

					//echo"<br/>";
					array_push($hasil, 
						array(
							"id"=>$id,
							"nama"=>(explode('/', $id)[0]!="umum"?"(".explode('/', $id)[0].") ":"" ).$nama,
							"lemak"=>$lemak*1,
							"karbohidrat"=>$karbohidrat*1,
							"protein"=>$protein*1,
							"ukuran"=>$ukuran
						)
					);
				}
			}
		}
		$this->arr=$hasil;
		return $hasil;
	}

//*
	function get_from_db(){
		$a=$this->QUERY;
		$hasil=array();
		$s=$this->gizi_db->query("SELECT * FROM Cari WHERE query='$a' ");
		if($s->num_rows==0)
		{
			$hasil = $this->list_fatscreet_id();
			foreach ($hasil as $v) {
				$this->gizi_db->query("INSERT INTO Makanan VALUES('"
					.$v['id']."', '"
					.$v['nama']."', '"
					.$v['ukuran']."', '"
					.$v['lemak']."', '"
					.$v['karbohidrat']."', '"
					.$v['protein']."') ");

				$this->gizi_db->query("INSERT INTO Cari VALUES( '$a' ) ");
				$this->gizi_db->query("INSERT INTO pencarian VALUES( '$a' , '".$v['id']."' ) ");
			}
		}else{
			$makanan = $this->gizi_db->query("SELECT * FROM pencarian, Makanan WHERE pencarian.id_makanan=Makanan.id_makanan AND query='$a' ");
			while($row = mysqli_fetch_array($makanan,1)){
				array_push($hasil, array(
					 "id"=>$row['id_makanan']
					,"nama"=>$row['nama']
					,"ukuran"=>$row['ukuran']
					,"lemak"=>$row['lemak']
					,"karbohidrat"=>$row['karbohidrat']
					,"protein"=>$row['protein']
				));
			}
			//print_r($makanan);
		}
		//var_dump($hasil);
		$this->arr=$hasil;
		
	}//**///

	function array_js($arr){
		if(is_array($arr)){
			echo "[";
			$i=0;
			foreach ($arr as $key => $value) {
				$this->array_js($value);
				if(++$i!=sizeof($arr))echo(',');
			}
			echo "]";
		}else{
			echo '"'.$this->html_text($arr).'"';
		}
	}

	function export_array(){
		$this->array_js($this->arr);
	}


	function export_json(){
		echo(json_encode($this->arr));
	}

	function html_text($a){
		$b=["\\"	,"<"	,"\""	,"'"];
		$c=["&#92;"	,"&lt;"	,"&#34;","&#39;"];
		for($i=0;$i<sizeof($b);$i++){
			$a=explode($b[$i], $a);
			$a=implode($c[$i], $a);
		}

		return $a;
	}

}

if(isset($_GET['fd'])){
	$mak = new Makanan($_GET['fd']);
	//$mak->list_fatscreet_id();
	$mak->get_from_db();
	$mak->export_json();

}

//echo (date("d-M-Y h:i:s")) ;

?>