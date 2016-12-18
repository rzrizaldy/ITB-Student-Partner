<?php  
$connect = mysqli_connect("sql6.freemysqlhosting.net:3306", "sql6148702", "8aFhLJv1bj", "sql6148702");  
$output = '';  
$sql = "SELECT * FROM tbl_indeks ORDER BY id ASC";  
$result = mysqli_query($connect, $sql);  

function score_calculation($jumlah_SKS, $nilai){
  $nilainumb;
  if ($nilai == 'A') {
    $nilainumb = 4;
  } else if ($nilai == 'AB'){
    $nilainumb = 3.5;
  } else if ($nilai == 'B'){
    $nilainumb = 3;
  } else if ($nilai == 'BC'){
    $nilainumb = 2.5;
  } else if ($nilai == 'C'){
    $nilainumb = 2;
  } else if ($nilai == 'D'){
    $nilainumb = 1;
  } else {
    $nilainumb = 0;
  }
  return $jumlah_SKS * $nilainumb;
}

$sum_SKS = 0;
$totalscore = 0;
while($row = mysqli_fetch_array($result)){
  $sum_SKS += $row['jumlah_SKS'];
  $totalscore += score_calculation($row['jumlah_SKS'],$row['nilai']);
}

$sql2 = "SELECT * FROM tbl_total ORDER BY id ASC"; 
$result = mysqli_query($connect, $sql2);  
while($row = mysqli_fetch_array($result)){
  $ipk = $row['ipk'];
  $sks = $row['total_SKS'];
}

if ($sum_SKS != 0){
  $indeks = ( $totalscore + ($ipk * $sks) )/( $sum_SKS + $sks);

} else {
  $indeks = 0;
}

$indeks = round($indeks, 2);

$result = mysqli_query($connect, $sql);  

$output .= '  

<div class="table-responsive">
  <table class="table table-bordered">
    <tr>
      <th>Jumlah SKS yang telah diambil</th>
      <th>IPK sementara</th>
    </tr>
    <tr>
      <td class="total_SKS" contenteditable>'.mysqli_fetch_array(mysqli_query($connect, "SELECT total_SKS FROM tbl_total WHERE id = 1"))['total_SKS'].'</td>
      <td class="ipk" contenteditable>'.mysqli_fetch_array(mysqli_query($connect, "SELECT ipk FROM tbl_total WHERE id = 1"))['ipk'].'</td>
    </tr>
  </table>
</div>

<div class="table-responsive">  
 <table class="table table-bordered">  
  <tr>  
   <th width="10%">No</th>  
   <th width="40%">Jumlah SKS</th>  
   <th width="40%">Nilai</th>  
   <th width="10%">Aksi</th>  
 </tr>';  
 if(mysqli_num_rows($result) > 0)  
 {  
  $no=0;
  while($row = mysqli_fetch_array($result))  
  {  
   $output .= '  
   <tr>  
     <td>'.++$no.'</td>  
     <td class="jumlah_SKS" data-id1="'.$row["id"].'" contenteditable>'.$row["jumlah_SKS"].'</td>  
     <td class="nilai" data-id2="'.$row["id"].'" contenteditable>'.$row["nilai"].'</td>  
     <td><button type="button" name="delete_btn" data-id3="'.$row["id"].'" class="btn btn-xs btn-danger btn_delete">x</button></td>  
   </tr>  
   ';  
 }
 $output .= '  
 <tr>  
  <td></td>  
  <td id="jumlah_SKS" contenteditable></td>  
  <td id="nilai" contenteditable></td>  
  <td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>  
</tr>
<tr>
  <td colspan=2>Hasil IPK</td>
  <td>'.$indeks.'</td>
</tr>
';  
}  
else  
{  
  $output .= '  
  <tr>  
    <td></td>  
    <td id="jumlah_SKS" contenteditable></td>  
    <td id="nilai" contenteditable></td>  
    <td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>  
  </tr>  
  <tr>
    <td colspan=2>Hasil IPK</td>
    <td>'.$indeks.'</td>
  </tr>
  ';    
}  
$output .= '</table>  
</div>';  
echo $output;  
?>  