<?php
   include("config.php");
   include("koneksi.php");
   session_start();
   $error = "";

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $db = connect1();
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT * FROM member WHERE username = '$myusername' and nim = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      // $active = $row['active'];
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         // session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         session_start();
         if (isset($_POST['password']) && isset($_POST['username'])) {
            if($_POST['password']==$mypassword && $_POST['username']==$myusername) {
               header("location: index.php");
               $_SESSION['isLogged'] = true;
            }
         }
      }  else {
         $error = "Your NIM or Username is invalid, please try again.";
      }
   }
?>
<html>
   
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Login</title>
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
            <h3 style="color:#fff"> Hi, ITB Students!</h3>
            <h5 style="color:#fff">Please enter your NIM and AI3 Username</h5>
            <form action = "" method = "post">
               <!--   <label>NIM  :</label> -->
               <input type = "text" name = "username" class = "box" placeholder="Your AI3 username"/><br />
               <!--  <label>Username AI3  :</label> -->
               <input type = "password" name = "password" class = "box" placeholder="Your NIM"/><br/>
               <button type = "submit" >Log In</button>
            </form>
            <div class="error-mes alert-warning">
               <?php echo $error; ?>
            </div>
         </div>
      </div>
   </body>

</html>