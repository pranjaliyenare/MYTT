<?php 
 include 'security.php';
 include 'database.php'; 
 $role = $_SESSION['ROLE'];
 $username = $_SESSION['USERNAME'];
 
?>

<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of buttons that feature different styles for backgrounds, borders and hover options!">
    <meta name="msapplication-tap-highlight" content="no">
    <!-- <title>MyThink Tank Pvt. Ltd.</title> -->
    <link href="main.css" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/favicon.ico"/>
    <script type="text/javascript" src="assets/scripts/main.js"></script>
    
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div>
                    <img src="assets/images/logo.png" alt="MYTT" style="width: 80px; height: 80px;">
                <!-- <img src="assets/images/logo.png" alt="Italian Trulli" style="width: 80px; height: 80px;"> -->
                <!-- <div class="logo-src"></div> -->
                </div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>    
            <div class="app-header__content">
                <div class="app-header-center">
                    
                    <ul class="header-menu nav">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <!-- <i class="nav-link-icon fa fa-database"> </i> -->
                                <h4><b><?php if($role == "admin") { echo "Admin"; } else if($role == "manager") { echo "Manager"; } else if($role == "employee") { echo "Employee"; } else if($role == "agent") { echo "Partner"; } else if($role == "accountant") { echo "Accountant"; } else if($role == "customer") { echo "Customer"; } ?> Panel</b></h4>
                            </a>
                        </li>
                       
                    </ul>        
                </div>

                <style>
                    .icon_class {
                        padding:  10px;
                        margin-right: 15px;
                        border-radius: 50% !important;
                        font-size:24px;
                    } 
                    .li_class {                        
                        border: outset 1px !important;
                    }
                    .notf_icon {
                        padding: 10px;
                        color: #ffffff;
                    }
                </style>
                
                    <div class="app-header-right">                        
                            <div class="page-title-actions" style="padding: 20px;">                                    
                                <div class="d-inline-block dropdown  show">
                                   
                                    <?php
                                         $sql = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM `msd_notification_table` WHERE `status` !=2 AND `comment_status` = 1 AND `user_id`='".$_SESSION['USERID']."'");
                                         $notf_array =mysqli_fetch_assoc($sql);                                           
                                         $count = $notf_array["cnt"];
                                    ?>
                                    <a type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="" style="color:#ffffff">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                            <i class="fa fa-bell "></i>
                                            <?php if($count != 0) { ?>
                                                <div class="ml-auto badge badge-pill badge-danger" style="position: absolute; top: -10px;"><?php echo $count; ?></div>
                                            <?php } ?>
                                        </span>                                            
                                    </a>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-347px, 33px, 0px);">
                                        <ul class="nav flex-column">
                                        <?php
                                            $sql = mysqli_query($conn, "SELECT * FROM `msd_notification_table` WHERE `status` !=2 AND `user_id`='".$_SESSION['USERID']."'");
                                            //$notf_array =mysqli_fetch_assoc($sql);   
                                            $row = mysqli_num_rows($sql);
                                            while ($row = mysqli_fetch_array($sql)) {
                                            $comment_subject = $row["comment_subject"];
                                            $comment_status = $row["comment_status"];
                                            $comment_type = $row["comment_type"];
                                            $id = $row["id"];
                                            $icon = "";
                                            
                                        ?>
                                        <?php if($comment_type == 'welcome') { 
                                            $icon = '<i class="fa fa-handshake icon_class ';
                                        } else if($comment_type == 'hello'){
                                            $icon = '<i class="fas fa-hand-paper icon_class ';
                                        } else if($comment_type == 'deposit'){
                                            $icon = '<i class="fa fa-rupee icon_class ';
                                        } else if($comment_type == 'withdraw'){
                                            $icon = '<i class="fa fa-money icon_class ';
                                        } else if($comment_type == 'bonus'){
                                            $icon = '<i class="fa fa-gift icon_class ';
                                        } else if($comment_type == 'expire'){
                                            $icon = '<i class="fa fa-warning icon_class ';
                                        } else if($comment_type == 'other'){
                                            $icon = '<i class="fas fa-comment-dots icon_class ';
                                        } 
                                        if($comment_status == 1){
                                            ?>
                                        

                                            <li class="nav-item li_class" style="background-color: #f7d3dc;">                                                 
                                                <a href="javascript:void(0);" data-id="<?php echo $id; ?>"  class="nav-link noft_class" data-toggle="modal" data-target=".bd-example-modal-sm" style="color: #d92550;">
                                                    <!-- <i class="nav-link-icon lnr-inbox"></i> -->
                                                    <?php echo $icon.'badge-danger"></i>'; ?>
                                                    <span>
                                                        <?php echo $comment_subject; ?>
                                                    </span> 
                                                    <!-- <div class="ml-auto badge badge-pill badge-danger"><i class="fa fa-check"></i></div>                                                   -->
                                                </a>
                                            </li>
                                            <?php } else  if($comment_status == 2){ ?> 
                                                <li class="nav-item li_class" style="background-color: #d8f3e5;">                                                
                                                    <a href="javascript:void(0);" data-id="<?php echo $id; ?>"  class="nav-link noft_class" data-toggle="modal" data-target=".bd-example-modal-sm" style="color: #3ac47d;">
                                                        <!-- <i class="nav-link-icon lnr-inbox"></i> -->
                                                        <?php echo $icon.'badge-success"></i>'; ?>
                                                        <span>
                                                            <?php echo $comment_subject; ?>
                                                        </span>     
                                                        <!-- <div class="ml-auto badge badge-pill badge-success"><i class="fa fa-check-double"></i></div>                                                 -->
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        <?php } ?>                                         
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                <!-- <div id="toast-container" class="toast-top-center" style="display:none;"><div class="toast toast-error" aria-live="assertive" style=""><div class="toast-message"><div><input class="input-small" value="textbox">&nbsp;<a href="http://johnpapa.net" target="_blank">This is a hyperlink</a></div><div><button type="button" id="okBtn" class="btn btn-primary">Close me</button><button type="button" id="surpriseBtn" class="btn" style="margin: 0 8px 0 8px">Surprise me</button></div></div></div></div> -->
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                        <?php
                                        if( $role != "admin") {
                                        if( $role  == "manager") {
                                                $query = mysqli_query($conn, "SELECT `mgr_image` AS profile FROM `msd_register_comp_manager_table` WHERE `mgr_id` = '".$_SESSION['USERID']."'");
                                                $row = mysqli_fetch_assoc($query);
                                                if($row>0) {
                                                    $img =  $row["profile"];
                                                    echo '<img width="42" class="rounded-circle" src="assets/images/avatars/'.$img.'" alt="">';
                                                    } else {
                                                      echo '<img width="42" class="rounded-circle" src="assets/images/avatars/icon.jpg" alt="">';     
                                                    }
                                        } else  if( $role  == "employee") {
                                            $query = mysqli_query($conn, "SELECT `emp_image` AS profile FROM `msd_register_comp_employee_table` WHERE `emp_id`= '".$_SESSION['USERID']."'");
                                            $row = mysqli_fetch_assoc($query);
                                            if($row>0) {
                                                $img =  $row["profile"];
                                                echo '<img width="42" class="rounded-circle" src="assets/images/avatars/'.$img.'" alt="">';
                                                } else {
                                                  echo '<img width="42" class="rounded-circle" src="assets/images/avatars/icon.jpg" alt="">';     
                                                }
                                          } else  if($role  == "agent") {
                                            $query = mysqli_query($conn, "SELECT `agent_image` AS profile FROM `msd_register_comp_agent_table` WHERE `agent_id`= '".$_SESSION['USERID']."'");
                                            $row = mysqli_fetch_assoc($query);
                                            if($row>0) {
                                                $img =  $row["profile"];
                                                echo '<img width="42" class="rounded-circle" src="assets/images/avatars/'.$img.'" alt="">';
                                                } else {
                                                  echo '<img width="42" class="rounded-circle" src="assets/images/avatars/icon.jpg" alt="">';     
                                                }
                                          } else if($role  == "customer") {
                                            $query = mysqli_query($conn, "SELECT `register_image` AS profile FROM `msd_register_customer_table` WHERE `register_id` = '".$_SESSION['USERID']."'");
                                            $row = mysqli_fetch_assoc($query);
                                                   
                                                    if($row["profile"] != ""){
                                                        echo '<img width="42" class="rounded-circle" src="assets/images/avatars/'.$row["profile"].'" alt="">';   
                                                    } else {
                                                        echo '<img width="42" class="rounded-circle" src="assets/images/avatars/icon.jpg" alt="">';     
                                                    }
                                            }
                                            } else {
                                                echo '<img width="42" class="rounded-circle" src="assets/images/avatars/icon.jpg" alt="">'; 
                                            } 

                                        ?>
                                            <i class="fa fa-angle-down ml-2 opacity-8" style="color:#ffffff;"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                        <a type="button" tabindex="0" class="dropdown-item" href="./changePassword.php">Change Password</a>
                                        <?php 
                                            //echo $role;  
                                                   if($role  == "customer") {
                                                    $query1 = mysqli_query($conn, "SELECT `agent_login_id`, `agent_login_checked` FROM `msd_register_customer_table` WHERE register_id= '".$_SESSION['USERID']."'");
                                                    $row1 = mysqli_fetch_assoc($query1);
                                                    
                                                    if($row1["agent_login_id"] != NULL || $row1["agent_login_checked"] == 'YES') {
                                                        $result = mysqli_query($conn, "SELECT * FROM `msd_register_comp_agent_table` WHERE `agent_id` = '".$row1["agent_login_id"]."'");
                                                        $my_id_array=mysqli_fetch_assoc($result);
                                                        $email =$my_id_array['agent_email'];
                                                        $password =$my_id_array['agent_password'];
                                                         //echo'<a type="button" tabindex="0" class="dropdown-item" href="login_Agent.phpK">Partner Login</a>';
                                                         echo'<a type="button" tabindex="0" class="dropdown-item" href="login_Agent.php?email='.base64_encode($email).'&password='.base64_encode($password).'&type=agent">Partner Login</a>';
                                                        }
                                                   } else if($role  == "agent") {
                                                        $query = mysqli_query($conn, "SELECT `customer_id`, `customer_login` FROM `msd_register_comp_agent_table` WHERE agent_id= '".$_SESSION['USERID']."'");
                                                        $row = mysqli_fetch_assoc($query);
                                                        
                                                        if($row["customer_id"] != NULL || $row["customer_id"] == 'YES') {
                                                            $result = mysqli_query($conn, "SELECT * FROM `msd_register_customer_table` WHERE `register_id` = '".$row["customer_id"]."'");
                                                            $my_id_array=mysqli_fetch_assoc($result);
                                                            $email =$my_id_array['register_email'];
                                                            $password =$my_id_array['register_password'];
                                                            echo'<a type="button" tabindex="0" class="dropdown-item" href="loginCustomer.php?email='.base64_encode($email).'&password='.base64_encode($password).'&type=cust">Customer Login</a>';
                                                        }
                                                   }
                                                ?>
                                            <!-- <button type="button" tabindex="0" class="dropdown-item">Settings</button> -->
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <a type="button" tabindex="0" class="dropdown-item" href="./logout.php">Logout</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                <div class="widget-heading" style="color: #ffffff;">
                                        <?php echo $_SESSION['FULLNAME']; ?>
                                    </div>
                                    <div class="widget-heading" style="color: #ffffff;">
                                        <?php echo $_SESSION['USERNAME']; 
                                        echo "(" .$_SESSION['USERID']. ")"; ?>
                                    </div>
                                    <div class="widget-subheading" style="color: #ffffff;">
                                    <?php echo $role  ?>
                                    </div>
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                
                                <!-- <a href="../logout.php" class="mb-2 mr-2 btn-transition btn btn-outline-warning" style="color:gold;">Logout</a> -->
                                    <!-- <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm" onclick="logoutOnclick()">
                                        <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                        LogOut
                                    </button> -->
                                </div>
                            </div>
                        </div>
                    </div>        
                </div>
            </div>
        </div>   

        <!-- Small modal -->
        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #3f6ad8;">
                    <i class="fas fa-bell notf_icon"></i><h5 class="modal-title" id="exampleModalLongTitle" style="color:white;">Notification</h5>
                        <button type="button" class="close" data-dismiss="modal" style="color:white;" onclick="location.reload();" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="background-color: #dee2e6;">
                        <!-- <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p> -->
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div> -->
                </div>
            </div>
        </div>

        <div class="ui-theme-settings">
            <!-- <button type="button" id="TooltipDemo" class="btn-open-options btn btn-warning">
                <i class="fa fa-cog fa-w-16 fa-spin fa-2x"></i>
            </button> -->
            <div class="theme-settings__inner">
                <div class="scrollbar-container">
                    <div class="theme-settings__options-wrapper">
                        <h3 class="themeoptions-heading">Layout Options
                        </h3>
                        <div class="p-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="switch has-switch switch-container-class" data-class="fixed-header">
                                                    <div class="switch-animate switch-on">
                                                        <input type="checkbox" checked data-toggle="toggle" data-onstyle="success">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Fixed Header
                                                </div>
                                                <div class="widget-subheading">Makes the header top fixed, always visible!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="switch has-switch switch-container-class" data-class="fixed-sidebar">
                                                    <div class="switch-animate switch-on">
                                                        <input type="checkbox" checked data-toggle="toggle" data-onstyle="success">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Fixed Sidebar
                                                </div>
                                                <div class="widget-subheading">Makes the sidebar left fixed, always visible!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="switch has-switch switch-container-class" data-class="fixed-footer">
                                                    <div class="switch-animate switch-off">
                                                        <input type="checkbox" data-toggle="toggle" data-onstyle="success">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Fixed Footer
                                                </div>
                                                <div class="widget-subheading">Makes the app footer bottom fixed, always visible!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <h3 class="themeoptions-heading">
                            <div>
                                Header Options
                            </div>
                            <button type="button" class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-header-cs-class" data-class="">
                                Restore Default
                            </button>
                        </h3>
                        <div class="p-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h5 class="pb-2">Choose Color Scheme
                                    </h5>
                                    <div class="theme-settings-swatches">
                                        <div class="swatch-holder bg-primary switch-header-cs-class" data-class="bg-primary header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-secondary switch-header-cs-class" data-class="bg-secondary header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-success switch-header-cs-class" data-class="bg-success header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-info switch-header-cs-class" data-class="bg-info header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-warning switch-header-cs-class" data-class="bg-warning header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-danger switch-header-cs-class" data-class="bg-danger header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-light switch-header-cs-class" data-class="bg-light header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-dark switch-header-cs-class" data-class="bg-dark header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-focus switch-header-cs-class" data-class="bg-focus header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-alternate switch-header-cs-class" data-class="bg-alternate header-text-light">
                                        </div>
                                        <div class="divider">
                                        </div>
                                        <div class="swatch-holder bg-vicious-stance switch-header-cs-class" data-class="bg-vicious-stance header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-midnight-bloom switch-header-cs-class" data-class="bg-midnight-bloom header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-night-sky switch-header-cs-class" data-class="bg-night-sky header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-slick-carbon switch-header-cs-class" data-class="bg-slick-carbon header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-asteroid switch-header-cs-class" data-class="bg-asteroid header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-royal switch-header-cs-class" data-class="bg-royal header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-warm-flame switch-header-cs-class" data-class="bg-warm-flame header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-night-fade switch-header-cs-class" data-class="bg-night-fade header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-sunny-morning switch-header-cs-class" data-class="bg-sunny-morning header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-tempting-azure switch-header-cs-class" data-class="bg-tempting-azure header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-amy-crisp switch-header-cs-class" data-class="bg-amy-crisp header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-heavy-rain switch-header-cs-class" data-class="bg-heavy-rain header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-mean-fruit switch-header-cs-class" data-class="bg-mean-fruit header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-malibu-beach switch-header-cs-class" data-class="bg-malibu-beach header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-deep-blue switch-header-cs-class" data-class="bg-deep-blue header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-ripe-malin switch-header-cs-class" data-class="bg-ripe-malin header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-arielle-smile switch-header-cs-class" data-class="bg-arielle-smile header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-plum-plate switch-header-cs-class" data-class="bg-plum-plate header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-happy-fisher switch-header-cs-class" data-class="bg-happy-fisher header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-happy-itmeo switch-header-cs-class" data-class="bg-happy-itmeo header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-mixed-hopes switch-header-cs-class" data-class="bg-mixed-hopes header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-strong-bliss switch-header-cs-class" data-class="bg-strong-bliss header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-grow-early switch-header-cs-class" data-class="bg-grow-early header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-love-kiss switch-header-cs-class" data-class="bg-love-kiss header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-premium-dark switch-header-cs-class" data-class="bg-premium-dark header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-happy-green switch-header-cs-class" data-class="bg-happy-green header-text-light">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <h3 class="themeoptions-heading">
                            <div>Sidebar Options</div>
                            <button type="button" class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-sidebar-cs-class" data-class="">
                                Restore Default
                            </button>
                        </h3>
                        <div class="p-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h5 class="pb-2">Choose Color Scheme
                                    </h5>
                                    <div class="theme-settings-swatches">
                                        <div class="swatch-holder bg-primary switch-sidebar-cs-class" data-class="bg-primary sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-secondary switch-sidebar-cs-class" data-class="bg-secondary sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-success switch-sidebar-cs-class" data-class="bg-success sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-info switch-sidebar-cs-class" data-class="bg-info sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-warning switch-sidebar-cs-class" data-class="bg-warning sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-danger switch-sidebar-cs-class" data-class="bg-danger sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-light switch-sidebar-cs-class" data-class="bg-light sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-dark switch-sidebar-cs-class" data-class="bg-dark sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-focus switch-sidebar-cs-class" data-class="bg-focus sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-alternate switch-sidebar-cs-class" data-class="bg-alternate sidebar-text-light">
                                        </div>
                                        <div class="divider">
                                        </div>
                                        <div class="swatch-holder bg-vicious-stance switch-sidebar-cs-class" data-class="bg-vicious-stance sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-midnight-bloom switch-sidebar-cs-class" data-class="bg-midnight-bloom sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-night-sky switch-sidebar-cs-class" data-class="bg-night-sky sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-slick-carbon switch-sidebar-cs-class" data-class="bg-slick-carbon sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-asteroid switch-sidebar-cs-class" data-class="bg-asteroid sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-royal switch-sidebar-cs-class" data-class="bg-royal sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-warm-flame switch-sidebar-cs-class" data-class="bg-warm-flame sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-night-fade switch-sidebar-cs-class" data-class="bg-night-fade sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-sunny-morning switch-sidebar-cs-class" data-class="bg-sunny-morning sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-tempting-azure switch-sidebar-cs-class" data-class="bg-tempting-azure sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-amy-crisp switch-sidebar-cs-class" data-class="bg-amy-crisp sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-heavy-rain switch-sidebar-cs-class" data-class="bg-heavy-rain sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-mean-fruit switch-sidebar-cs-class" data-class="bg-mean-fruit sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-malibu-beach switch-sidebar-cs-class" data-class="bg-malibu-beach sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-deep-blue switch-sidebar-cs-class" data-class="bg-deep-blue sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-ripe-malin switch-sidebar-cs-class" data-class="bg-ripe-malin sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-arielle-smile switch-sidebar-cs-class" data-class="bg-arielle-smile sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-plum-plate switch-sidebar-cs-class" data-class="bg-plum-plate sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-happy-fisher switch-sidebar-cs-class" data-class="bg-happy-fisher sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-happy-itmeo switch-sidebar-cs-class" data-class="bg-happy-itmeo sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-mixed-hopes switch-sidebar-cs-class" data-class="bg-mixed-hopes sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-strong-bliss switch-sidebar-cs-class" data-class="bg-strong-bliss sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-grow-early switch-sidebar-cs-class" data-class="bg-grow-early sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-love-kiss switch-sidebar-cs-class" data-class="bg-love-kiss sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-premium-dark switch-sidebar-cs-class" data-class="bg-premium-dark sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-happy-green switch-sidebar-cs-class" data-class="bg-happy-green sidebar-text-light">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <h3 class="themeoptions-heading">
                            <div>Main Content Options</div>
                            <button type="button" class="btn-pill btn-shadow btn-wide ml-auto active btn btn-focus btn-sm">Restore Default
                            </button>
                        </h3>
                        <div class="p-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h5 class="pb-2">Page Section Tabs
                                    </h5>
                                    <div class="theme-settings-swatches">
                                        <div role="group" class="mt-2 btn-group">
                                            <button type="button" class="btn-wide btn-shadow btn-primary btn btn-secondary switch-theme-class" data-class="body-tabs-line">
                                                Line
                                            </button>
                                            <button type="button" class="btn-wide btn-shadow btn-primary active btn btn-secondary switch-theme-class" data-class="body-tabs-shadow">
                                                Shadow
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>      
         <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <!-- <div class="logo-src"></div> -->
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>   

                <div class="scrollbar-sidebar ps ps--active-y">
                    <div class="app-sidebar__inner">
                    <?php
                        if( $role  == "admin") {
                            echo '<ul class="vertical-nav-menu metismenu ">
                                        <li class="app-sidebar__heading">Dashboards</li>
                                        <li> <a href="adminDashboard"> <i class="metismenu-icon fa fa-home"></i> Dashboard </a></li>
                                        
                                       <!-- <li class> <a href="#"><i class="metismenu-icon fa fa-lock"></i>Master Office<i class="metismenu-state-icon fas fa-angle-down caret-left"></i></a>
                                            <ul class="mm-collapse">
                                            <!--    <li> <a href="master_Office_Login">Add Transaction</a></li> 
                                                <li> <a href="report_master_dtl">Master Report</a> </li>
                                                <li> <a href="report_payoutMonthly">Payout Report</a> </li>
                                            </ul>
                                        </li> -->

                                        
                                        <li class> <a href="#"><i class="metismenu-icon fa fa-user-plus"></i> Profile <i class="metismenu-state-icon fas fa-angle-down caret-left"></i></a>
                                            <ul class="mm-collapse">
                                                <li><a href="master_displayProfile?role='.base64_encode("manager").'" > <i class="metismenu-icon"></i> Manager </a> </li>
                                                <li><a href="master_displayProfile?role='.base64_encode("employee").'" ><i class="metismenu-icon"></i>Employee </a> </li>
                                                <li><a href="master_displayAccountant" ><i class="metismenu-icon"></i>Accountant</a> </li>
                                                <li><a href="master_displayProfile?role='.base64_encode("agent").'" ><i class="metismenu-icon"> </i>Partner</a> </li>
                                                <li> <a href="master_user_profiledtl"><i class="metismenu-icon fa fa-user-circle"></i> User</a> </li>
                                            </ul>
                                        </li>

                                        
                                        <li class> <a href="#"> <i class="metismenu-icon fa fa-check-circle"></i> Approval <i class="metismenu-state-icon fas fa-angle-down caret-left"></i> </a>
                                            <ul class="mm-collapse">
                                                <li> <a href="master_user_approval">User Approval</a></li>
                                                <li> <a href="master_deposit_approval">Deposit Approval</a></li>
                                                <li> <a href="master_withdraw_approval"> </i>Withdraw Approval </a></li>
                                            </ul> 
                                        </li>

                                        <li class> <a href="#"> <i class="metismenu-icon fas fa-list-alt"></i> Plan <i class="metismenu-state-icon fas fa-angle-down caret-left"></i> </a>
                                            <ul class="mm-collapse">
                                                <li><a href="master_addPlan">Add</a></li>
                                                <li><a href="master_editPlan">Edit</a></li>
                                                <li><a href="master_myPlan.php">My Plan </a></li>
                                                <li><a href="master_editNewPlan.php">Our Plans</a></li>
                                                <li><a href="master_editOffer.php">Our Offers</a></li>
                                                <li><a href="master_allocateOffer.php">Allocate Offers</a></li>
                                            </ul> 
                                        </li>

                                        <li class> <a href="#"> <i class="metismenu-icon fa fa-percent"></i> Percentage <i class="metismenu-state-icon fas fa-angle-down caret-left"></i> </a>
                                            <ul class="mm-collapse">
                                                <li><a href="transaction_percentage">Add Percentage</a></li>
                                                <li><a href="report_percentage">Percentage History</a></li>
                                            </ul> 
                                        </li>

                                        <li class> <a href="#"><i class="metismenu-icon fa fa-credit-card"> </i>Transaction  <i class="metismenu-state-icon fas fa-angle-down caret-left"></i></a>
                                            <ul class="mm-collapse">
                                                <li> <a href="payment"> Transaction </a> </li>
                                                <li> <a href="trans_agent_withdraw"> Partner Withdraw </a> </li>
                                            </ul>
                                        </li>
                                        
                                        <li class> <a href="#"> <i class="metismenu-icon fa fa-file"></i> Report <i class="metismenu-state-icon fas fa-angle-down caret-left"></i> </a>
                                            <ul class="mm-collapse">
                                                <li> <a href="report_admin">Profile History</a> </li>
                                                <li> <a href="report_bank">Bank Details</a> </li>
                                                <li> <a href="report_Deposit"> Deposit History</a> </li>
                                                <li> <a href="report_Withdraw"> Withdraw History</a> </li>
                                                <li> <a href="report_master_dtl">Master Report</a> </li>
                                                <li> <a href="report_payoutMonthly">Customer Payout Report</a> </li>
                                                <li> <a href="report_payoutAgent">Partner Payout Report</a> </li>
                                            </ul> 
                                        </li>


                                        <li class> <a href="#"> <i class="metismenu-icon fa fa-book">  </i> Statement <i class="metismenu-state-icon fas fa-angle-down caret-left"></i> </a>
                                            <ul class="mm-collapse">
                                                <li> <a href="report_Passbook_Agent_Admin"> Partner Statement</a> </li>
                                                <li> <a href="report_Passbook">  Customer Statement</a> </li>
                                               <!-- <li> <a href="report_Receipt"> Receipt</a> </li> -->
                                            </ul> 
                                        </li>

                                        <li> <a href="#"><i class="metismenu-icon fa fa-university"></i>  Company Details <i class="metismenu-state-icon fas fa-angle-down caret-left"></i></a>
                                            <ul class="mm-collapse">
                                                <li> <a href="master_comp_accountdtl">Bank Account Details </a>  </li>
                                                <li> <a href="master_QR_code"> QR Code </a>  </li>
                                                <li> <a href="app_download" >Download App</a>  </li>
                                            </ul>
                                        </li>
                                        <li> <a href="DB_Backup/database_backup"><i class="metismenu-icon fa fa-database"></i> DB Backup</a> </li>
                                    </ul>';

                        } else if($role  == "customer") {
                            echo '<ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Customer Dashboards</li>
                            <li> <a href="customerDashboard" > <i class="metismenu-icon fa fa-home"></i> Dashboard </a></li>

                            <li> <a href="master_userProfile"><i class="metismenu-icon fa fa-user-circle"></i> Profile</a> </li>
                            <li> <a href="master_myPlanUser"><i class="metismenu-icon fas fa-list-alt"></i> Plan</a> </li>
                            <li> <a href="report_Passbook_customer"> <i class="metismenu-icon fa fa-book">  </i>Statement</a> </li>
                            
                            
                        
                            <li> <a href="#"><i class="metismenu-icon fa fa-credit-card"> </i>Transaction  <i class="metismenu-state-icon fas fa-angle-down caret-left"></i></a>
                                <ul>
                                    <li> <a href="payment"> Transaction </a> </li>
                                    <li> <a href="report_User_Withdraw"> Withdraw History</a> </li>
                                </ul>
                            </li>

                            <li> <a href="#"><i class="metismenu-icon fa fa-university"></i>  Company Details <i class="metismenu-state-icon fas fa-angle-down caret-left"></i></a>
                                <ul>
                                    <li> <a href="master_comp_accountdtl">Bank Account Details </a>  </li>
                                    <li> <a href="master_QR_code"> QR Code </a>  </li>
                                    <li> <a href="app_download" >Download App</a>  </li>
                                </ul>
                            </li>

                        </ul>';
                        } else if($role == "manager") {
                            echo '<ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Manager Dashboards</li>
                                <li> <a href="managerDashboard"> <i class="metismenu-icon fa fa-home"></i> Dashboard </a></li>
                                
                                <li> <a href="master_addProfile"><i class="metismenu-icon fa fa-user-plus"></i>Profile <i class="metismenu-state-icon fas fa-angle-down caret-left"></i></a>
                                    <ul>
                                        <li><a href="master_displayProfile?role='.base64_encode("manager").'" > <i class="metismenu-icon"></i> Manager </a> </li>
                                        <li><a href="master_displayProfile?role='.base64_encode("agent").'" ><i class="metismenu-icon"> </i>Partner</a> </li>
                                        <li> <a href="master_user_profiledtl"><i class="metismenu-icon fa fa-user-circle"></i> User</a> </li>
                                        <li> <a href="report_manager"> <i class="metismenu-icon fa fa-users">  </i>Profile History</a> </li>
                                    </ul>
                                </li>

                                <li> <a href="master_myPlan"><i class="metismenu-icon fas fa-list-alt"></i> My Plan</a> </li>

                                <li class> <a href="#"> <i class="metismenu-icon fa fa-book">  </i> Statement <i class="metismenu-state-icon fas fa-angle-down caret-left"></i> </a>
                                    <ul class="mm-collapse">
                                        <li> <a href="report_Passbook_Agent_Admin"> Partner Statement</a> </li>
                                        <li> <a href="report_Passbook">  Customer Statement</a> </li>
                                    </ul> 
                                </li>

                                <li> <a href="report_Withdraw"><i class="metismenu-icon fa fa-download"></i>Withdraw History</a> </li>
                                
                                <li> <a href="#"><i class="metismenu-icon fa fa-university"></i>  Company Details <i class="metismenu-state-icon fas fa-angle-down caret-left"></i></a>
                                    <ul>
                                        <li> <a href="master_comp_accountdtl">Bank Account Details </a></li>
                                        <li> <a href="master_QR_code"> QR Code </a>  </li>
                                        <li> <a href="app_download" >Download App</a>  </li>
                                    </ul>
                                </li>
                            </ul>';
                        } else if($role == "employee"){
                            echo '<ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Employee Dashboards</li>
                                <li> <a href="employeeDashboard"> <i class="metismenu-icon fa fa-home"></i> Dashboard </a></li>
                                
                                <li> <a href="master_addProfile"><i class="metismenu-icon fa fa-user-plus"></i> Profile <i class="metismenu-state-icon fas fa-angle-down caret-left"></i></a>
                                    <ul>
                                        <li><a href="master_displayProfile?role='.base64_encode("employee").'" ><i class="metismenu-icon"></i>Employee </a> </li>
                                        <li><a href="master_displayProfile?role='.base64_encode("agent").'" ><i class="metismenu-icon"> </i>Partner</a> </li>
                                        <li> <a href="master_user_profiledtl"><i class="metismenu-icon fa fa-user-circle"></i> User</a> </li>
                                        <li> <a href="report_emp"> <i class="metismenu-icon fa fa-users">  </i>Profile History</a> </li>
                                    </ul>
                                </li>

                                <li> <a href="master_myPlan"><i class="metismenu-icon fas fa-list-alt"></i> My Plan</a> </li>

                                 <li class> <a href="#"> <i class="metismenu-icon fa fa-book">  </i> Statement <i class="metismenu-state-icon fas fa-angle-down caret-left"></i> </a>
                                     <ul class="mm-collapse">
                                         <li> <a href="report_Passbook_Agent_Admin">Partner Statement</a> </li>
                                         <li> <a href="report_Passbook">Customer Statement</a> </li>
                                     </ul> 
                                 </li>

                                 <li> <a href="report_Withdraw"><i class="metismenu-icon fa fa-download"></i>Withdraw History</a> </li>

                                <li> <a href="#"><i class="metismenu-icon fa fa-university"></i>  Company Details <i class="metismenu-state-icon fas fa-angle-down caret-left"></i></a>
                                    <ul>
                                        <li> <a href="master_comp_accountdtl">Bank Account Details </a>  </li>
                                        <li> <a href="master_QR_code"> QR Code </a>  </li>
                                        <li> <a href="app_download" >Download App</a>  </li>
                                    </ul>
                                </li>
                            </ul>';
                        } else if($role == "agent") {
                            echo '<ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Partner Dashboards</li>
                            <li> <a href="agentDashboard"> <i class="metismenu-icon fa fa-home"></i>Dashboard </a></li>
                            

                            <li> <a href="master_addProfile"><i class="metismenu-icon fa fa-user-plus"></i> Profile <i class="metismenu-state-icon fas fa-angle-down caret-left"></i></a>
                                <ul>
                                    <li><a href="master_displayProfile?role='.base64_encode("agent").'" ><i class="metismenu-icon"> </i>Partner</a> </li>
                                    <li> <a href="master_user_profiledtl"><i class="metismenu-icon fa fa-user-circle"></i> User</a> </li>
                                    <li> <a href="report_agent"> <i class="metismenu-icon fa fa-users">  </i>Profile History</a> </li>
                                </ul>
                            </li>

                            <li> <a href="#"><i class="metismenu-icon fa fa-credit-card"> </i>Transaction  <i class="metismenu-state-icon fas fa-angle-down caret-left"></i></a>
                                <ul>
                                    <li> <a href="transaction_Agent_withdraw"> <i class="metismenu-icon fa fa-download"> </i>Withdraw </a> </li>
                                    <li> <a href="report_User_Withdraw"> <i class="metismenu-icon fa fa-download">  </i>Withdraw History</a> </li>
                                </ul>
                            </li>

                           <li> <a href="#"> <i class="metismenu-icon fa fa-book">  </i> Passbook <i class="metismenu-state-icon fas fa-angle-down caret-left"></i> </a>
                               <ul>
                               <li> <a href="report_Passbook_Agent"> <i class="metismenu-icon fa fa-book">  </i>Your Statement</a> </li>
                               <li> <a href="report_Passbook"> <i class="metismenu-icon fa fa-book">  </i>Customer Statement</a> </li>
                               </ul> 
                            </li>
                            <li> <a href="#"><i class="metismenu-icon fa fa-university"></i> Company Details <i class="metismenu-state-icon fas fa-angle-down caret-left"></i></a>
                                <ul>
                                    <li> <a href="master_comp_accountdtl"><i class="metismenu-icon fa fa-university"></i> Bank Account Details  <!-- <i class="metismenu-state-icon fas fa-angle-down caret-left"></i> --> </a>  </li>
                                    <li> <a href="master_QR_code"> QR Code </a>  </li>
                                    <li> <a href="app_download" >Download App</a>  </li>
                                </ul>
                            </li>
                        </ul>';
                    } else if( $role  == "accountant") {
                                echo '<ul class="vertical-nav-menu metismenu ">
                                    <li class="app-sidebar__heading">Dashboards</li>
                                    <li> <a href="accountantDashboard"> <i class="metismenu-icon fa fa-home"></i> Dashboard </a></li>
                                                              
                                    <li class> <a href="#"><i class="metismenu-icon fa fa-user-plus"></i> Profile <i class="metismenu-state-icon fas fa-angle-down caret-left"></i></a>
                                        <ul class="mm-collapse">
                                            <li><a href="master_displayAccountant" ><i class="metismenu-icon"></i>Accountant</a> </li>
                                            <li><a href="master_displayProfile?role='.base64_encode("agent").'" ><i class="metismenu-icon"> </i>Partner</a> </li>
                                            <li> <a href="master_user_profiledtl"><i class="metismenu-icon fa fa-user-circle"></i> User</a> </li>
                                            <li> <a href="report_admin">Profile History</a> </li>
                                        </ul>
                                    </li>

                                    <li class> <a href="#"> <i class="metismenu-icon fas fa-list-alt"></i> Plan <i class="metismenu-state-icon fas fa-angle-down caret-left"></i> </a>
                                        <ul class="mm-collapse">
                                            <li><a href="master_myPlan.php">My Plan </a></li>
                                            <li><a href="report_planwise.php">Plans Wise Report</a></li>
                                        </ul> 
                                    </li>

                                    <li><a href="report_percentage"><i class="metismenu-icon fa fa-percent"></i>Percentage History</a></li>
                                    
                                    <li class> <a href="#"><i class="metismenu-icon fa fa-credit-card"> </i>Transaction  <i class="metismenu-state-icon fas fa-angle-down caret-left"></i></a>
                                        <ul class="mm-collapse">
                                            <li> <a href="report_Deposit"> Deposit History</a> </li>
                                            <li> <a href="report_Withdraw"> Withdraw History</a> </li> 
                                            <li> <a href="payment">Customer Withdraw</a> </li>
                                            <li> <a href="trans_agent_withdraw"> Partner Withdraw </a> </li>   
                                        </ul>
                                    </li>

                                    <li class> <a href="#"> <i class="metismenu-icon fa fa-book">  </i> Report <i class="metismenu-state-icon fas fa-angle-down caret-left"></i> </a>
                                        <ul class="mm-collapse">
                                            <li> <a href="report_EmpWiseCustomer">Employee Wise Customer</a> </li>
                                            <li> <a href="report_Passbook_Agent_Admin"> Partner Statement</a> </li>
                                            <li> <a href="report_Passbook">  Customer Statement</a> </li>
                                           <li> <a href="report_payoutMonthly">Customer Payout Report</a> </li>
                                           <li> <a href="report_payoutAgent">Partner Payout Report</a> </li>
                                           <li> <a href="report_master_dtl">Master Report</a> </li>
                                        </ul> 
                                    </li>

                                    <li> <a href="#"><i class="metismenu-icon fa fa-university"></i>  Company Details <i class="metismenu-state-icon fas fa-angle-down caret-left"></i></a>
                                        <ul class="mm-collapse">
                                            <li> <a href="master_comp_accountdtl">Bank Account Details </a>  </li>
                                            <li> <a href="master_QR_code"> QR Code </a>  </li>
                                        </ul>
                                    </li>
                                </ul>';
                    } else if( $role  == "assistant") {
                        echo '<ul class="vertical-nav-menu metismenu ">
                            <li class="app-sidebar__heading">Dashboards</li>
                            <li> <a href="assistantDashboard"> <i class="metismenu-icon fa fa-home"></i> Dashboard </a></li>
                                                      
                            <li class> <a href="#"><i class="metismenu-icon fa fa-user-plus"></i> Profile <i class="metismenu-state-icon fas fa-angle-down caret-left"></i></a>
                                <ul class="mm-collapse">
                                    <li><a href="master_displayAssistant" ><i class="metismenu-icon"></i>Assistant</a> </li>
                                    <li><a href="master_displayProfile?role='.base64_encode("agent").'" ><i class="metismenu-icon"> </i>Partner</a> </li>
                                    <li> <a href="master_user_profiledtl"><i class="metismenu-icon fa fa-user-circle"></i> User</a> </li>
                                </ul>
                            </li>

                            <li><a href="master_myPlan.php"><i class="metismenu-icon fas fa-list-alt"></i> My Plan </a></li>                                            
                                
                            <li><a href="report_percentage"><i class="metismenu-icon fa fa-percent"></i>Percentage History</a></li>
                      
                            <li class> <a href="#"> <i class="metismenu-icon fa fa-book">  </i> Report <i class="metismenu-state-icon fas fa-angle-down caret-left"></i> </a>
                                <ul class="mm-collapse">
                                    <li> <a href="report_Passbook_Agent_Admin"> Partner Statement</a> </li>
                                    <li> <a href="report_Passbook">  Customer Statement</a> </li>
                                   <li> <a href="master_deposit_approval"> Deposit History</a></li>
                                   <li> <a href="report_Withdraw"> Withdraw History</a> </li> 
                                </ul> 
                            </li>

                            <li> <a href="#"><i class="metismenu-icon fa fa-university"></i>  Company Details <i class="metismenu-state-icon fas fa-angle-down caret-left"></i></a>
                                <ul class="mm-collapse">
                                    <li> <a href="master_comp_accountdtl">Bank Account Details </a>  </li>
                                    <li> <a href="master_QR_code"> QR Code </a>  </li>
                                </ul>
                            </li>
                        </ul>';
                    } 
                ?>
            </div>
        </div>
    </div>     
        <script type="text/javascript" src="./assets/scripts/main.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        
        <script>
            $('.noft_class').click(function() {
                var id = $(this).attr('data-id');
                $.ajax({url:"master_notification_db.php?ajaxnotfid="+id,cache:false,success:function(result){
                    $(".modal-body").html(result);
                }});
            });
        </script>
    