<?php

include 'header.php';
include 'database.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
        <style>
           
            .wrapper {
                width: 90%;
                margin: 5px auto;
            }
            
            .common {
                width: 100%;
                border: none;
            }
            
            .common thead th {
                background-color: #bac0c7;
            }
            
            .trow:first-child {
                display: none;
                margin: 0 auto;
            }
            
            .trow input {
                border-radius: 5px;
            }
            
            .controls a {
                text-decoration: none;
                color: #791515;
            }
            
            .list_add {
                text-decoration: none;
                color: #791515;
            }
            
            .list_add:before {
                content: "\002b";
                color: white;
                border: 1px solid #bac0c7;
                padding: 0 5px;
                border-radius: 5px;
                background-color: #bac0c7;
                margin-right: 20px;
            }
            
            .action_btn {
                text-align: center;
            }
            
            .action_btn input {
                width: 120px;
                padding: 5px;
                border-radius: 10px;
                margin: 10px;
            }
            
            .action_btn input:first-child {
                background-color: #bac0c7;
                color: white;
            }
            
            @keyframes fadeout {
                from {
                    bottom: 30px;
                    opacity: 1;
                }
                to {
                    bottom: 0;
                    opacity: 0;
                }
            }
            
            @keyframes fadein {
                from {
                    bottom: 0;
                    opacity: 0;
                }
                to {
                    bottom: 30px;
                    opacity: 1;
                }
            }
            
            .fa-times {
                font-size: 1rem;
            }
        </style>
    </head>
    <body>
        
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <?php if ($_SESSION['ROLE'] == "admin") { ?>
                    <div class="app-page-title" style="padding: 10px;">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                <i class="fa fa-users" aria-hidden="true" ></i>
                                </div>
                                <div>Add Employee Incentive
                                    <div class="page-title-subheading"> </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body"><h5 class="card-title"></h5>
                                    <form class="" method="post" action="">
                                        <div class="position-relative row form-group">
                                                <label for="customer_id" class="col-sm-2 col-form-label"> <b>Plan Name :</b></label>
                                                <div class="col-sm-4">
                                                        <?php   
                                                            if($_SESSION['ROLE'] == "admin") {
                                                                      echo '<select class="mb-2 form-control" name="plan_name" id="customer_id" onchange="javascript: ddlOnchange(this.value);">';
                                                                      $sql = mysqli_query($conn, "SELECT `plan_id` AS id, `plan_name` AS name FROM `msd_customer_plan_table` WHERE `active_status` = 'active' AND `status` != 2 ORDER BY id DESC;");
                                                                      $row = mysqli_num_rows($sql);
                                                                      while ($row = mysqli_fetch_array($sql)) {
                                                                          if($_POST['plan_name'] == $row['id']) { $selected='selected'; }
                                                                          echo "<option value='".$row['id']."' ".$selected.">" .$row['id'], " - ", $row['name'] ."</option>" ;
                                                                          $selected ="";
                                                                    }
                                                                  echo '</select>';                                                                  
                                                            }
                                                        ?>
                                                </div>                                    
                                                <div class="col-sm-2">
                                                    <input class="mb-2 mr-2 btn btn-primary" type="submit" name="submit" value="Search" />
                                                </div>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <?php  if(isset($_POST['submit'])){ ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-card mb-3">
                                    <div class="card-body"><h5 class="card-title"></h5>
                                        <form class="" method="post">
                                            
                                            <div class="table-responsive">
                                                <div class="wrapper">
                                                <?php 
                                                    $queryCust = mysqli_query($conn, "SELECT `register_id` id, CONCAT(`register_fname`, ' ', `register_lname`) AS name, `plan_id`, `plan_name` FROM `msd_customer_plan_table` INNER JOIN `msd_register_customer_table` ON `register_id` = `customer_id` AND `status` != 2 WHERE `plan_id` = '".$_POST["plan_name"]."';");
                                                    //$result = mysqli_query($conn, $sql);
                                                    $row = mysqli_fetch_assoc($queryCust);
                                                    echo "<h6>* ".$row["id"], " - ", $row["name"]."</h6>
                                                        <h6>* ".$row["plan_id"]." - ".$row["plan_name"]."</h6>";
                                                ?>
                                                <br/>
                                                    <table id="myTable" class="common mb-0 table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th><i class="fas fa-times"></i></th>
                                                                <th>Name</th>
                                                                <th>Percentage</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="trow">
                                                                <td class="controls">
                                                                    <a href="#" class="list_cancel"
                                                                        title="Delete Row">
                                                                        <i class="fas fa-times"></i>
                                                                    </a>
                                                                </td>
                                                            
                                                                <td>
                                                                    <?php 
                                                                        $sql1 = mysqli_query($conn, "SELECT * FROM `msd_register_comp_employee_table` WHERE `status` != 2");
                                                                    ?>
                                                                    <select name="emp_name" id="emp_name" class="form-control label">
                                                                        <option value="0">Select Employee</option>
                                                                        <?php  $row1 = mysqli_num_rows($sql1);
                                                                        while ($row1 = mysqli_fetch_array($sql1)) { ?>
                                                                        <option value="<?php echo $row1['emp_id']; ?>"><?php echo $row1['emp_name']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" id="perc" name="perc" value="0" />
                                                                </td>
                                                            </tr>

                                                            <tr class="no_entries_row">
                                                                <td class="controls">
                                                                    <a href="#" class="list_cancel"
                                                                        title="Delete Row">
                                                                        <i class="fas fa-times"></i>
                                                                    </a>
                                                                </td>
                                                            
                                                                <td>
                                                                    <?php $sql1 = mysqli_query($conn, "SELECT * FROM `msd_register_comp_employee_table` WHERE `status` != 2");

                                                                    ?>
                                                                    <select name="emp_name" id="emp_name" class="form-control label emp_class">
                                                                        <option value="0">Select Employee</option>
                                                                        <?php  $row1 = mysqli_num_rows($sql1);
                                                                        while ($row1 = mysqli_fetch_array($sql1)) { ?>
                                                                        <option value="<?php echo $row1['emp_id']; ?>"><?php echo $row1['emp_name']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control perc_class" id="perc" name="perc" value="0" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                    <a href="#" class="list_add">Add one row</a>
                                                    <br class="clear" />

                                                    <div class="action_btn">
                                                        <input name="submit" onclick="javascript:tdOnchange();" class="action_btn submit" type="button" value="Edit" />
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <script>
                function addNewRow() {
                    var template = $("tr.trow:first");
                    $(".no_entries_row").css("display", "none");
                    var newRow = template.clone();
                    var lastRow = $("tr.trow:last").after(newRow);

                    $(".list_cancel").on("click", function(event) {
                        event.stopPropagation();
                        event.stopImmediatePropagation();
                        $(this).closest("tr").remove();
                        if ($(".list_cancel").length === 1) {
                            $(".no_entries_row")
                                .css("display", "inline-block");
                        }
                        console.log($(".list_cancel").length);
                    });
                    console.log($(".list_cancel").length);
                    $("select.label").on("change", function(event) {
                        event.stopPropagation();
                        event.stopImmediatePropagation();
                        $(this).css("background-color", $(this).val());
                    });
                }

                $("a.list_add").on("click", addNewRow);

                function tdOnchange() {        
                    var table = document.getElementById('myTable');
                    var jsonArr = [];
                    for(var i =0,row;row = table.tBodies[0].rows[i];i++){
                    var col = row.cells;
                    alert(col[1].find(".emp_class").val());
                    var jsonObj = {
                            id : col[1].find(".emp_class").val(),
                            name : col[2].find(".perc_class").val()
                        }             
                        jsonArr.push(jsonObj);                               
                    }
                    console.log(jsonArr);
                }

                // $(document).ready(function(){
                //     $("#myTable").on('click', '.action_btn', function() {
                //     // get the current row
                //     var currentRow = $(this).closest("tr");
                //     var col1 = currentRow.find(".emp_class").val(); // get current row 1st table cell TD value
                //     var col2 = currentRow.find(".perc_class").val(); // get current row 2nd table cell TD value
                //     var data = col1 + "\n" + col2;
                //     alert(data);
                //     });
                // });
            </script>

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