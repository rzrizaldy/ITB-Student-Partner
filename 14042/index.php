<?php
include 'connect.php';
exec("/usr/bin/python ../EventdanSeminar/agenda.py"); #ekseskusi agenda menggunakan python
exec("/usr/bin/python ../EventdanSeminar/jadwal.py"); #ekseskusi jadwal mengunakan python
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Event dan Seminar</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/landing-page.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- Header -->
    <a name="about"></a>
    <div class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.intro-header -->
    <div class="container">
        <h5><center></center></h5> 
        <br/>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home"><h3>Home</h3></a></li>
            <li><a data-toggle="tab" href="#menu1"><h3>Event ITB</h3></a></li>
            <li><a data-toggle="tab" href="#menu2"><h3>Event Bandung</h3></a></li>
        </ul>
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
            <div class="content-section-a">

                <div class="container">

                    <div class="row">
                        <div class="col-lg-5 col-sm-6">
                            <div class="clearfix"></div>
                    <h2>Selamat datang! </h2>
                    <h4>Cari tahu informasi terbaru tentang Event dan Seminar di ITB dan di Bandung!</h4>
                        </div>
                    </div>

                </div>
                <!-- /.container -->

            </div>
            </div>
            <div id="menu1" class="tab-pane fade">
            <div class="content-section-a">

                <div class="container">

                    <div class="row">
                        <div class="col-lg-5 col-sm-6">
                            <div class="clearfix"></div>
                                <?php
                                    $result = mysqli_query($connect, "SELECT * FROM `agenda`");
                                    while($row = mysqli_fetch_assoc($result)) {
                                    echo " <h3>$row[JUDUL] </h3>";
                                    echo " $row[KETERANGAN] <br><br>";
                                }?>
                        </div>
                    </div>

                </div>
                <!-- /.container -->

            </div>
            </div>
            <div id="menu2" class="tab-pane fade">
            <div class="content-section-a">

                <div class="container">

                    <div class="row">
                        <div class="col-lg-5 col-sm-6">
                            <div class="clearfix"></div>
                                <!--bandung-->
                                <?php
                                    $result = mysqli_query($connect, "SELECT * FROM `jadwal`");
                                    while($row = mysqli_fetch_assoc($result)) {
                                    echo " <h3>$row[JUDUL] </h3>";
                                    echo " $row[TANGGAL] <br>";
                                    echo " $row[TEMPAT] <br><br>";
                                }?>
                        </div>
                    </div>

                </div>
                <!-- /.container -->

            </div>

            </div>
            </div>
        </div>
    </div>    

        <div class="container">
    </div>
    <!-- Page Content -->
	<a  name="services"></a>


	<a  name="contact"></a>
    <div class="banner">
        <!-- /.container -->

    </div>
    <!-- /.banner -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
            <h5><center>Siti Aisyah/18214042</center></h5> 

</body>

</html>
