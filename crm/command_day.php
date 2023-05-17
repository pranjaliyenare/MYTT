<?php
$whitelist = [
  // IPv4 address
  '127.0.0.1', 

  // IPv6 address
  '::1'
];

    if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) 
    {
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "allianza_crm_mytt";
    } else {
      $servername = "allianza.in";
      $username = "allianza";
      $password = "Dubai@1299$";
      $dbname = "allianza_crm_mytt";
    }

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  } 
  
  $projects = array();
  $plans = array();
  $month = date('m');
  $year = date('Y');
  $month_cnt = date('t');

  $records = mysqli_query($conn, "SELECT `register_id` FROM `msd_register_customer_table` WHERE `register_approved_status` = 'approved' AND `register_activate_status`= 'activate' AND `register_status` != 2");
  
    while ($project =  mysqli_fetch_assoc($records))
    {
        $projects[] = $project;
    }
    foreach ($projects as $project)
    { 
          $query = mysqli_query($conn, "SET sql_mode = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'");
          $planquery = mysqli_query($conn, "SELECT plan.`plan_id` FROM `msd_customer_plan_table` plan INNER JOIN `msd_plan_table` newplan ON newplan.`plan_id` = plan.`plan_new_id` AND `plan_payout` = 'monthly' AND newplan.`status` != 2 WHERE plan.`customer_id` = '".$project["register_id"]."' AND plan.`active_status` = 'active' AND plan.`status` != 2 AND plan.`compo_plan` != 'YES'");
          while ($plan =  mysqli_fetch_assoc($planquery))
          {
              $plans[] = $plan;
          }
          if(!empty($plans)) {
          foreach ($plans as $plan)
          {
            $query = mysqli_query($conn, "SELECT PERC.*, Sum(amount) amt FROM `msd_transaction_role_perc_table` PERC RIGHT JOIN `msd_xway_pay_response_table` PAY ON PERC.`customer_id` = PAY.`userid` AND PERC.`plan_id` = PAY.`plan_id` AND PAY.`status` != 'failed' WHERE PERC.`customer_id` = '".$project["register_id"]."' AND PERC.`plan_id` = '".$plan["plan_id"]."' AND PERC.`status` != 2");
            $reg_array = mysqli_fetch_assoc($query);            
            if($reg_array["customer_id"] != NULL) {
                
                
                $custperc   = $reg_array["customer_perc"]/100;
                $agentperc1 = $reg_array["agent_perc1"]/100;
                $agentperc2 = $reg_array["agent_perc2"]/100;
                $agentperc3 = $reg_array["agent_perc3"]/100;
                $agentperc4 = $reg_array["agent_perc4"]/100;
                $agentperc5 = $reg_array["agent_perc5"]/100;
                $agentperc6 = $reg_array["agent_perc6"]/100;
                      
                $custperc1    =($reg_array["amt"]*$custperc);
                $agent_perc_1 = $reg_array["amt"]*$agentperc1;
                $agent_perc_2 = $reg_array["amt"]*$agentperc2;
                $agent_perc_3 = $reg_array["amt"]*$agentperc3;
                $agent_perc_4 = $reg_array["amt"]*$agentperc4;
                $agent_perc_5 = $reg_array["amt"]*$agentperc5;
                $agent_perc_6 = $reg_array["amt"]*$agentperc6;

                $cust_profit =  $custperc1/$month_cnt;
                $agent_profit1 = $agent_perc_1/$month_cnt;
                $agent_profit2 = $agent_perc_2/$month_cnt;
                $agent_profit3 = $agent_perc_3/$month_cnt;
                $agent_profit4 = $agent_perc_4/$month_cnt;
                $agent_profit5 = $agent_perc_5/$month_cnt;
                $agent_profit6 = $agent_perc_6/$month_cnt;          
              
              $record = mysqli_query($conn, "INSERT INTO `msd_profit_table`(`userid`, `admin_id`, `plan_id`, `amount`, `cust_percentage`, `cust_profit_amount`, `agent_id`, `agent_perc`, `agent_profit_amount`, `agent_id2`, `agent_perc2`, `agent_profit_amount2`, `agent_id3`, `agent_perc3`, `agent_profit_amount3`, `agent_id4`, `agent_perc4`, `agent_profit_amount4`, `agent_id5`, `agent_perc5`, `agent_profit_amount5`, `agent_id6`, `agent_perc6`, `agent_profit_amount6`, `type`) VALUES ('".$reg_array["customer_id"]."','".$reg_array["agent_id1"]."','".$reg_array["plan_id"]."', '".$reg_array["amt"]."','".$reg_array["customer_perc"]."','".$cust_profit."','".$reg_array["agent_id1"]."','".$reg_array["agent_perc1"]."','".$agent_profit1."','".$reg_array["agent_id2"]."','".$reg_array["agent_perc2"]."','".$agent_profit2."','".$reg_array["agent_id3"]."','".$reg_array["agent_perc3"]."','".$agent_profit3."','".$reg_array["agent_id4"]."','".$reg_array["agent_perc4"]."','".$agent_profit4."','".$reg_array["agent_id5"]."','".$reg_array["agent_perc5"]."','".$agent_profit5."','".$reg_array["agent_id6"]."','".$reg_array["agent_perc6"]."','".$agent_profit6."','customer')");
            }
          } 
        }
    } 
  
?>