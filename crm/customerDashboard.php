<link href="./main.css" rel="stylesheet">

<script type="text/javascript" src="./assets/scripts/main.js"></script>



<!doctype html>

<?php

include 'header.php';
include 'database.php'; 
if ($_SESSION['ROLE'] == "customer") {
    $year = date("Y");
    $month = date("Y-m");
    $day = date("d");
    $withdraw_amt = 0.00;
    $month_withdraw_amt = 0.00;
    $day_deposit_amt= 0.00;
    $day_profit_amt= 0.00;
    $day_withdraw_amt= 0.00;
    $date = date("Y-m-d");
    $deposit_amt = 0.00;
    $query = mysqli_query($conn, "SET sql_mode = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'");
    // Year
    $query = mysqli_query($conn, "SELECT SUM(`amount`) AS amount, YEAR(`date`) AS year FROM `msd_transaction_withdraw_table` WHERE `user_id` = '".$_SESSION['USERID']."' AND `approve_status` = 'approved' AND`status` != 2 ");
    //$with_array=mysqli_fetch_assoc($query);

    while ($with_array = $query->fetch_assoc()) {

        //if($with_array["year"] == $year) {

        $withdraw_amt = $with_array["amount"];

        // } else {

        //     $withdraw_amt = 0.00;

        // }
    }
    $dep_query = mysqli_query($conn, "SELECT SUM(`amount`) as amt FROM `msd_customer_plan_table` AS plan LEFT JOIN `msd_xway_pay_response_table` pay ON `customer_id` = `userid` AND pay.`plan_id` = plan.`plan_id` AND pay.`status` != 'failed' AND `pay_status` !=2 WHERE plan.`status`!= 2 AND `customer_id` = '".$_SESSION['USERID']."' AND `active_status` != 'expire'");

    //$dep_array=mysqli_fetch_assoc($dep_query);

    while ($dep_array = $dep_query->fetch_assoc()) {
        // if($dep_array["year"] == $year) {
        $deposit_amt = $dep_array["amt"];
        // } else {
                //     $deposit_amt = 0.00;
        // }
    }

    $profit_query = mysqli_query($conn, "SELECT SUM(`cust_profit_amount`) AS amount, YEAR(`date`) AS year  FROM `msd_profit_table` WHERE `userid` = '".$_SESSION['USERID']."' AND `status` != 2 ");

    while ($profit_array = $profit_query->fetch_assoc()) {
        $profit_amt = $profit_array["amount"];
    }

    //Month

    $month_query = mysqli_query($conn, "SELECT SUM(`amount`) AS amount, DATE_FORMAT(`date`, '%Y-%m') AS MONTH FROM `msd_transaction_withdraw_table` WHERE `user_id` = '".$_SESSION['USERID']."' AND `approve_status` = 'approved' AND`status` != 2 GROUP BY MONTH");

    while ($month_with_array = $month_query->fetch_assoc()) {
        if ($month_with_array["MONTH"] == $month) {
            $month_withdraw_amt = $month_with_array["amount"];
        } else {
            $month_withdraw_amt = 0.00;
        }
    }



    $month_dep_query = mysqli_query($conn, "SELECT DATE_FORMAT(`pay_date`, '%Y-%m') AS MONTH, SUM(amount) as amt FROM `msd_xway_pay_response_table` WHERE `userid` = '".$_SESSION['USERID']."' AND `status` != 'failed' AND `pay_status` !=2 GROUP BY MONTH");

    //$month_dep_array=mysqli_fetch_assoc($month_dep_query);

    while ($month_dep_array = $month_dep_query->fetch_assoc()) {
        if ($month_dep_array["MONTH"] == $month) {
            $month_deposit_amt = $month_dep_array["amt"];
        } else {
            $month_deposit_amt = 0.00;
        }
    }

    $month_profit_query = mysqli_query($conn, "SELECT SUM(`cust_profit_amount`) AS amount, DATE_FORMAT(`date`, '%Y-%m') AS MONTH  FROM `msd_profit_table` WHERE `userid` = '".$_SESSION['USERID']."' AND `status` != 2 GROUP BY MONTH");

    //$month_profit_array=mysqli_fetch_assoc($month_profit_query);

    while ($month_profit_array = $month_profit_query->fetch_assoc()) {
        if ($month_profit_array["MONTH"] == $month) {
            $month_profit_amt = $month_profit_array["amount"];
        } else {
            $month_profit_amt = 0.00;
        }
    }



    //Daily deposit

    $day_dep_query = mysqli_query($conn, "SELECT DATE(`pay_date`) AS day, SUM(amount) as amt FROM `msd_xway_pay_response_table` INNER JOIN `msd_register_customer_table` ON `register_id` = `userid`  AND `register_status` != 2 WHERE `userid` = '".$_SESSION['USERID']."' AND `status` != 'failed' AND `pay_status` !=2 GROUP BY day");

    while ($day_rowdepo = mysqli_fetch_assoc($day_dep_query)) {
        if ($day_rowdepo["day"] == $date) {
            $day_deposit_amt = $day_rowdepo["amt"];
        } else {
            $day_deposit_amt = 0.00;
        }
    }

    // Daily Profit

    $day_profit_query = mysqli_query($conn, "SELECT SUM(`cust_profit_amount`) AS amount, DATE(PROFIT.`date`) AS day FROM `msd_profit_table` AS PROFIT INNER JOIN `msd_register_customer_table` AS CUST ON `register_id` = `userid`  AND `register_status` != 2 WHERE `userid` = '".$_SESSION['USERID']."' AND `status` != 2 GROUP BY day");

    while ($day_row = mysqli_fetch_assoc($day_profit_query)) {
        if ($day_row["day"] == $date) {
            $day_profit_amt = $day_row["amount"];
        } else {
            $day_profit_amt = 0.00;
        }
    }



    // Daily Withdraw

    $day_with_query = mysqli_query($conn, "SELECT SUM(`amount`) AS amount, DATE(WITHDRAW.`date`) AS day FROM `msd_transaction_withdraw_table` AS WITHDRAW INNER JOIN `msd_register_customer_table` ON `register_id` = `user_id`  AND `register_status` != 2 WHERE `user_id` = '".$_SESSION['USERID']."' AND `approve_status` = 'approved' AND`status` != 2 GROUP BY day");

    while ($day_rowWith = mysqli_fetch_assoc($day_with_query)) {
        if ($day_rowWith["day"] == $date) {
            $day_withdraw_amt = $day_rowWith["amount"];
        } else {
            $day_withdraw_amt = 0.00;
        }
    }
}

?>



<html lang="en">



<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta http-equiv="Content-Language" content="en">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Customer Dashboard.</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />

    <meta name="description" content="This is an example dashboard created using build-in elements and components.">

    <meta name="msapplication-tap-highlight" content="no">

    <style>

        

        body {

            background: black;

        }



        /* .box { position: relative;  } */

        .box::before {

        content: "";

        width: 300px;

        height: 290px;

        background-color: #89cff0;

        position: absolute;

        z-index: -1;

        top: 50%;

        left: 50%;

        -webkit-transform: translate(-50%, -50%);

                transform: translate(-50%, -50%);

        border-radius: 50%;

        }

        .box-body {

        position: relative;

        height: 100px;

        width: 100px;

        margin-top: 123.3333333333px;

        background-color: #cc231e;

        border-bottom-left-radius: 5%;

        border-bottom-right-radius: 5%;

        box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.3);

        background: linear-gradient(#762c2c,#ff0303);

        }

        .box-body .img{

        opacity: 0;

        transform: translateY(0%);

        transition: all 0.5s;

        margin: 0 auto;

        display: block;

        }

        .box-body:hover {

        cursor: pointer;

        -webkit-animation: box-body 1s forwards ease-in-out;

                animation: box-body 1s forwards ease-in-out;

        }

        .box-body:hover .img{

        opacity: 1;

        z-index: 0;

        transform: translateY(-150px);





        

        }

        .box-body:hover .box-lid {

        -webkit-animation: box-lid 1s forwards ease-in-out;

                animation: box-lid 1s forwards ease-in-out;

        }

        .box-body:hover .box-bowtie::before {

        -webkit-animation: box-bowtie-left 1.1s forwards ease-in-out;

                animation: box-bowtie-left 1.1s forwards ease-in-out;

        }

        .box-body:hover .box-bowtie::after {

        -webkit-animation: box-bowtie-right 1.1s forwards ease-in-out;

                animation: box-bowtie-right 1.1s forwards ease-in-out;

        }

        .box-body::after {

        content: "";

        position: absolute;

        top: 0;

        bottom: 0;

        left: 50%;

        -webkit-transform: translateX(-50%);

                transform: translateX(-50%);

        width: 50px;

        background: linear-gradient(#ffffff,#ffefa0)

        }

        .box-lid {

        position: absolute;

        z-index: 1;

        left: 50%;

        -webkit-transform: translateX(-50%);

                transform: translateX(-50%);

        bottom: 90%;

        height: 40px;

        background-color: #cc231e;

        height: 30px;

        width: 130px;

        border-radius: 5%;

        box-shadow: 0 8px 4px -4px rgba(0, 0, 0, 0.3);

        }

        .box-lid::after {

        content: "";

        position: absolute;

        top: 0;

        bottom: 0;

        left: 50%;

        -webkit-transform: translateX(-50%);

                transform: translateX(-50%);

        width: 50px;

        background: linear-gradient(#ffefa0,#fff)

        }

        .box-bowtie {

        z-index: 1;

        height: 100%;

        }

        .box-bowtie::before, .box-bowtie::after {

        content: "";

        width: 53.3333333333px;

        height: 53.3333333333px;

        border: 16.6666666667px solid #ffefa1;

        border-radius: 50% 50% 0 50%;

        position: absolute;

        bottom: 99%;

        z-index: -1;

        }

        .box-bowtie::before {

        left: 50%;

        -webkit-transform: translateX(-100%) skew(10deg, 10deg);

                transform: translateX(-100%) skew(10deg, 10deg);

        }

        .box-bowtie::after {

        left: 50%;

        -webkit-transform: translateX(0%) rotate(90deg) skew(10deg, 10deg);

                transform: translateX(0%) rotate(90deg) skew(10deg, 10deg);

        }



        @-webkit-keyframes box-lid {

        0%,

        42% {

            -webkit-transform: translate3d(-50%, 0%, 0) rotate(0deg);

                    transform: translate3d(-50%, 0%, 0) rotate(0deg);

        }

        60% {

            -webkit-transform: translate3d(-85%, -230%, 0) rotate(-25deg);

                    transform: translate3d(-85%, -230%, 0) rotate(-25deg);

        }

        90%, 100% {

            -webkit-transform: translate3d(-119%, 225%, 0) rotate(-70deg);

                    transform: translate3d(-119%, 225%, 0) rotate(-70deg);

        }

        }



        @keyframes box-lid {

        0%,

        42% {

            -webkit-transform: translate3d(-50%, 0%, 0) rotate(0deg);

                    transform: translate3d(-50%, 0%, 0) rotate(0deg);

        }

        60% {

            -webkit-transform: translate3d(-85%, -230%, 0) rotate(-25deg);

                    transform: translate3d(-85%, -230%, 0) rotate(-25deg);

        }

        90%, 100% {

            -webkit-transform: translate3d(-119%, 225%, 0) rotate(-70deg);

                    transform: translate3d(-119%, 225%, 0) rotate(-70deg);

        }

        }

        @-webkit-keyframes box-body {

        0% {

            -webkit-transform: translate3d(0%, 0%, 0) rotate(0deg);

                    transform: translate3d(0%, 0%, 0) rotate(0deg);

        }

        25% {

            -webkit-transform: translate3d(0%, 25%, 0) rotate(20deg);

                    transform: translate3d(0%, 25%, 0) rotate(20deg);

        }

        50% {

            -webkit-transform: translate3d(0%, -15%, 0) rotate(0deg);

                    transform: translate3d(0%, -15%, 0) rotate(0deg);

        }

        70% {

            -webkit-transform: translate3d(0%, 0%, 0) rotate(0deg);

                    transform: translate3d(0%, 0%, 0) rotate(0deg);

        }

        }

        @keyframes box-body {

        0% {

            -webkit-transform: translate3d(0%, 0%, 0) rotate(0deg);

                    transform: translate3d(0%, 0%, 0) rotate(0deg);

        }

        25% {

            -webkit-transform: translate3d(0%, 25%, 0) rotate(20deg);

                    transform: translate3d(0%, 25%, 0) rotate(20deg);

        }

        50% {

            -webkit-transform: translate3d(0%, -15%, 0) rotate(0deg);

                    transform: translate3d(0%, -15%, 0) rotate(0deg);

        }

        70% {

            -webkit-transform: translate3d(0%, 0%, 0) rotate(0deg);

                    transform: translate3d(0%, 0%, 0) rotate(0deg);

        }

        }

        @-webkit-keyframes box-bowtie-right {

        0%,

        50%,

        75% {

            -webkit-transform: translateX(0%) rotate(90deg) skew(10deg, 10deg);

                    transform: translateX(0%) rotate(90deg) skew(10deg, 10deg);

        }

        90%,

        100% {

            -webkit-transform: translate(-50%, -15%) rotate(45deg) skew(10deg, 10deg);

                    transform: translate(-50%, -15%) rotate(45deg) skew(10deg, 10deg);

            box-shadow: 0px 4px 8px -4px rgba(0, 0, 0, 0.3);

        }

        }

        @keyframes box-bowtie-right {

        0%,

        50%,

        75% {

            -webkit-transform: translateX(0%) rotate(90deg) skew(10deg, 10deg);

                    transform: translateX(0%) rotate(90deg) skew(10deg, 10deg);

        }

        90%,

        100% {

            -webkit-transform: translate(-50%, -15%) rotate(45deg) skew(10deg, 10deg);

                    transform: translate(-50%, -15%) rotate(45deg) skew(10deg, 10deg);

            box-shadow: 0px 4px 8px -4px rgba(0, 0, 0, 0.3);

        }

        }

        @-webkit-keyframes box-bowtie-left {

        0% {

            -webkit-transform: translateX(-100%) rotate(0deg) skew(10deg, 10deg);

                    transform: translateX(-100%) rotate(0deg) skew(10deg, 10deg);

        }

        50%,

        75% {

            -webkit-transform: translate(-50%, -15%) rotate(45deg) skew(10deg, 10deg);

                    transform: translate(-50%, -15%) rotate(45deg) skew(10deg, 10deg);

        }

        90%,

        100% {

            -webkit-transform: translateX(-100%) rotate(0deg) skew(10deg, 10deg);

                    transform: translateX(-100%) rotate(0deg) skew(10deg, 10deg);

        }

        }

        @keyframes box-bowtie-left {

        0% {

            -webkit-transform: translateX(-100%) rotate(0deg) skew(10deg, 10deg);

                    transform: translateX(-100%) rotate(0deg) skew(10deg, 10deg);

        }

        50%,

        75% {

            -webkit-transform: translate(-50%, -15%) rotate(45deg) skew(10deg, 10deg);

                    transform: translate(-50%, -15%) rotate(45deg) skew(10deg, 10deg);

        }

        90%,

        100% {

            -webkit-transform: translateX(-100%) rotate(0deg) skew(10deg, 10deg);

                    transform: translateX(-100%) rotate(0deg) skew(10deg, 10deg);

        }

        }

        
    </style>

      <style>

        #divImg {

            height: 300px;

        }

        @media screen and (max-width: 480px) {

            #divImg {

                height: 120px;

        }
    }

    div.card_class1 {
        background-color: #e0f3ff;
    }
    div.card_class2 {
        background-color: #d8f3e5;
    }
    div.card_class3 {
        background-color: #f7d3dc;
                            }
</style>
<style>
      @keyframes blinking {
        0% {
          background-color: #fdf507;
          /* border: 3px solid #666; */
        }
        100% {
          background-color: #ff8d00;
          /* border: 3px solid #666; */
        }
      }
      #blink {
        width: 100%;
        height: 65px;
        animation: blinking 0.5s infinite;
        margin-bottom: 30px;
        box-shadow: 0 0.46875rem 2.1875rem rgb(4 9 20 / 3%), 0 0.9375rem 1.40625rem rgb(108 117 125 / 60%), 0 0.25rem 0.53125rem rgb(4 9 20 / 5%), 0 0.125rem 0.1875rem rgb(4 9 20 / 3%);
        font-size: 40px;
        text-align: center;
        font-weight: bold;
        color: white;
        text-shadow: 0 0.46875rem 2.1875rem var(--light), 0 1.9375rem 1.40625rem rgb(108 117 125 / 60%), 0 0.25rem 0.53125rem var(--dark), 0 0.125rem 0.1875rem var(--gray);

    }
    @media screen and (max-width: 480px) {
    #blink {
                height: 60px;
                font-size: 20px;
            }
    }
    </style>
</head>

<body>





 <div class="app-main__outer active" id="overlay">

     <div class="app-main__inner" >

     <?php     
        if ($_SESSION['ROLE'] == "customer") { 
        $querypaidprinc = mysqli_query($conn, "SELECT SUM(principal_amount) AS paid_princ FROM `msd_transaction_withdraw_table` WHERE `user_id` = '".$_SESSION['USERID']."' AND `status` != 2 AND `approve_status` = 'approved'");

        $paidprinc_array = mysqli_fetch_assoc($querypaidprinc);

        $paid_princ = $paidprinc_array["paid_princ"];

        if($paid_princ == "") {

            $paid_princ = 0.00;

        }

    ?>

<style>
    /* // GENERAL STYLES */

/* * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  min-height: 100vh;
  background: linear-gradient(36deg, #44a08d, #093637);
  color: white;
  font-family: "Lato", sans-serif;
  font-weight: 300;
  font-size: 20px;
  line-height: 1.5;
  @media screen and (max-width: 820px) {
    font-size: 16px;
  }
} */

.container11 {
  /* width: 80%;
  min-height: 100vh; */
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.button-container11 {
  /* margin: 60px auto 0; */
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  @media screen and (max-width: 930px) {
    flex-direction: column;
  }
}


/* // BUTTON STYLES */

.button11 {
  position: relative;
  color: #4caf50;
  text-decoration: none;
  display: inline-block;
  text-transform: uppercase;
  letter-spacing: 1px;
  border: 2px solid #4caf50;
  border-radius: 1000px;
  padding: 10px 20px;
  /* margin: 40px; */
  box-shadow: 0 2px 5px 0 rgba(3,6,26,0.15);
  transition: .5s all ease-in-out;

}
button a:hover {
    cursor: pointer;
    background: white;
    color: #1F4141;
    animation: none;
    /* //animation-play-state: paused; */
  }
.button-pulse {
  animation: pulse 1s infinite 1s cubic-bezier(0.25, 0, 0, 1);
  box-shadow: 0 0 0 0 #4caf50;
}
@keyframes pulse {
  to {
    box-shadow: 0 0 0 18px rgba(255, 255, 255, 0); 
  }
}
/* // OTHER STYLES */
h1 {
  font-weight: 300;
  font-size: 2em;
  text-align: center;
  line-height: 1.3;
  padding: 40px 20px 0 20px;
}
p {
  text-align: center;
  opacity: .8;
  
 
}
a:hover {
    border-bottom: 1px solid rgba(0,0,0,0);
    background-color: #4caf50;
    color: #e0f3ff;
  }
a {
    color: white;
    text-decoration: none;
   
    transition: border .3s;
  }

</style>




           <!-- <div class="row">

                <div class="col-lg-12 col-xl-12">

                    <div class="card mb-3 widget-content">

                        <div class="widget-content-wrapper" id="divImg">

                            <img src="assets/images/diwali1.jpeg" alt="mytt" style="width: 100%; height:100%" />

                        </div>

                    </div>

                </div>                                

            </div> -->
            <?php 
                    // $sql = mysqli_query($conn, "SELECT * FROM `msd_transaction_withdraw_table` WHERE Date_Format(`date`,'%Y-%m-%d') BETWEEN '2021-10-11' AND '2021-11-10' AND `type` = 'customer' AND `user_id` = '".$_SESSION['USERID']."'  ORDER BY `withdraw_id` ASC;");
                    // $bonus=mysqli_fetch_assoc($sql);                    
                    // $bonus_type = $bonus["bonus_type"]; 
                    // $bonus_amount = $bonus["bonus_amount"]; 
                    // $bonus_desc = $bonus["bonus_desc"]; 
                    // $user_id = $bonus["user_id"]; 

                    // if($bonus_type == 'YES') {
            ?>
            <!-- <div class="row">
                <div class="col-lg-12 col-xl-12">
                        <div id="blink">
                            🤩 Congrats You Got Diwali Bonus : <?php //echo $bonus_amount; ?> 🤩
                        </div>
                </div>
            </div> -->
            <?php //}  ?>
            
            <!-- <div class="container11" style=" min-height:0; background: linear-gradient(36deg, #44a08d, #093637); color: white;font-family:Lato, sans-serif;font-weight: 300; font-size: 20px;line-height: 1.5;@media screen and (max-width: 820px) {font-size: 16px; }">
                <div class="button-container11" >
                     <a href="#" class="button11 button-pulse" style="cursor: pointer; background: white;color: #1F4141;  animation: pulse 1s infinite 1s cubic-bezier(0.25, 0, 0, 1); box-shadow: 0 0 0 0 white;">Deposit</a>
                </div>
            </div> -->
  
             <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-home icon-gradient bg-mean-fruit">
                            </i>
                        </div>
                        <div style="color: #16445e;">Customer Dashboard </div>
                    </div>
                    <div class="page-title-actions">
                        <div class="container11">
                            <div class="button-container11">
                           <b> <a href="pay?id=<?php echo base64_encode($_SESSION['USERID'])?>" class="button11 button-pulse">Deposit</a></b>
                           <!-- <b> <a href="pay?id=<?php echo base64_encode($_SESSION['USERID'])?>" class="button11 button-pulse">Deposit</a></b> -->
                            </div>
                        </div>
                    </div>
                        <!-- <div class="button-container1">          
                            <b><a href="pay?id='<?php echo base64_encode($_SESSION['USERID'])?>'"  class="button button-pulse" style="float: right; ">Deposit</a></b>                        
                        </div> -->
                       
                </div>
            </div>

            
  
            <!-- <b><a href="#"  class="button button-pulse" >Deposit</a></b> -->
            

            <div class="main-card mb-3 card">

                <div class="no-gutters row">

                    <div class="col-md-4">

                        <div class="widget-content">

                            <div class="widget-content-wrapper">

                                <div class="widget-content-right ml-0 mr-3">

                                    <div class="widget-numbers text-primary"><?php echo $deposit_amt; ?></div>

                                </div>

                                <div class="widget-content-left">

                                    <div class="widget-heading">Total Deposit</div>

                                    <div class="widget-subheading">First Total Deposit</div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="widget-content">

                            <div class="widget-content-wrapper">

                                <div class="widget-content-right ml-0 mr-3">

                                    <div class="widget-numbers text-danger"><?php echo $paid_princ; ?></div>

                                </div>

                                <div class="widget-content-left">

                                    <div class="widget-heading">Paid Principal</div>

                                    <div class="widget-subheading">Total Paid Amount</div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="widget-content">

                            <div class="widget-content-wrapper">

                                <div class="widget-content-right ml-0 mr-3">

                                    <div class="widget-numbers text-success"><?php echo $deposit_amt-$paid_princ; ?></div>

                                </div>

                                <div class="widget-content-left">

                                    <div class="widget-heading">Principal Amount</div>

                                    <div class="widget-subheading">Total Principal Amount</div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <div class="row">

                <div class="col-md-12">

                    <div class="mb-3 card">

                        <div class="card-body">

                            <ul class="tabs-animated-shadow tabs-animated nav">

                                <li class="nav-item">

                                    <a role="tab" class="nav-link show" id="tab-c-0" data-toggle="tab" href="#tab-animated-0" aria-selected="false">

                                        <span>TOTAL</span>

                                    </a>

                                </li>

                                <li class="nav-item">

                                    <a role="tab" class="nav-link show active" id="tab-c-1" data-toggle="tab" href="#tab-animated-1" aria-selected="true">

                                        <span>MONTHLY</span>

                                    </a>

                                </li>

                                <li class="nav-item">

                                    <a role="tab" class="nav-link show" id="tab-c-2" data-toggle="tab" href="#tab-animated-2" aria-selected="false">

                                        <span>DAILY</span>

                                    </a>

                                </li>

                            </ul>
                    
                 <div class="tab-content">

                     <div class="tab-pane show" id="tab-animated-0" role="tabpanel">

                        <div class="row">

                          <div class="col-lg-6 col-xl-4">

                              <div class="card mb-3 widget-content card_class1">

                                  <div class="widget-content-outer">

                                      <div class="widget-content-wrapper">

                                          <div class="widget-content-left">

                                              <div class="widget-heading">Total Deposit</div>

                                              <div class="widget-subheading">Year Deposit</div>

                                          </div>

                                          <div class="widget-content-right">

                                              <div class="widget-numbers text-primary"><?php echo $deposit_amt ?></div>

                                          </div>

                                      </div>

                                      <div class="widget-progress-wrapper">

                                          <div class="progress-bar-xs progress">

                                              <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 35%;"></div>

                                          </div>

                                          <div class="progress-sub-label">

                                              <div class="sub-label-left">Deposit</div>

                                              <div class="sub-label-right">100%</div>

                                          </div>

                                      </div>

                                  </div>

                              </div>

                          </div>                                

                          <div class="col-lg-6 col-xl-4">

                              <div class="card mb-3 widget-content card_class2">

                                  <div class="widget-content-outer">

                                      <div class="widget-content-wrapper">

                                          <div class="widget-content-left">

                                              <div class="widget-heading">Total Profit</div>

                                              <div class="widget-subheading">Year Profit</div>

                                          </div>

                                          <div class="widget-content-right">

                                              <div class="widget-numbers text-success"><?php echo $profit_amt; ?></div>

                                          </div>

                                      </div>

                                      <div class="widget-progress-wrapper">

                                          <div class="progress-bar-xs progress-bar-animated-alt progress">

                                              <div class="progress-bar bg-success" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;"></div>

                                          </div>

                                          <div class="progress-sub-label">

                                              <div class="sub-label-left">Profit</div>

                                              <div class="sub-label-right">100%</div>

                                          </div>

                                      </div>

                                  </div>

                              </div>

                          </div>

                          <div class="col-lg-6 col-xl-4">

                              <div class="card mb-3 widget-content card_class3">

                                  <div class="widget-content-outer">

                                      <div class="widget-content-wrapper">

                                          <div class="widget-content-left">

                                              <div class="widget-heading">Total Withdraw</div>

                                              <div class="widget-subheading">Year Withdraw</div>

                                          </div>

                                          <div class="widget-content-right">

                                              <div class="widget-numbers text-danger"><?php echo $withdraw_amt ?></div>

                                          </div>

                                      </div>

                                      <div class="widget-progress-wrapper">

                                          <div class="progress-bar-sm progress-bar-animated-alt progress">

                                              <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 55%;"></div>

                                          </div>

                                          <div class="progress-sub-label">

                                              <div class="sub-label-left">Withdraw</div>

                                              <div class="sub-label-right">100%</div>

                                          </div>

                                      </div>

                                  </div>

                              </div>

                          </div>

                    </div>

                  </div>

                    <div class="tab-pane show active" id="tab-animated-1" role="tabpanel">

                       <div class="row">

                          <div class="col-lg-6 col-xl-4">

                              <div class="card mb-3 widget-content card_class1">

                                  <div class="widget-content-outer">

                                      <div class="widget-content-wrapper">

                                          <div class="widget-content-left">

                                              <div class="widget-heading">Monthly Deposit</div>

                                              <div class="widget-subheading">Last Month Deposit</div>

                                          </div>

                                          <div class="widget-content-right">

                                              <div class="widget-numbers text-primary"><?php echo $month_deposit_amt ?></div>

                                          </div>

                                      </div>

                                      <div class="widget-progress-wrapper">

                                          <div class="progress-bar-xs progress">

                                              <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 35%;"></div>

                                          </div>

                                          <div class="progress-sub-label">

                                              <div class="sub-label-left">Deposit</div>

                                              <div class="sub-label-right">100%</div>

                                          </div>

                                      </div>

                                  </div>

                              </div>

                          </div>                                

                          <div class="col-lg-6 col-xl-4">

                              <div class="card mb-3 widget-content card_class2">

                                  <div class="widget-content-outer">

                                      <div class="widget-content-wrapper">

                                          <div class="widget-content-left">

                                              <div class="widget-heading">Monthly Profit</div>

                                              <div class="widget-subheading">Last Month Profit</div>

                                          </div>

                                          <div class="widget-content-right">

                                              <div class="widget-numbers text-success"><?php echo $month_profit_amt; ?></div>

                                          </div>

                                      </div>

                                      <div class="widget-progress-wrapper">

                                          <div class="progress-bar-xs progress-bar-animated-alt progress">

                                              <div class="progress-bar bg-success" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 55%;"></div>

                                          </div>

                                          <div class="progress-sub-label">

                                              <div class="sub-label-left">Profit</div>

                                              <div class="sub-label-right">100%</div>

                                          </div>

                                      </div>

                                  </div>

                              </div>

                          </div>

                          <div class="col-lg-6 col-xl-4">

                              <div class="card mb-3 widget-content card_class3">

                                  <div class="widget-content-outer">

                                      <div class="widget-content-wrapper">

                                          <div class="widget-content-left">

                                              <div class="widget-heading">Monthly Withdraw</div>

                                              <div class="widget-subheading">Last Month Withdraw</div>

                                          </div>

                                          <div class="widget-content-right">

                                              <div class="widget-numbers text-danger"><?php echo $month_withdraw_amt ?></div>

                                          </div>

                                      </div>

                                      <div class="widget-progress-wrapper">

                                          <div class="progress-bar-sm progress-bar-animated-alt progress">

                                              <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 35%;"></div>

                                          </div>

                                          <div class="progress-sub-label">

                                              <div class="sub-label-left">Withdraw</div>

                                              <div class="sub-label-right">100%</div>

                                          </div>

                                      </div>

                                  </div>

                              </div>

                          </div>

                        </div>

                      </div>

                      <div class="tab-pane show" id="tab-animated-2" role="tabpanel">

                        <div class="row">

                          <div class="col-lg-6 col-xl-4">

                              <div class="card mb-3 widget-content card_class1">

                                  <div class="widget-content-outer">

                                      <div class="widget-content-wrapper">

                                          <div class="widget-content-left">

                                              <div class="widget-heading">Daily Deposit</div>

                                              <div class="widget-subheading">Last Day Deposit</div>

                                          </div>

                                          <div class="widget-content-right">

                                              <div class="widget-numbers text-primary"><?php echo $day_deposit_amt ?></div>

                                          </div>

                                      </div>

                                      <div class="widget-progress-wrapper">

                                          <div class="progress-bar-xs progress">

                                              <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 35%;"></div>

                                          </div>

                                          <div class="progress-sub-label">

                                              <div class="sub-label-left">Deposit</div>

                                              <div class="sub-label-right">100%</div>

                                          </div>

                                      </div>

                                  </div>

                              </div>

                          </div>                                

                          <div class="col-lg-6 col-xl-4">

                              <div class="card mb-3 widget-content card_class2">

                                  <div class="widget-content-outer">

                                      <div class="widget-content-wrapper">

                                          <div class="widget-content-left">

                                              <div class="widget-heading">Daily Profit</div>

                                              <div class="widget-subheading">Last Day Profit</div>

                                          </div>

                                          <div class="widget-content-right">

                                              <div class="widget-numbers text-success"><?php echo $day_profit_amt; ?></div>

                                          </div>

                                      </div>

                                      <div class="widget-progress-wrapper">

                                          <div class="progress-bar-xs progress-bar-animated-alt progress">

                                              <div class="progress-bar bg-success" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;"></div>

                                          </div>

                                          <div class="progress-sub-label">

                                              <div class="sub-label-left">Profit</div>

                                              <div class="sub-label-right">100%</div>

                                          </div>

                                      </div>

                                  </div>

                              </div>

                          </div>

                          <div class="col-lg-6 col-xl-4">

                              <div class="card mb-3 widget-content card_class3">

                                  <div class="widget-content-outer">

                                      <div class="widget-content-wrapper">

                                          <div class="widget-content-left">

                                              <div class="widget-heading">Daily Withdraw</div>

                                              <div class="widget-subheading">Last Day Withdraw</div>

                                          </div>

                                          <div class="widget-content-right">

                                              <div class="widget-numbers text-danger"><?php echo $day_withdraw_amt ?></div>

                                          </div>

                                      </div>

                                      <div class="widget-progress-wrapper">

                                          <div class="progress-bar-sm progress-bar-animated-alt progress">

                                              <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 35%;"></div>

                                          </div>

                                          <div class="progress-sub-label">

                                              <div class="sub-label-left">Withdraw</div>

                                              <div class="sub-label-right">100%</div>

                                          </div>

                                      </div>

                                  </div>

                              </div>

                          </div>

                        </div>

                      </div>

                </div>

            </div>

        </div>        

    </div>

</div>

</div>
</body>
</html>
            <?php include 'footer.php'; ?>
            <?php } else { ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- <div class="main-card mb-3 card"> -->
                                    <div class="widget-content-wrapper" id="divImg">
                                        <img  src="assets/images/404-error.jpg" alt="mytt"  style="width:100%; "/>
                                    </div>
                                <!-- </div> -->
                            </div>                                
                        </div>
                    </div>
                </body>
            </html>
            <?php } ?>