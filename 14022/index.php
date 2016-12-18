
<html>  
<head>  
	<title>Kalkulasi IPK</title>  
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
	<script src="https://maxcdn.bo
	otstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
        <link href="./css/mainstyle.css" rel="stylesheet">
</head> 
<body>  
<div class="wrapper-utama">
	<div class="container" style="padding-top:7%; background-color:#fff">  
		<br />  
		<br />  
		<br />  
		<div class="table-responsive">  
			<h3 align="center">Kalkulasi dan Prediksi Indeks Prestasi Kumulatif</h3><br />  
			<div id="live_data"></div>                 
		</div>  
	</div>
	</div>
</body>  
</html>  
<script>  
	$(document).ready(function(){  
		function fetch_data()  
		{  
			$.ajax({  
				url:"select.php",  
				method:"POST",  
				success:function(data){  
					$('#live_data').html(data);  
				}
			});
		}
		fetch_data();  
		$(document).on('click', '#btn_add', function(){  
			var jumlah_SKS = $('#jumlah_SKS').text();  
			var nilai = $('#nilai').text();  
			if(jumlah_SKS == '')  
			{ 
				return false;  
			}  
			if(nilai == '')  
			{ 
				return false;  
			}  
			$.ajax({  
				url:"insert.php",  
				method:"POST",  
				data:{jumlah_SKS:jumlah_SKS, nilai:nilai},  
				dataType:"text",  
				success:function(data)  
				{
					fetch_data();  
				}  
			})  
		});  
		function edit_data(id, text, column_name)  
		{  
			$.ajax({  
				url:"edit.php",  
				method:"POST",  
				data:{id:id, text:text, column_name:column_name},  
				dataType:"text",  
				success:function(data){ 
					fetch_data(); 
				}  
			});  
		}  
		$(document).on('blur', '.jumlah_SKS', function(){  
			var id = $(this).data("id1"); 
			var jumlah_SKS = $(this).text();  
			edit_data(id, jumlah_SKS, "jumlah_SKS");  
		});  
		$(document).on('blur', '.nilai', function(){  
			var id = $(this).data("id2");  
			var nilai = $(this).text();  
			edit_data(id,nilai, "nilai");  
		});  
		$(document).on('blur', '.total_SKS', function(){  
			var id = 1;  
			var nilai = $(this).text();  
			edit_data(id,nilai, "total_SKS");  
		});  
		$(document).on('blur', '.ipk', function(){  
			var id = 1;  
			var nilai = $(this).text();  
			edit_data(id,nilai, "ipk");  
		});  
		$(document).on('click', '.btn_delete', function(){  
			var id=$(this).data("id3");
			$.ajax({  
				url:"delete.php",  
				method:"POST",  
				data:{id:id},  
				dataType:"text",  
				success:function(data){  
					fetch_data();  
				}  
			});  
		});  
	});  
</script>  