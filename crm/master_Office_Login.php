<?php
//include 'header.php';

    if(isset($_POST['submit'])) {
        include 'database.php';
        $name = $_POST['uname']; 
        $password = $_POST["psw"]; 
        $rolename = "masteroffice";
        
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
                        echo "<script>window.location = 'master_Office_Login';</script>";
                    }
            } else {
                echo "<script>alert('The username or password are incorrect!')</script>";
                echo "<script>window.location = 'master_Office_Login';</script>";
            }

            if($name == $my_user && $password == $my_pass && $rolename == $my_type) 
            { 
              $_SESSION["MO_USER_NAME"] =$userid;
              $_SESSION["MO_TYPE"] =$my_type;
                echo "<script>window.location = 'master_office_add';</script>";
                 
                exit();
            }
            else
            {
                echo "<script>alert('The username or password are incorrect!')</script>";
                echo "<script>window.location = 'master_Office_Login';</script>";
                
            }
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  /*display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 50%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

<!-- <h2>Modal Login Form</h2> -->

<!-- <button onclick="document.getElementById('mypopup').style.display='block'" style="width:auto;">Login</button> -->

<div id="mypopup" class="modal">
  
  <form class="modal-content animate" action="#" method="post">
    <!-- <div class="imgcontainer">
      <span onclick="document.getElementById('mypopup').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="img_avatar2.png" alt="Avatar" class="avatar">
    </div> -->

    <div class="container" style="max-width:600px;cursor:auto">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit" name="submit">Login</button>
      <!-- <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label> -->
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="window.location = 'adminDashboard'" class="cancelbtn">Cancel</button>
      <!-- <span class="psw">Change <a href="#">password?</a></span> -->
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('mypopup');
$('#mypopup').modal({backdrop: 'static', keyboard: false})  

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>