<?php
   include('server.php');
   //session_start();

   $ses_sql = mysqli_query($db,"select username from user where username = '$user_check' ");
   
   $user_check = $_SESSION['login_user'];



   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

   $login_session = $row['username'];

   $name =  $_SESSION['username'];

   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }
