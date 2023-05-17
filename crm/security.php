<?php
session_start();

if(!$_SESSION['USERID']){
    //header("Location: login.html");
    if($sess_role == "admin"){
        echo "<script>window.location = 'loginAdmin.html';</script>";
    } else if($sess_role == "customer"){
        echo "<script>window.location = 'login';</script>";
    } else if($sess_role == "agent"){
        echo "<script>window.location = 'loginAgent.html';</script>";
    } else if($sess_role == "manager"){
        echo "<script>window.location = 'loginManager.html';</script>";
    } else if($sess_role == "employee"){
        echo "<script>window.location = 'loginEmp.html';</script>";
    } else if($sess_role == "master agent"){
        echo "<script>window.location = 'loginmAgent';</script>";
    } else {
        echo "<script>window.location = 'login';</script>";
    }
    
} else {
    $sess_role = $_SESSION['ROLE'];
}

?>