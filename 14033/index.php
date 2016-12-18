<?php

require 'jadwal_api.php';

$NIMS = array(
	//FMIPA
	 160
	,101
	,102
	,103
	,105
	
	//SITH
	,198
	,104
	,106
	,114
	,115
	,119
	,161
	
	//SF
	,162
	,107
	,116
	
	//FTTM
	,164
	,121
	,122
	,123
	,125
	
	//FITB
	,163
	,120
	,128
	,129
	,151
	
	//FTI
	,167
	,130
	,133
	,143
	,144
	,145
	,195
	
	//STEI
	,165
	,132
	,135
	,180
	,181
	,182
	,183

	//FTMD
	,169
	,131
	,136
	,137
	
	//FTSL
	,196
	,150
	,153
	,155
	,157
	,158
	,166
	
	//SAPPK
	,199
	,152
	,154

	//FSRD
	,168
	,170
	,171
	,172
	,173
	,174
	,175
	,179

	//SBM
	,190
	,192
	,197
	);

$faks = array(
	"FMIPA" 	=> array(160,101,102,103,105),
	"SITH" 		=> array(198,104,106,114,115,119,161),
	"SF" 		=> array(162,107,116),
	"FTTM" 		=> array(164,121,122,123,125),
	"FITB" 		=> array(163,120,128,129,151),
	"FTI" 		=> array(167,130,133,143,144,145,195),
	"STEI" 		=> array(165,132,135,180,181,182,183),
	"FTMD" 		=> array(169,131,136,137),
	"FTSL" 		=> array(166,196,150,153,155,157,158),
	"SAPPK" 	=> array(199,152,154),
	"FSRD" 		=> array(168,170,171,172,173,174,175,179),
	"SBM" 		=> array(190,192,197)	
	);

$arr=array();
foreach ($NIMS as $v) {
	$arr=array_merge($arr, get_tutorial($v));
}
file_put_contents('arr.json', print_r($arr, true));

$jurList = array();

if (isset($_POST['faklist'])) {
	$jurList = $faks[$_POST['faklist']];
	$arr = get_tutorial($jurList[0]);
} 

if (isset($_POST['jurlist'])) {
	$arr = get_tutorial($_POST['jurlist']);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Jadwal Tutorial ITB</title>
	<style>
		table,th,td {
			border: 0.5px solid black;
		}
		th:hover {background-color: #f5f5f5}
	</style>
</head>
<body>
	<form action="" method="post">
		<select name="faklist" onchange="this.form.submit()">
			<option value="PILIH" seleted="selected"> Pilih Fakultas </option>
			<option value="FMIPA"> FMIPA </option>
			<option value="SITH"> SITH </option>
			<option value="SF"> SF </option>
			<option value="FTTM"> FTTM </option>
			<option value="FITB"> FITB </option>
			<option value="FTI"> FTI </option>
			<option value="STEI"> STEI </option>
			<option value="FTMD"> FTMD </option>
			<option value="SAPPK"> SAPPK </option>
			<option value="FSRD"> FSRD </option>
			<option value="SBM"> SBM </option>
		</select>
	</form>

	<form action="" method="post">
		<select name="jurlist" onchange="this.form.submit()">
			<?php foreach ($jurList as $key => $value) : ?>
				<option value="<?php echo $value ?>"><?php echo $value ?></option>
			<?php endforeach ?>
		</select>
	</form>
	<table style="width:100%">
		<tr>
			<th>Kode Kuliah</th>
			<th>Nama Mata Kuliah</th>
			<th>SKS</th>
			<th>Nomor Kelas</th>
			<th>Dosen</th>
			<th>Jadwal (HARI-JAM-RUANG-KEGIATAN)</th>
		</tr>
		<?php foreach ($arr as $elmt) : ?>
			<tr>
			<?php foreach ($elmt as $key => $value) : ?>
				<td><?php echo $value ?></td>
			<?php endforeach ?>
			</tr>
		<?php endforeach ?>
	</table>
</body>
