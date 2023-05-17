<?php 
session_start();
if($_SESSION['ROLE'] == "customer"){
    //header("Location: login");
    echo "<script>window.location = 'login';</script>";
} else if($_SESSION['ROLE'] == "admin"){
    //header("Location: loginAdmin.html");
    echo "<script>window.location = 'loginAdmin.html';</script>";
} else if($_SESSION['ROLE'] == "manager"){
    //header("Location: loginManager.html");
    echo "<script>window.location = 'loginManager.html';</script>";
} else if($_SESSION['ROLE'] == "employee"){
    //header("Location: loginEmp.html");
    echo "<script>window.location = 'loginEmp.html';</script>";
} else if($_SESSION['ROLE'] == "agent"){
    //header("Location: loginAgent.html");
    echo "<script>window.location = 'loginAgent.html';</script>";
} else if($_SESSION['ROLE'] == "accountant"){
    //header("Location: loginAgent.html");
    echo "<script>window.location = 'loginAccountant.html';</script>";
} 
session_destroy(); 
?>