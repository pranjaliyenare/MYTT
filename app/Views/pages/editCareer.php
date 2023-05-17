<div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12  grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Career</h4>

                  <?php 
                      // Display Response
                      if(session()->has('message')){
                      ?>
                          <div class="alert <?= session()->getFlashdata('alert-class') ?>">
                            <?= session()->getFlashdata('message') ?>
                          </div>
                      <?php
                      }
                  ?> 
                  
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/editCareer"); ?>" method="POST"  enctype="multipart/form-data" >
                  
                  <div class="form-group" style="display:none">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" name="id" id="id" value="<?php echo $id; ?>" placeholder="ID">
                      </div>
                      <div class="form-group" >
                        <label for="post"> Post:</label>
                        <input type="text" class="form-control" name="post" id="post" value="<?php echo $post_name; ?>" placeholder="Post" required>
                      </div>

                      <div class="form-group" >
                        <label for="designation"> Designation:</label>
                        <input type="text" class="form-control" name="designation" id="designation" value="<?php echo $Designation; ?>" placeholder="Post" required>
                      </div>

                    <div class="form-group">
                      <label for="company">Company Name:</label>
                      <input type="text" class="form-control"  name="company" value="<?php echo $company_name; ?>"  id="company" placeholder="Company Name" required>
                    </div>

                    <div class="form-group">
                      <label for="deadline">Deadline:</label>
                      <input type="date" name="deadline" class="form-control" id="deadline" value="<?php echo $Deadline; ?>" placeholder="Deadline" required>
                    </div>

                    <div class="form-group">
                      <label for="job_type">Job Type:</label>
                      <input type="text" name="job_type" class="form-control" id="job_type" value="<?php echo $Job_Type; ?>" placeholder="Job Type" required>
                      <!-- <select class="form-control"  name="job_type"   id="job_type"   required>
                        <option>Full time</option>
                        <option>Part time</option>
                      </select> -->
                    </div>

                    <div class="form-group">
                      <label for="timeFrom">Working Time From:</label>
                      <input type="time" name="timeFrom" class="form-control" id="timeFrom" value="<?php echo $working_timeFrom; ?>"  placeholder="Working Time From" required>
                    </div>
                    <div class="form-group">
                      <label for="timeTo">Working Time To:</label>
                      <input type="time" name="timeTo" class="form-control" id="timeTo"  value="<?php echo $working_timeTo; ?>" placeholder="Working Time To" required>
                    </div>
                   
                    <div class="form-group">
                      <label for="experienceFrom">Experience From:</label>
                      <input type="number" name="experienceFrom" class="form-control" id="experienceFrom" value="<?php echo $expFrom; ?>" placeholder="Experience From" required>
                    </div>
                    <div class="form-group">
                      <label for="experienceTo">Experience To:</label>
                      <input type="number" name="experienceTo" class="form-control" id="experienceTo" value="<?php echo $expTo; ?>" placeholder="Experience To" required>
                    </div>


                    <div class="form-group">
                      <label for="location">Location:</label>
                      <input type="text" name="location" class="form-control" id="location" value="<?php echo $Location; ?>" placeholder="Location" required>
                    </div>
                   
                    <div class="form-group">
                      <label for="emptotal">Employees Total:</label>
                      <input type="number" name="emptotal" class="form-control" id="emptotal" value="<?php echo $employees_total; ?>" placeholder="Employees Total" required>
                    </div>

                    <div class="form-group">
                      <label for="description">Job Description:</label>
                      <textarea type="text" name="description" class="form-control" id="description" placeholder="Job Description" required><?php echo $job_description; ?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="responsibility">Job Responsibility:</label>
                      <textarea type="text" name="responsibility" class="form-control" id="responsibility"  placeholder="Job Responsibility" required><?php echo $Job_Responsibility; ?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="education">Education Required:</label>
                      <textarea type="text" name="education" class="form-control" id="education"  placeholder="Education Required" required><?php echo $Education_Required; ?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="add_req">Additional Requirement:</label>
                      <textarea type="text" name="add_req" class="form-control" id="add_req"  placeholder="Additional Requirement" required><?php echo $additional_req; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="other_Benefits">Others Benefits:</label>
                      <textarea type="text" name="other_Benefits" class="form-control" id="other_Benefits"  placeholder="Others Benefits" required><?php echo $benefits; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="sal">Salary:</label>
                      <input type="number" name="sal" class="form-control" id="sal"  placeholder="Salary" value="<?php echo $salary; ?>" required>
                    </div>

                     <button type="btnEdit" class="btn btn-info me-2">Edit</button>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>