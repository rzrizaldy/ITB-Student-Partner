<html>
   
   <head>
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pendaftaran Antrean Dokter di RS Borromeus</title>
        <link href="./css/bootstrap.min.css" rel="stylesheet">
        <link href="./css/stylelogin.css" rel="stylesheet">
   </head>
   
   <body>
	  <div class="wrapperlogin" align = "center">
        <div class='containerlogin'>
            <div class="ball"></div>
            <div class="ball"></div>
            <div class="ball"></div>
            <div class="ball"></div>
            <h3 style="color:#fff"> Berikut ini daftar antrean untuk dokter dan spesialis pilihanmu</h3>
            <h5 style="color:#fff"> Silahkan datang sesuai urutan</h5>
               <form action = "" method = "post">
					<?php

						$server = "sql6.freemysqlhosting.net";
						$database = "sql6149740";
						$username  = "sql6149740";
						$password = "C8maZbYiXA";

						// Buka koneksi
						$conn = new mysqli($server, $username, $password, $database);
						// Cek koneksi
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						} 

							// Masukan data
							if (isset($_POST['submit'])){
									$namaLengkap = $_POST['fullname'];
									$telepon = $_POST['phone'];
									$spesialis = $_POST['specialty'];
									$dokter = $_POST['doctorname'];
									$tanggal = $_POST['date'];
									$date = str_replace('/', '-', $tanggal);
									$tanggalbetul = date('Y-m-d', strtotime($date));
									$jadwal = $_POST['schedule'];

									$sql = "INSERT INTO pasien (Nama_Lengkap, Telepon, Spesialis, Nama_Dokter, Tanggal, Jadwal)
									VALUES ('$namaLengkap', '$telepon', '$spesialis', '$dokter', '$tanggalbetul', '$jadwal')";
									if ($conn->query($sql) === TRUE) {
										echo "New record created successfully";
										} 
									else {
										echo "Error: " . $sql . "<br>" . $conn->error;
									}
									//tampilkan urutan
									$result = "	SELECT Nama_Lengkap, Spesialis, Nama_Dokter, Jadwal 
												FROM pasien
												WHERE Nama_Dokter = '$dokter'
												ORDER BY ID_Pasien ASC ";
									$urutan = 	$conn->query($result);
												// mencetak tabel
												if ($urutan->num_rows > 0) {
												// data urutan antrean
													echo "<table border='1'><td style='color:white;'><tr>";
													echo "<td style='color:white;'>Nama Lengkap</td><th><td style='color:white;'>Spesialis</th></td><th><td style='color:white;'>Nama Dokter</th></td><th><td style='color:white;'>Jadwal</th></td></tr>";
													while($row = $urutan->fetch_assoc()) {
														echo "<tr><td style='color:white;'>" .$row['Nama_Lengkap'] . "</td>";
														echo "<td><td style='color:white;'>" .$row['Spesialis'] . "</td>";
														echo "<td><td style='color:white;'>" .$row['Nama_Dokter'] . "</td>";
														echo "<td><td style='color:white;'>" . $row['Jadwal'] . "</td></tr>";
													}
													echo "</table>";
												}
							$conn->close();
							}
?>

               </form>
            </div>
				<ul class='bg-bubbles'>
                  <li/>
                  <li/>
                  <li/>
                  <li/>
                  <li/>
                  <li/>
                  <li/>
                  <li/>
                  <li/>
                  <li/>
               </ul>
         </div>
			
      </div>

   </body>
</html>
