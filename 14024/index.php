<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <meta charset="UTF-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .error {color: #FF0000;}
            body {
                background-image: url("bookbackground.jpg");
                background-size: cover;
                font-family: "Trebuchet MS", Helvetica, sans-serif;
            }
            #pinjambuku {
                background-color: #E3F0F2;
                margin-top: 90px;
                margin-bottom: 0px;
                margin-right: 150px;
                margin-left: 200px;
                border: 2px solid blueviolet;
                border-radius: 5px;
                width : 35%;
                padding : 25px;
            }
        </style>
        <title>Form Peminjaman Buku</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="jquery.chained.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script>
            $( function() {
                $.datepicker.setDefaults({
                    dateFormat: 'd MM, yy'
                });
                $("#startdate").change(function() {
                    var date2 = $("#startdate").datepicker('getDate'); 
                    date2.setDate(date2.getDate()+14); 
                    $("#enddate").datepicker('setDate', date2);
                });
                $("#startdate").datepicker({
                    minDate: 0
                });
                $("#enddate").datepicker();
            });
        </script>
        <script>
            function submitEndDate() {
                document.getElementById("enddate").disabled = false;
            }
        </script>
        <link href="./css/mainstyle.css" rel="stylesheet">
    </head>
    <body>      
        <?php 
            $servername = "sql6.freemysqlhosting.net";
            $username = "sql6148729";
            $password = "GsZCmtlvWF";
            $dbname = "sql6148729";

            $con = mysqli_connect($servername, $username, $password) or die('Could not connect to database');
            mysqli_select_db($con, $dbname) or die('Could not select database');
        ?>
        
        <?php
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            
            $studentid = $category = $bookid = $startdate = $enddate = ""; 
            $idErr = $categErr = $titleErr = $dateErr = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $checksum = 4;
                if (empty($_POST["studentid"])) {
                    $idErr = "Student ID is required";
                } else {
                    $checksum = $checksum - 1;
                }
                
                if (empty($_POST["category"])) {
                    $categErr = "Category is required";
                } else {
                    $checksum = $checksum - 1;
                }
                
                if (empty($_POST["title"])) {
                    $titleErr = "Choose a title";
                } else {
                    $checksum = $checksum - 1;
                }
                
                if (empty($_POST["startdate"])) {
                    $dateErr = "Start Date is required";
                } else {
                    $checksum = $checksum - 1;
                }
                
                if ($checksum==0) {
                    $studentid = test_input($_POST["studentid"]);
                    $idcheck = "SELECT studentid from Students where studentid=$studentid";
                    $idresult = mysqli_query($con, $idcheck);
                    
                    $date = date("Y-m-d");
                    $ordercheck = "SELECT * from BookOrder where studentid=$studentid and enddate > '$date'";
                    $dateresult = mysqli_query($con, $ordercheck);
                                        
                    $startdate = test_input($_POST["startdate"]);
                    $startdate1 = strtotime($startdate);
                    $startdate2 = date('Y-m-d', $startdate1);
                    $bookid = test_input($_POST["title"]);
                    $stockcheck = "SELECT amount from Books where bookid = $bookid";
                    $stockresult = mysqli_query($con,$stockcheck);
                    while($row = mysqli_fetch_array($stockresult)) {
                                $stock = $row['amount'];
                            }
                            
                    $amtcheck = "SELECT * from BookOrder where bookid = $bookid and enddate > '$startdate2'";
                    $amtresult = mysqli_query($con,$amtcheck);
                    $avlcheck = "SELECT MIN(enddate) as mindate from BookOrder where bookid = $bookid";
                    $available = mysqli_query($con,$avlcheck);
                    
                    if(mysqli_num_rows($idresult) == 0) {
                            echo "Please enter a valid student ID.";
                        } elseif(mysqli_num_rows($dateresult) > 0) {
                            echo "Anda masih memiliki buku yang sedang dipinjam. Harap mengembalikan buku sebelum meminjam buku yang lain.";
                        } elseif (mysqli_num_rows($amtresult) >= $stock) {
                            echo "Buku yang anda inginkan sedang habis. ";
                            echo "Buku tersebut akan tersedia pada tanggal ";
                            while($row = mysqli_fetch_array($available)) {
                                $avldate = strtotime("+1 day", strtotime($row['mindate']));
                                echo date("Y-m-d", $avldate);
                            }
                        } else {
                            $enddate = test_input($_POST["enddate"]);
                            $enddate1 = strtotime($enddate);
                            $enddate2 = date('Y-m-d', $enddate1);
                            $sql = "INSERT INTO BookOrder (startdate,enddate,studentid,bookid)
                                    VALUES ('$startdate2','$enddate2','$studentid','$bookid')";
                            if ($con->query($sql) === TRUE) {
                                echo "Pesanan anda berhasil masuk. Mohon menunjukkan kartu tanda mahasiswa pada saat pengambilan buku.";
                            } else {
                                echo "Error: " . $sql . "<br>" . $con->error;
                            }
                        }
                }
            }    
        ?>
        
        <form id = "pinjambuku"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">          
            <h1>Form Peminjaman Buku</h1>
            
            <p>Student ID: <input type="text" name="studentid">
            <span class="error">* <?php echo $idErr;?></span></p>
            
            <p>
            Category:
            <select id='category' name='category'>
            <option value="">--</option>
            <?php    
                $sqlcateg = "SELECT DISTINCT category FROM Books";
                $result = mysqli_query($con, $sqlcateg);            
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
                }
            ?>      
            </select>  
            <span class="error">* <?php echo $categErr;?></span></p>
            </p>
            
            
            <p>
            Title:
            <select id='title' name='title'>
            <option value="">--</option>
            <?php
                $sqltitle = "SELECT * FROM Books";
                $result2 = mysqli_query($con, $sqltitle);            
                while ($row = mysqli_fetch_array($result2)) {
                    echo "<option value='" . $row['bookid'] . "' class='" . $row['category'] . "'>" . $row['title'] . "</option>";
                }
            ?> 
            </select>
            <span class="error">* <?php echo $titleErr;?></span></p>
            </p>
            
            <script type="text/javascript">$("#title").chained("#category");</script>
            
            <p>Start date: <input type="text" id="startdate" readonly='true' name="startdate">
            <span class="error">* <?php echo $dateErr;?></span></p></p> 
            
            <p>End date: <input type="text" id="enddate" readonly='true' disabled='disabled' name="enddate"></p>
            
            <input type="submit" name="submit" value="Submit" onclick = "submitEndDate()" >
        </form>
        
    </body>
</html>
