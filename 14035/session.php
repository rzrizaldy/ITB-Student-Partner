<?php
   include('config.php');
   session_start();
   
   $user_check = "rafidwiriz";
   /* Bagian yang dikomen, chat langsung aja
   $user_check = $_SESSION['login_user'];
   $type = $_SESSION['type'];
   
   $ses_sql = mysqli_query($db,"SELECT username FROM useraccounts WHERE username = '$user_check' ");
   
   $row = mysqli_fetch_assoc($ses_sql);
   
   $login_session = $row['username'];/*/
   $login_session = $user_check;
   
   
   /*if(!isset($_SESSION['login_user'])){
      header("location:index.php");
   }*/
?>