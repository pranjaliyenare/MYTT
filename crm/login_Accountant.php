<?php
        include 'database.php';
            $name = $_POST['email']; 
            $password = $_POST["password"]; 
            $rolename = "accountant";
           
            $result = mysqli_query($conn, "SELECT password, username, userid, type, status FROM msd_login_table  WHERE type= '".$rolename."' and username = '".$name."' and password = '".$password."'");

            $my_id_array=mysqli_fetch_assoc($result);
            if($my_id_array != null) { 
            $my_user=$my_id_array['username'];
            $my_pass=$my_id_array['password'];
            $my_type=$my_id_array['type'];
            $userid = $my_id_array['userid'];
            if($my_id_array['status'] == 2)
            {
                echo "<script>alert('This User is not Valid!')</script>";
                echo "<script>window.location = 'loginAccountant.html';</script>";
            }
            } else {
                echo "<script>alert('The username or password are incorrect!')</script>";
                echo "<script>window.location = 'loginAccountant.html';</script>";
            }

            $result = mysqli_query($conn, "SELECT * FROM `msd_register_comp_accountant_table` WHERE `acc_email` = '".$name."' AND `acc_password` = '".$password."'");
                $my_id_array=mysqli_fetch_assoc($result);
                $fullname =$my_id_array['acc_name'];
                $refid =$my_id_array['reference_id'];

            if($name == $my_user && $password == $my_pass && $rolename == $my_type) 
            { 
                 session_start();
                 $_SESSION['FULLNAME'] = $fullname;
                 $_SESSION['USERNAME'] = $_POST['email'];
                 $_SESSION['PASSWORD'] = $_POST['password'];
                 $_SESSION['ROLE'] = $my_type;
                 $_SESSION["USERID"] = $userid;
                 $_SESSION["ADMINID"] = $refid;
                    echo get_client_ip();
                    echo "<script>window.location = 'accountantDashboard';</script>";
                    exit();
            }
            else
            {
                echo "<script>alert('The username or password are incorrect!')</script>";
                echo "<script>window.location = 'loginAccountant.html';</script>";
                
            }
            function get_client_ip() {
                include 'database.php';
                $ipaddress = '';
                if (isset($_SERVER['HTTP_CLIENT_IP']))
                    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
                else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
                else if(isset($_SERVER['HTTP_X_FORWARDED']))
                    $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
                else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
                else if(isset($_SERVER['HTTP_FORWARDED']))
                    $ipaddress = $_SERVER['HTTP_FORWARDED'];
                else if(isset($_SERVER['REMOTE_ADDR']))
                    $ipaddress = $_SERVER['REMOTE_ADDR'];
                else
                    $ipaddress = 'UNKNOWN';

                    mysqli_query($conn, "INSERT INTO `msd_ip_address_table`(`IP_address`, `user`) VALUES ('".$ipaddress."', '".$_SESSION["USERID"]."')");
                //return $ipaddress;
            }
?>